<?php

namespace App\Filament\Resources\WasteTypeResource\Pages;

use App\Filament\Resources\WasteTypeResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateWasteType extends CreateRecord
{
    protected static string $resource = WasteTypeResource::class;
    protected static bool $canCreateAnother = false;

    protected function getFormActions(): array
    {
        return [
            Action::make('create')
                ->label('Simpan')
                ->submit('create'),

            Action::make('cancel')
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
