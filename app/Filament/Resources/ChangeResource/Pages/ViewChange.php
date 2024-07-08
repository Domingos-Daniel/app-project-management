<?php

namespace App\Filament\Resources\ChangeResource\Pages;

use App\Filament\Resources\ChangeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewChange extends ViewRecord
{
    protected static string $resource = ChangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
