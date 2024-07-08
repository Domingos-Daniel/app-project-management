<?php

namespace App\Filament\Resources\ProjectUserResource\Pages;

use App\Filament\Resources\ProjectUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProjectUser extends EditRecord
{
    protected static string $resource = ProjectUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
