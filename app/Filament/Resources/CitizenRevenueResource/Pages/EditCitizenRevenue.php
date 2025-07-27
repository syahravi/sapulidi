<?php

namespace App\Filament\Resources\CitizenRevenueResource\Pages;

use App\Filament\Resources\CitizenRevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCitizenRevenue extends EditRecord
{
    protected static string $resource = CitizenRevenueResource::class;
    protected function getFormActions(): array
    {
        return [
            Actions\Action::make('save')
                ->label('Simpan')
                ->submit('save'),

            Actions\Action::make('cancel')
                ->label('Kembali')
                ->url(static::getResource()::getUrl())
                ->color('secondary'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
