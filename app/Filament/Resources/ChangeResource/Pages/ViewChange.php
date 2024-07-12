<?php

namespace App\Filament\Resources\ChangeResource\Pages;

use App\Filament\Resources\ChangeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;
use Parallax\FilamentComments\Actions\CommentsAction;

class ViewChange extends ViewRecord
{
    protected static string $resource = ChangeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make()
            ->visible(fn () => Auth::user()->hasPermissionTo('can_see_all_projects')),
            CommentsAction::make(),
        ];
    }
}
