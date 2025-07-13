<?php

namespace App\Filament\Resources\IncomingWasteResource\Pages;

use App\Filament\Resources\IncomingWasteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncomingWaste extends EditRecord
{
    protected static string $resource = IncomingWasteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
