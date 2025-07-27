<?php

namespace App\Filament\Resources\IncomingWasteResource\Pages;

use App\Filament\Resources\IncomingWasteResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIncomingWaste extends CreateRecord
{
    protected static string $resource = IncomingWasteResource::class;
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
