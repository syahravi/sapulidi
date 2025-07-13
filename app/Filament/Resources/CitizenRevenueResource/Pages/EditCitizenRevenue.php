<?php

namespace App\Filament\Resources\CitizenRevenueResource\Pages;

use App\Filament\Resources\CitizenRevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCitizenRevenue extends EditRecord
{
    protected static string $resource = CitizenRevenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
