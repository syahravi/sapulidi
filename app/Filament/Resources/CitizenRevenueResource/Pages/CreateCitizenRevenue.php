<?php

namespace App\Filament\Resources\CitizenRevenueResource\Pages;

use App\Filament\Resources\CitizenRevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCitizenRevenue extends CreateRecord
{
    protected static string $resource = CitizenRevenueResource::class;
    protected static bool $canCreateAnother = false;

    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('create')
                ->label('Simpan')
                ->submit('create'),

            Actions\Action::make('cancel')
                ->label('Kembali')
                ->url(static::getResource()::getUrl())
                ->color('secondary'),
        ];
    }

    // Override redirect URL after create
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
