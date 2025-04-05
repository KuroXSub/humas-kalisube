<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\Category;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // First row - Users and Categories
            Stat::make('Total Masyarakat', User::masyarakat()->count())
                ->icon('heroicon-o-users')
                ->color('primary'),
                
            Stat::make('Total Kategori', Category::count())
                ->icon('heroicon-o-tag')
                ->color('info'),
        ];
    }

    protected function getColumns(): int
    {
        return 2;
    }

    protected function getHeading(): string
    {
        return 'Data Master';
    }
}