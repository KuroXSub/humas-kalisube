<?php
// app/Http/Controllers/FileController.php

namespace App\Http\Controllers;

use App\Models\EncryptedFile;
use App\Services\FileEncryptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function index()
    {
        // Untuk route welcome (tampilkan 5 item)
        if (request()->routeIs('welcome')) {
            $files = EncryptedFile::latest()->paginate(5);
            return view('welcome', compact('files'));
        }
        
        // Untuk route files.index (tampilkan 15 item)
        $files = EncryptedFile::latest()->paginate(15);
        return view('files.index', compact('files'));
    }

    // Di controller yang menangani upload
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240', // max 10MB
            'encryption_key' => 'required|string|min:8'
        ]);

        // Simpan file temporary
        $tempPath = $request->file('file')->store('temp_uploads');
        
        try {
            $encryptionService = app(FileEncryptionService::class);
            $result = $encryptionService->encryptFile(
                Storage::path($tempPath),
                $request->encryption_key
            );
            
            // Simpan ke database
            EncryptedFile::create([
                // ... field lainnya
                'encrypted_path' => $result['path'],
                'key_hash' => $result['key_hash'],
                'original_name' => $result['original_name'],
                'file_type' => $result['file_type']
            ]);
            
            // Hapus file temporary
            Storage::delete($tempPath);
            
        } catch (\Exception $e) {
            Storage::delete($tempPath);
            return back()->withErrors(['error' => 'Encryption failed: '.$e->getMessage()]);
        }
    }

    public function showDecryptForm(EncryptedFile $file)
    {
        $previousRoute = session('previous_route', 'welcome');
        return view('files.decrypt', compact('file', 'previousRoute'));
    }

    public function decryptAndDownload(Request $request, EncryptedFile $file)
    {
        $request->validate([
            'decryption_key' => 'required|string'
        ], [
            'decryption_key.required' => 'Kunci dekripsi harus diisi'
        ]);

        if (!Hash::check($request->decryption_key, $file->key_hash)) {
            return back()
                ->withInput()
                ->withErrors([
                    'decryption_key' => 'Kunci dekripsi salah. Silakan coba lagi atau hubungi admin untuk kunci yang benar.'
                ]);
        }

        try {
            $encryptionService = app(FileEncryptionService::class);
            $decryptedContent = $encryptionService->decryptFile($file->encrypted_path, $request->decryption_key);

            // Clean all output buffers
            while (ob_get_level()) ob_end_clean();

            $headers = [
                'Content-Type' => $this->getMimeType($file->file_type),
                'Content-Length' => strlen($decryptedContent),
                'Content-Disposition' => 'attachment; filename="'.str_replace('"', '', $file->original_name).'"',
                'Cache-Control' => 'no-store, no-cache, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ];

            return response()->make(
                $decryptedContent,
                200,
                $headers
            );

        } catch (\Exception $e) {
            Log::error('Download failed', [
                'file_id' => $file->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->withErrors(['error' => 'Download failed: ' . $e->getMessage()]);
        }
    }

    private function getMimeType($extension)
    {
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'doc' => 'application/msword',
            'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'xls' => 'application/vnd.ms-excel',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
        ];
        
        return $mimeTypes[strtolower($extension)] ?? 'application/octet-stream';
    }
}