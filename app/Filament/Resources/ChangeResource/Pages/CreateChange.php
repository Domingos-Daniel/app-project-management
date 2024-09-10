<?php

namespace App\Filament\Resources\ChangeResource\Pages;

use App\Filament\Resources\ChangeResource;
use App\Mail\ProjectChange;
use Filament\Actions;
use Filament\Notifications\Livewire\Notifications;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class CreateChange extends CreateRecord
{
    protected static string $resource = ChangeResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function afterCreate()
    {
        // Obter o projeto associado à alteração
        $project = Project::find($this->record->project_id);

        // Obter o usuário que fez a alteração
        $userWhoUpdated = User::find($this->record->user_id);

        // Obter o supervisor do projeto
        $supervisor = User::find($project->supervisor_id);

        // Verificar se o supervisor e o usuário que fez a alteração existem
        if ($supervisor && $userWhoUpdated) {
            $emails = [$supervisor->email, $userWhoUpdated->email];

            // Enviar email para cada destinatário
            foreach ($emails as $email) {
                try {
                    Mail::to($email)->send(new ProjectChange($this->record, $project, $userWhoUpdated));
                    Notification::make()
                        ->success()
                        ->title('Email enviado para ' . $email)
                        ->send();
                } catch (\Exception $e) {
                    Notification::make()
                        ->danger()
                        ->title('Erro ao enviar email para ' . $email . ': ' . $e->getMessage())
                        ->send();
                }
            }
        } else {
            Notifications::make()
                ->danger()
                ->title('Não foi possível encontrar o supervisor ou o usuário que fez a alteração.')
                ->send();
        }
    }
}
