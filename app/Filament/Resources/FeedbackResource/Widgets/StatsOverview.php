<?php

namespace App\Filament\Resources\FeedbackResource\Widgets;

use App\Models\Complaint;
use App\Models\Feedback;
use App\Models\Suggestion;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Fourth row - Feedback and Suggestions
            Stat::make('Total Pengaduan', Complaint::count())
                ->icon('heroicon-o-exclamation-circle')
                ->color('Primary'),

            Stat::make('Total Feedback', Feedback::count())
                ->icon('heroicon-o-chat-bubble-left-ellipsis')
                ->color('secondary'),
                
            Stat::make('Total Saran', Suggestion::count())
                ->icon('heroicon-o-light-bulb')
                ->color('primary'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getHeading(): string
    {
        return 'Pengaduan & Aspirasi';
    }
}
