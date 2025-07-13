<?php

namespace App\Filament\Resources\SortedWasteResource\Pages;

use App\Filament\Resources\SortedWasteResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSortedWastes extends ListRecords
{
    protected static string $resource = SortedWasteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
