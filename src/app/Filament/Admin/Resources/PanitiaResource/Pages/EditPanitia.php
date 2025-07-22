<?php

namespace App\Filament\Admin\Resources\PanitiaResource\Pages;

use App\Filament\Admin\Resources\PanitiaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPanitia extends EditRecord
{
    protected static string $resource = PanitiaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
