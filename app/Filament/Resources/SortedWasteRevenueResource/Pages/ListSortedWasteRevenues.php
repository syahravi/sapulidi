<?php

namespace App\Filament\Resources\SortedWasteRevenueResource\Pages;

use App\Filament\Resources\SortedWasteRevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSortedWasteRevenues extends ListRecords
{
    protected static string $resource = SortedWasteRevenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
