<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EncryptedFileResource\Pages;
use App\Models\EncryptedFile;
use App\Services\FileEncryptionService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EncryptedFileResource extends Resource
{
    protected static ?string $model = EncryptedFile::class;
    protected static ?string $navigationIcon = 'heroicon-o-lock-closed';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                
                Forms\Components\FileUpload::make('file')
                    ->required()
                    ->disk('local')
                    ->acceptedFileTypes([
                        'application/pdf',
                        'application/msword',
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                        'application/vnd.ms-excel',
                        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'image/jpeg',
                        'image/png'
                    ])
                    ->maxSize(10240)
                    ->directory('temp_uploads')
                    ->preserveFilenames()
                    ->moveFiles()
                    ->visibility('private')
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state) {
                            $set('original_name', $state->getClientOriginalName());
                            $set('file_type', $state->getClientOriginalExtension());
                        }
                    })
                    ->rule('file') // Pastikan ini adalah file valid
                    ->helperText('Maksimal 10MB. File akan dienkripsi setelah diupload'),
                
                Forms\Components\Hidden::make('original_name'),
                Forms\Components\Hidden::make('file_type'),
                Forms\Components\Hidden::make('encrypted_path'),
                Forms\Components\Hidden::make('key_hash'),
                
                Forms\Components\TextInput::make('encryption_key')
                    ->required()
                    ->password()
                    ->confirmed()
                    ->maxLength(255)
                    ->helperText('Kunci ini akan digunakan untuk enkripsi dan harus diberikan ke masyarakat'),
                
                Forms\Components\TextInput::make('encryption_key_confirmation')
                    ->required()
                    ->password()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_type')
                    ->label('Tipe File'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('copy_link')
                    ->label('Salin Link Publik')
                    ->icon('heroicon-o-link')
                    ->action(function (EncryptedFile $record) {
                        $url = route('file.show', $record);
                        \Filament\Notifications\Notification::make()
                            ->title('Link publik telah disalin')
                            ->body($url)
                            ->success()
                            ->send();
                        return $url;
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEncryptedFiles::route('/'),
            'create' => Pages\CreateEncryptedFile::route('/create'),
            'edit' => Pages\EditEncryptedFile::route('/{record}/edit'),
        ];
    }
}