<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ComplaintResource\Pages;
use App\Filament\Resources\ComplaintResource\RelationManagers;
use App\Models\Complaint;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComplaintResource extends Resource
{
    protected static ?string $model = Complaint::class;

    protected static ?string $navigationIcon = 'heroicon-o-exclamation-circle';

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
                    ->hiddenOn('edit') // Sembunyikan saat edit
                    ->options(function () {
                        return \App\Models\User::masyarakat()->pluck('name', 'id');
                    }),
                    
                Forms\Components\TextInput::make('hashed_user')
                    ->label('ID Pelapor')
                    ->formatStateUsing(fn ($record) => $record?->hashed_user)
                    ->disabled()
                    ->visibleOn('edit'), // Hanya tampil saat edit

                Forms\Components\Select::make('kategori_pengaduan_id')
                    ->label('Kategori Pengaduan')
                    ->relationship('kategoriPengaduan', 'nama_kategori')
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi Pengaduan')
                    ->required(),
                Forms\Components\Select::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'diproses' => 'Diproses',
                        'selesai' => 'Selesai',
                    ])
                    ->required(),
                Forms\Components\Select::make('prioritas')
                    ->options([
                        'rendah' => 'Rendah',
                        'sedang' => 'Sedang',
                        'tinggi' => 'Tinggi',
                    ])
                    ->required(),
                Forms\Components\Textarea::make('tanggapan')
                    ->label('Tanggapan')
                    ->nullable(),
                Forms\Components\Select::make('petugas_id')
                    ->label('Petugas')
                    ->relationship('petugas', 'name')
                    ->searchable()
                    ->preload()
                    ->options(function () {
                        return \App\Models\User::where('role', 'petugas')->pluck('name', 'id');
                    })
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hashed_user')
                    ->label('ID Pelapor')
                    ->sortable()
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        if (str_starts_with($search, 'User-')) {
                            return $query->where('user_hash', 'like', "%".substr($search, 5)."%");
                        }
                        return $query->whereHas('user', fn($q) => $q->where('name', 'like', "%{$search}%"));
                    }),
                Tables\Columns\TextColumn::make('kategoriPengaduan.nama_kategori')->sortable(),
                Tables\Columns\TextColumn::make('status')->sortable(),
                Tables\Columns\TextColumn::make('prioritas')->sortable(),
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
                // Tables\Actions\ForceDeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
                
                // Tables\Actions\ForceDeleteBulkAction::make(),
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
            'index' => Pages\ListComplaints::route('/'),
            'create' => Pages\CreateComplaint::route('/create'),
            'edit' => Pages\EditComplaint::route('/{record}/edit'),
        ];
    }
}
