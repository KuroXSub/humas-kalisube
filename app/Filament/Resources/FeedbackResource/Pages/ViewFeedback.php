<?php

namespace App\Filament\Resources\FeedbackResource\Pages;

use App\Filament\Resources\FeedbackResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;

class ViewFeedback extends ViewRecord
{
    protected static string $resource = FeedbackResource::class;

    protected function getActions(): array
    {
        return [
            // Nonaktifkan semua actions
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('complaint.id')
                ->label('ID Pengaduan')
                ->disabled(), // Nonaktifkan input
            Forms\Components\TextInput::make('user.name')
                ->label('Nama User')
                ->disabled(),
            Forms\Components\Textarea::make('komentar')
                ->label('Komentar')
                ->disabled(),
            Forms\Components\TextInput::make('rating')
                ->label('Rating')
                ->disabled(),
            Forms\Components\DateTimePicker::make('created_at')
                ->label('Dibuat Pada')
                ->disabled(),
        ];
    }
}
