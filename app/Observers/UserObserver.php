<?php

namespace App\Observers;

use App\Models\User;
use App\Notifications\NewUserNotification;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        // Kirim notifikasi hanya ke user dengan role 'admin'
        $admins = User::where('role', 'admin')->get();
        
        foreach ($admins as $admin) {
            Notification::make()
                ->title('User Baru Terdaftar')
                ->icon('heroicon-o-user')
                ->body("User {$user->name} ({$user->role}) baru saja mendaftar")
                ->sendToDatabase($admin);
        }
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
