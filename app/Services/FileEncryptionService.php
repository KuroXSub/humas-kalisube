<?php
// app/Services/FileEncryptionService.php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class FileEncryptionService
{
    private $cipher = 'aes-256-cbc';
    private $key;

    public function __construct()
    {
        $this->key = config('app.encryption_key');
    }

    public function encryptFile($filePath, $userProvidedKey)
    {
        try {
            if (!file_exists($filePath)) {
                // Coba cari di storage jika path relatif
                $storagePath = storage_path('app/' . $filePath);
                if (file_exists($storagePath)) {
                    $filePath = $storagePath;
                } else {
                    throw new \Exception("File not found at path: {$filePath}");
                }
            }
    
            $fileContents = file_get_contents($filePath);

            if ($filePath instanceof TemporaryUploadedFile) {
                $fileContents = $filePath->get();
                $originalName = $filePath->getClientOriginalName();
                $fileType = $filePath->getClientOriginalExtension();
            } 
            // Handle path string
            else {
                if (!file_exists($filePath)) {
                    throw new \Exception("File not found at path: {$filePath}");
                }
                
                $fileContents = file_get_contents($filePath);
                $originalName = basename($filePath);
                $fileType = pathinfo($originalName, PATHINFO_EXTENSION);
            }

            if (empty($fileContents)) {
                throw new \Exception("File content is empty");
            }

            $iv = random_bytes(16);
            $key = substr(hash('sha256', $userProvidedKey), 0, 32);

            $encrypted = openssl_encrypt(
                $fileContents,
                $this->cipher,
                $key,
                OPENSSL_RAW_DATA,
                $iv
            );

            if ($encrypted === false) {
                throw new \Exception('Encryption failed: ' . openssl_error_string());
            }

            $fileName = Str::uuid() . '.enc';
            $path = 'encrypted_files/' . $fileName;
            
            Storage::put($path, $iv . $encrypted);

            return [
                'path' => $path,
                'key_hash' => Hash::make($userProvidedKey),
                'original_name' => $originalName,
                'file_type' => $fileType
            ];
        } catch (\Exception $e) {
            Log::error("Encryption failed: " . $e->getMessage());
            throw new \Exception('File encryption error: ' . $e->getMessage());
        }
    }

    public function decryptFile($encryptedPath, $userProvidedKey)
    {
        try {
            if (!Storage::exists($encryptedPath)) {
                throw new \Exception("Encrypted file not found at: " . $encryptedPath);
            }

            $encryptedWithIv = Storage::get($encryptedPath);
            
            if (strlen($encryptedWithIv) < 16) {
                throw new \Exception("Invalid encrypted file format");
            }

            $iv = substr($encryptedWithIv, 0, 16);
            $encrypted = substr($encryptedWithIv, 16);

            // Pastikan key memiliki panjang yang tepat
            $key = substr(hash('sha256', $userProvidedKey), 0, 32);

            $decrypted = openssl_decrypt(
                $encrypted,
                $this->cipher,
                $key,
                OPENSSL_RAW_DATA,
                $iv
            );

            if ($decrypted === false) {
                throw new \Exception('Decryption failed: ' . openssl_error_string());
            }

            return $decrypted;

        } catch (\Exception $e) {
            Log::error('Decryption error', [
                'path' => $encryptedPath,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}