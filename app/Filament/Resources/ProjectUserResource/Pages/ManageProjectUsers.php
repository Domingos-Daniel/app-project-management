<?php

namespace App\Filament\Resources\ProjectUserResource\Pages;

use App\Filament\Resources\ProjectUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProjectUsers extends ManageRecords
{
    protected static string $resource = ProjectUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
