<?php

namespace App\Filament\Resources\ComplaintResource\Widgets;

use App\Models\Complaint;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $title = 'Pengaduan';

    protected function getStats(): array
    {
        return [
            // Second row - Complaint Status
            Stat::make('Pengaduan Menunggu', Complaint::where('status', 'menunggu')->count())
                ->icon('heroicon-o-clock')
                ->color('warning'),
                
            Stat::make('Pengaduan Diproses', Complaint::where('status', 'diproses')->count())
                ->icon('heroicon-o-arrow-path')
                ->color('info'),
                
            Stat::make('Pengaduan Selesai', Complaint::where('status', 'selesai')->count())
                ->icon('heroicon-o-check-circle')
                ->color('success'),

            // Third row - Complaint Priority
            Stat::make('Prioritas Rendah', Complaint::where('prioritas', 'rendah')->count())
                ->icon('heroicon-o-arrow-down')
                ->color('gray'),
                
            Stat::make('Prioritas Sedang', Complaint::where('prioritas', 'sedang')->count())
                ->icon('heroicon-o-minus')
                ->color('warning'),
                
            Stat::make('Prioritas Tinggi', Complaint::where('prioritas', 'tinggi')->count())
                ->icon('heroicon-o-arrow-up')
                ->color('danger'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getHeading(): string
    {
        return 'Pengaduan';
    }
}
