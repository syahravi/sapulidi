<?php

namespace App\Filament\Resources\SortedWasteResource\Pages;

use App\Filament\Resources\SortedWasteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSortedWaste extends EditRecord
{
    protected static string $resource = SortedWasteResource::class;

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
