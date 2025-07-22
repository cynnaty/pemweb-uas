<?php

namespace App\Filament\Admin\Resources\PanitiaResource\Pages;

use App\Filament\Admin\Resources\PanitiaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPanitias extends ListRecords
{
    protected static string $resource = PanitiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
