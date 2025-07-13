<?php

namespace App\Filament\Resources\SortedWasteResource\Pages;

use App\Filament\Resources\SortedWasteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSortedWaste extends EditRecord
{
    protected static string $resource = SortedWasteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
