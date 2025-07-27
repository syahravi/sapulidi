<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
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
