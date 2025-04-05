<?php

namespace App\Observers;

use App\Models\Category;
use App\Models\Complaint;
use App\Models\User;
use App\Notifications\NewComplaintNotification;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ComplaintObserver
{
    /**
     * Handle the Complaint "created" event.
     */
    public function created(Complaint $complaint): void
    {
        $recipients = \App\Models\User::whereIn('role', ['admin', 'petugas'])->get();
        
        foreach ($recipients as $recipient) {
            Notification::make()
                ->title('Pengaduan Baru')
                ->icon('heroicon-o-exclamation-triangle')
                ->body(
                    "Kategori: " . ($complaint->kategori_pengaduan->nama_kategori ?? 'Tidak Diketahui') . "\n" .
                    "Deskripsi: " . substr($complaint->deskripsi, 0, 100) . (strlen($complaint->deskripsi) > 100 ? '...' : '')
                )
                ->sendToDatabase($recipient);
        }
    }

    /**
     * Handle the Complaint "updated" event.
     */
    public function updated(Complaint $complaint): void
    {
        // Daftar field yang memicu notifikasi
        $trackedFields = ['status', 'prioritas', 'petugas_id', 'deskripsi', 'kategori_pengaduan_id'];
        
        // Cek apakah ada field yang berubah
        $changes = [];
        foreach ($trackedFields as $field) {
            if ($complaint->isDirty($field)) {
                $original = $complaint->getOriginal($field);
                $current = $complaint->$field;
                
                // Format khusus untuk relasi
                if ($field === 'petugas_id') {
                    $original = $original ? User::find($original)?->name : 'Belum ditugaskan';
                    $current = $current ? User::find($current)?->name : 'Belum ditugaskan';
                } elseif ($field === 'kategori_pengaduan_id') {
                    $original = $original ? Category::find($original)?->nama_kategori : 'Tidak diketahui';
                    $current = $current ? Category::find($current)?->nama_kategori : 'Tidak diketahui';
                }
                
                $changes[] = ucfirst($field) . ": $original → $current";
            }
        }

        // Jika ada perubahan penting
        if (!empty($changes)) {
            $message = "Update Pengaduan #{$complaint->id}\n" . implode("\n", $changes);
            
            // 1. Notifikasi ke ADMIN/PETUGAS
            $recipients = User::whereIn('role', ['admin', 'petugas'])
                ->where('id', '!=', Auth::user()) // Hindari notifikasi ke diri sendiri
                ->get();
            
            foreach ($recipients as $recipient) {
                Notification::make()
                    ->title('Update Pengaduan')
                    ->icon('heroicon-o-document-text')
                    ->body($message)
                    ->sendToDatabase($recipient);
            }

            // 2. Notifikasi ke PETUGAS terkait (jika diassign)
            if ($complaint->isDirty('petugas_id') && $complaint->petugas_id) {
                Notification::make()
                    ->title('Anda Ditugaskan ke Pengaduan')
                    ->icon('heroicon-o-user-circle')
                    ->body("Anda menjadi penanggung jawab Pengaduan #{$complaint->id}")
                    ->sendToDatabase($complaint->petugas);
            }

            // 3. Notifikasi ke USER PELAPOR (khusus status)
            if ($complaint->isDirty('status') && $complaint->user_id) {
                Notification::make()
                    ->title('Status Pengaduan Diperbarui')
                    ->icon('heroicon-o-arrow-path')
                    ->body(
                        "ID: {$complaint->id}\n" .
                        "Status: {$complaint->status}"
                    )
                    ->sendToDatabase($complaint->user);
            }
        }
    }

    /**
     * Handle the Complaint "deleted" event.
     */
    public function deleted(Complaint $complaint): void
    {
        //
    }

    /**
     * Handle the Complaint "restored" event.
     */
    public function restored(Complaint $complaint): void
    {
        //
    }

    /**
     * Handle the Complaint "force deleted" event.
     */
    public function forceDeleted(Complaint $complaint): void
    {
        //
    }
}
