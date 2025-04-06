<?php

namespace App\Filament\Resources\EncryptedFileResource\Pages;

use App\Filament\Resources\EncryptedFileResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditEncryptedFile extends EditRecord
{
    protected static string $resource = EncryptedFileResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Jika encryption_key diubah, update hash
        if (isset($this->data['encryption_key']) && !empty($this->data['encryption_key'])) {
            $this->record->update([
                'key_hash' => Hash::make($this->data['encryption_key'])
            ]);
        }
    }
}
