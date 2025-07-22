<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PanitiaResource\Pages;
use App\Filament\Admin\Resources\PanitiaResource\RelationManagers;
use App\Models\Panitia; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PanitiaResource extends Resource
{
    protected static ?string $model = Panitia::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Panitia'),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->label('Email Panitia'),

                Forms\Components\TextInput::make('tugas') 
                    ->required()
                    ->maxLength(255)
                    ->label('Tugas Panitia'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Panitia'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->label('Email Panitia'),

                Tables\Columns\TextColumn::make('tugas') 
                    ->searchable()
                    ->sortable()
                    ->label('Tugas'),

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
                //
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPanitias::route('/'),
            'create' => Pages\CreatePanitia::route('/create'),
            'edit' => Pages\EditPanitia::route('/{record}/edit'),
        ];
    }
}
