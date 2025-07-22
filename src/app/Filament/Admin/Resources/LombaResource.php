<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LombaResource\Pages;
use App\Filament\Admin\Resources\LombaResource\RelationManagers;
use App\Models\Lomba; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LombaResource extends Resource
{
    protected static ?string $model = Lomba::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_lomba')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Lomba'), 

                Forms\Components\Textarea::make('deskripsi')
                    ->nullable() 
                    ->rows(5) 
                    ->cols(10) 
                    ->label('Deskripsi Lomba'),

                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->required()
                    ->label('Tanggal Mulai'),

                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->required()
                    ->afterOrEqual('tanggal_mulai') 
                    ->label('Tanggal Selesai'),

                Forms\Components\TextInput::make('lokasi')
                    ->required()
                    ->maxLength(255)
                    ->label('Lokasi Lomba'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_lomba')
                    ->searchable() 
                    ->sortable() 
                    ->label('Nama Lomba'),

                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date() 
                    ->sortable()
                    ->label('Mulai'),

                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->sortable()
                    ->label('Selesai'),

                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable()
                    ->sortable()
                    ->label('Lokasi'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime() 
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true) 
                    ->label('Dibuat Pada'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('Diperbarui Pada'),
            ])
            ->filters([
               
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), 
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi di sini jika diperlukan, contoh:
            // RelationManagers\PesertasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLombas::route('/'),
            'create' => Pages\CreateLomba::route('/create'),
            'edit' => Pages\EditLomba::route('/{record}/edit'),
        ];
    }
}