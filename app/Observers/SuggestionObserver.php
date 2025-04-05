<?php

namespace App\Observers;

use App\Models\Suggestion;
use App\Notifications\NewSuggestionNotification;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class SuggestionObserver
{
    /**
     * Handle the Suggestion "created" event.
     */
    public function created(Suggestion $suggestion): void
    {
        $admins = \App\Models\User::where('role', 'admin')->get();
        
        foreach ($admins as $admin) {
            Notification::make()
                ->title('Saran Baru')
                ->icon('heroicon-o-light-bulb')
                ->body(
                    "Judul: {$suggestion->judul}\n" .
                    "Deskripsi: " . substr($suggestion->deskripsi, 0, 80) . 
                    (strlen($suggestion->deskripsi) > 80 ? '...' : '')
                )
                ->sendToDatabase($admin);
        }
    }

    /**
     * Handle the Suggestion "updated" event.
     */
    public function updated(Suggestion $suggestion): void
    {
        if ($suggestion->isDirty(['judul', 'deskripsi'])) {
            $changes = [];
            if ($suggestion->isDirty('judul')) {
                $changes[] = "Judul: {$suggestion->getOriginal('judul')} → {$suggestion->judul}";
            }
            if ($suggestion->isDirty('deskripsi')) {
                $changes[] = "Deskripsi: " . substr($suggestion->deskripsi, 0, 50) . '...';
            }

            $message = "Perubahan pada Saran ID: {$suggestion->id}\n" . implode("\n", $changes);
            
            Notification::make()
                ->title('Update Saran')
                ->icon('heroicon-o-pencil')
                ->body($message)
                ->sendToDatabase($suggestion->user); // Notifikasi ke pembuat saran

            // Notifikasi ke admin
            $admins = \App\Models\User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                Notification::make()
                    ->title('Update Saran oleh User')
                    ->icon('heroicon-o-user')
                    ->body($message)
                    ->sendToDatabase($admin);
            }
        }
    }

    /**
     * Handle the Suggestion "deleted" event.
     */
    public function deleted(Suggestion $suggestion): void
    {
        //
    }

    /**
     * Handle the Suggestion "restored" event.
     */
    public function restored(Suggestion $suggestion): void
    {
        //
    }

    /**
     * Handle the Suggestion "force deleted" event.
     */
    public function forceDeleted(Suggestion $suggestion): void
    {
        //
    }
}
