<?php

namespace App\Filament\Resources\SortedWasteRevenueResource\Pages;

use App\Filament\Resources\SortedWasteRevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSortedWasteRevenue extends EditRecord
{
    protected static string $resource = SortedWasteRevenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
