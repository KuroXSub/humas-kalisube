<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FeedbackResource\Pages;
use App\Filament\Resources\FeedbackResource\RelationManagers;
use App\Models\Feedback;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeedbackResource extends Resource
{
    protected static ?string $model = Feedback::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('complaint_id')
                    ->label('ID Pengaduan')
                    ->relationship('complaint', 'id')
                    ->disabled(),
                Forms\Components\TextInput::make('hashed_user')
                    ->label('User ID')
                    ->formatStateUsing(fn ($record) => $record?->hashed_user)
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('complaint.id')->label('ID Pengaduan'),
                Tables\Columns\TextColumn::make('hashed_user')
                    ->label('User ID')
                    ->sortable()
                    ->searchable(false),
                Tables\Columns\TextColumn::make('komentar')->label('Komentar')->limit(50),
                Tables\Columns\TextColumn::make('rating')->label('Rating')->sortable(),
                Tables\Columns\TextColumn::make('created_at')->label('Dibuat Pada')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFeedback::route('/'),
            'view' => Pages\ViewFeedback::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canDelete($record): bool
    {
        return false;
    }
}
