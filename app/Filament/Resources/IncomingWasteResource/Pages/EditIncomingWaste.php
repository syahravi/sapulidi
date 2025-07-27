<?php

namespace App\Filament\Resources\IncomingWasteResource\Pages;

use App\Filament\Resources\IncomingWasteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIncomingWaste extends EditRecord
{
    protected static string $resource = IncomingWasteResource::class;

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
