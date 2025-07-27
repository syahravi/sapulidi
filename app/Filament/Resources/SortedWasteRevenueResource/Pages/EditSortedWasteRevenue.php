<?php

namespace App\Filament\Resources\SortedWasteRevenueResource\Pages;

use App\Filament\Resources\SortedWasteRevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSortedWasteRevenue extends EditRecord
{
    protected static string $resource = SortedWasteRevenueResource::class;

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
