<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Log;

Route::get('/', [FileController::class, 'index'])->name('welcome');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])
    ->name('google.redirect'); // Ubah nama route untuk konsistensi

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])
    ->name('google.callback');

Route::get('/dashboard', [DashboardController::class, 'index']) // Perubahan di sini
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Route untuk pengaduan
    Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
    Route::get('/complaints/create', [ComplaintController::class, 'create'])->name('complaints.create');
    Route::post('/complaints', [ComplaintController::class, 'store'])->name('complaints.store');
    Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])->name('complaints.show');
    Route::get('/complaints/{complaint}/edit', [ComplaintController::class, 'edit'])->name('complaints.edit');
    Route::put('/complaints/{complaint}', [ComplaintController::class, 'update'])->name('complaints.update');
    Route::delete('/complaints/{complaint}', [ComplaintController::class, 'destroy'])->name('complaints.destroy');

    Route::post('/feedback', [FeedbackController::class, 'store'])->name('feedback.store');

    // Route untuk saran
    Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
    Route::get('/suggestions/create', [SuggestionController::class, 'create'])->name('suggestions.create');
    Route::post('/suggestions', [SuggestionController::class, 'store'])->name('suggestions.store');
    Route::get('/suggestions/{suggestion}', [SuggestionController::class, 'show'])->name('suggestions.show');
    Route::get('/suggestions/{suggestion}/edit', [SuggestionController::class, 'edit'])->name('suggestions.edit');
    Route::put('/suggestions/{suggestion}', [SuggestionController::class, 'update'])->name('suggestions.update');
    Route::delete('/suggestions/{suggestion}', [SuggestionController::class, 'destroy'])->name('suggestions.destroy');
});

Route::middleware(['auth:filament'])->group(function () {
    Route::get('/admin/files/{encryptedFile}/download', [FileController::class, 'download'])
        ->name('admin.file.download');
});

Route::get('/files', [FileController::class, 'index'])->name('files.index');

// Route publik untuk dekripsi
Route::get('/files/{file}', [FileController::class, 'showDecryptForm'])
    ->name('file.show');
    
Route::post('/files/{file}/decrypt', [FileController::class, 'decryptAndDownload'])
    ->name('file.decrypt');


    // Route::get('/test-encrypt', function() {
    //     $testFile = storage_path('test.txt');
    //     file_put_contents($testFile, 'This is a test file content');
        
    //     $key = 'test-key-123';
        
    //     $service = app(\App\Services\FileEncryptionService::class);
        
    //     // Enkripsi
    //     $encrypted = $service->encryptFile($testFile, $key);
    //     Log::info('Encrypted test file: ', $encrypted);
        
    //     // Dekripsi
    //     $decrypted = $service->decryptFile($encrypted['path'], $key);
    //     Log::info('Decrypted content: ' . $decrypted);
        
    //     return response()->json([
    //         'original' => 'This is a test file content',
    //         'decrypted' => $decrypted,
    //         'match' => $decrypted === 'This is a test file content'
    //     ]);
    // });

require __DIR__.'/auth.php';