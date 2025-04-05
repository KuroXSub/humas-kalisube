<?php

namespace App\Providers;
use App\Models\{
    User, 
    Complaint,
    Feedback,
    Suggestion
};
use App\Observers\{
    UserObserver,
    ComplaintObserver,
    FeedbackObserver,
    SuggestionObserver
};

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
        Complaint::observe(ComplaintObserver::class);
        Feedback::observe(FeedbackObserver::class);
        Suggestion::observe(SuggestionObserver::class);
    }
}
