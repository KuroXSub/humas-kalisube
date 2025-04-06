<?php

namespace App\Filament\Resources\EncryptedFileResource\Pages;

use App\Filament\Resources\EncryptedFileResource;
use App\Services\FileEncryptionService;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateEncryptedFile extends CreateRecord
{
    protected static string $resource = EncryptedFileResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array 
    {
        try {
            if (empty($data['file'])) {
                throw new \Exception("File belum diupload");
            }
    
            $filePath = $data['file'];
            $fullPath = storage_path('app/' . $filePath);
    
            // Debugging: Log file info
            Log::info('Attempting to encrypt file', [
                'input_path' => $filePath,
                'full_path' => $fullPath,
                'file_exists' => file_exists($fullPath),
                'file_size' => file_exists($fullPath) ? filesize($fullPath) : 0
            ]);
    
            if (!file_exists($fullPath)) {
                throw new \Exception("File tidak ditemukan di server");
            }
    
            if (filesize($fullPath) === 0) {
                throw new \Exception("File kosong (0 byte)");
            }
    
            $encryptionService = app(FileEncryptionService::class);
            $encryptedData = $encryptionService->encryptFile($fullPath, $data['encryption_key']);
    
            // Hapus file temporary
            Storage::delete($filePath);

            return [
                'title' => $data['title'],
                'description' => $data['description'],
                'original_name' => $encryptedData['original_name'],
                'encrypted_path' => $encryptedData['path'],
                'file_type' => $encryptedData['file_type'],
                'key_hash' => $encryptedData['key_hash'],
                'user_id' => Auth::id(),
                'file' => null
            ];

        } catch (\Exception $e) {
            Log::error('File encryption failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
    
            if (!empty($filePath) && Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
    
            Notification::make()
                ->title('Gagal Menyimpan File')
                ->body($e->getMessage())
                ->danger()
                ->send();
    
            throw $e;
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
