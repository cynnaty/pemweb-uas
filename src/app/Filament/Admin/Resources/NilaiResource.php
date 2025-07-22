<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\NilaiResource\Pages;
use App\Filament\Admin\Resources\NilaiResource\RelationManagers;
use App\Models\Nilai; 
use App\Models\Peserta; 
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-chart-bar'; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('peserta_id')
                    ->label('Peserta') 
                    ->relationship('peserta', 'nama') 
                    ->options(Peserta::all()->pluck('nama', 'id')) 
                    ->required()
                    ->searchable() 
                    ->preload(), 

                Forms\Components\TextInput::make('juri')
                    ->required()
                    ->maxLength(255)
                    ->label('Nama Juri'),

                Forms\Components\TextInput::make('skor')
                    ->numeric() 
                    ->required()
                    ->minValue(0) 
                    ->label('Skor'),

                Forms\Components\Textarea::make('komentar')
                    ->nullable()
                    ->rows(5)
                    ->cols(10)
                    ->label('Komentar'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                Tables\Columns\TextColumn::make('peserta.nama')
                    ->searchable()
                    ->sortable()
                    ->label('Nama Peserta'),

                Tables\Columns\TextColumn::make('juri')
                    ->searchable()
                    ->sortable()
                    ->label('Juri'),

                Tables\Columns\TextColumn::make('skor')
                    ->sortable()
                    ->label('Skor'),

                Tables\Columns\TextColumn::make('komentar')
                    ->wrap() 
                    ->limit(50)
                    ->label('Komentar'),

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
            'index' => Pages\ListNilais::route('/'),
            'create' => Pages\CreateNilai::route('/create'),
            'edit' => Pages\EditNilai::route('/{record}/edit'),
        ];
    }
}