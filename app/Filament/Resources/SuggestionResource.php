<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuggestionResource\Pages;
use App\Filament\Resources\SuggestionResource\RelationManagers;
use App\Models\Suggestion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuggestionResource extends Resource
{
    protected static ?string $model = Suggestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left-ellipsis';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Masyarakat')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->preload()
                    ->hiddenOn('edit')
                    ->options(function () {
                        return \App\Models\User::masyarakat()->pluck('name', 'id');
                    }),

                Forms\Components\TextInput::make('hashed_user')
                    ->label('User ID')
                    ->formatStateUsing(fn ($record) => $record ? $record->hashed_user : null)
                    ->disabled(fn ($record) => $record !== null)
                    ->visibleOn('edit'),
                Forms\Components\TextInput::make('judul')
                    ->label('Judul Saran')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi Saran')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hashed_user')
                    ->label('User ID')
                    ->sortable()
                    ->searchable(false),
                Tables\Columns\TextColumn::make('judul')->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Deleted At'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
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
            'index' => Pages\ListSuggestions::route('/'),
            'create' => Pages\CreateSuggestion::route('/create'),
            'edit' => Pages\EditSuggestion::route('/{record}/edit'),
        ];
    }
}
