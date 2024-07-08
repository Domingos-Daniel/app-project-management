<?php

namespace App\Filament\Resources\ChangeResource\Pages;

use App\Filament\Resources\ChangeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditChange extends EditRecord
{
    protected static string $resource = ChangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
