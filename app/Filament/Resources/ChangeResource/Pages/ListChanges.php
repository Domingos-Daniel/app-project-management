<?php

namespace App\Filament\Resources\ChangeResource\Pages;

use App\Filament\Resources\ChangeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListChanges extends ListRecords
{
    protected static string $resource = ChangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
