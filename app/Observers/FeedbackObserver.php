<?php

namespace App\Observers;

use App\Models\Feedback;
use App\Notifications\NewFeedbackNotification;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class FeedbackObserver
{
    /**
     * Handle the Feedback "created" event.
     */
    public function created(Feedback $feedback): void
    {
        $recipients = \App\Models\User::where('role', 'admin')->get();

        foreach ($recipients as $recipient) {
            $ratingStars = str_repeat('⭐', $feedback->rating) . ($feedback->rating ? " ({$feedback->rating}/5)" : "Tanpa rating");

            Notification::make()
                ->title('**Feedback Baru**')
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->body(
                    "**Terhadap Pengaduan:** " . substr($feedback->complaint->deskripsi, 0, 50) . "...\n" .
                    "**Komentar:** " . substr($feedback->komentar, 0, 80) . "...\n" .
                    "**Rating:** {$ratingStars}"
                )
                ->sendToDatabase($recipient);
        }
    }

    /**
     * Handle the Feedback "updated" event.
     */
    public function updated(Feedback $feedback): void
    {
        //
    }

    /**
     * Handle the Feedback "deleted" event.
     */
    public function deleted(Feedback $feedback): void
    {
        //
    }

    /**
     * Handle the Feedback "restored" event.
     */
    public function restored(Feedback $feedback): void
    {
        //
    }

    /**
     * Handle the Feedback "force deleted" event.
     */
    public function forceDeleted(Feedback $feedback): void
    {
        //
    }
}
