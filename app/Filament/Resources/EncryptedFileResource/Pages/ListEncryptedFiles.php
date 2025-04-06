<?php

namespace App\Filament\Resources\EncryptedFileResource\Pages;

use App\Filament\Resources\EncryptedFileResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEncryptedFiles extends ListRecords
{
    protected static string $resource = EncryptedFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
