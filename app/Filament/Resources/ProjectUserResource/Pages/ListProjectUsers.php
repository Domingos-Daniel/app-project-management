<?php

namespace App\Filament\Resources\ProjectUserResource\Pages;

use App\Filament\Resources\ProjectUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProjectUsers extends ListRecords
{
    protected static string $resource = ProjectUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
