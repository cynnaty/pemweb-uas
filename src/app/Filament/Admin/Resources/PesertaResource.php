<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PesertaResource\Pages;
use App\Filament\Admin\Resources\PesertaResource\RelationManagers;
use App\Models\Peserta; 
use App\Models\Lomba;   
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PesertaResource extends Resource
{
    protected static ?string $model = Peserta::class;

    protected static ?string $navigationIcon = 'heroicon-o-users'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('lomba_id')
                    ->relationship('lomba', 'nama_lomba') 
                    ->required()
                    ->searchable() 
                    ->preload()    
                    ->label('Lomba'),

                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Peserta'),

                Forms\Components\TextInput::make('email')
                    ->email() 
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true) 
                    ->label('Email Peserta'),

                Forms\Components\TextInput::make('asal_sekolah')
                    ->required()
                    ->maxLength(255)
                    ->label('Asal Sekolah'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Peserta'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email'),

                Tables\Columns\TextColumn::make('asal_sekolah')
                    ->searchable()
                    ->sortable()
                    ->label('Asal Sekolah'),

                Tables\Columns\TextColumn::make('lomba.nama_lomba') 
                    ->searchable()
                    ->sortable()
                    ->label('Lomba Diikuti'),

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
            
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPesertas::route('/'),
            'create' => Pages\CreatePeserta::route('/create'),
            'edit' => Pages\EditPeserta::route('/{record}/edit'),
        ];
    }
}
