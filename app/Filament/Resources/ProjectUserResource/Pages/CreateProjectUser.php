<?php

namespace App\Filament\Resources\ProjectUserResource\Pages;

use App\Filament\Resources\ProjectUserResource;
use App\Mail\ProjectAssigned;
use App\Mail\ProjectAssignedSupervisor;
use App\Models\Project;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateProjectUser extends CreateRecord
{
    protected static string $resource = ProjectUserResource::class;

    protected function afterCreate ()
    {
        // Obter o projeto associado ao ProjectUser
        $project = Project::find($this->record->project_id);
        // Obter o usuário atribuído
        $user = User::find($this->record->user_id);

        if(Mail::to($project->supervisor->email)
        ->send(new ProjectAssignedSupervisor($project, $user))){
                Notification::make()
                ->success()
                ->title('Email enviado para ' . $project->supervisor->email) 
                ->send();
            }else{
                Notification::make()
                ->danger()
                ->title('Erro ao enviar email para ' . $project->supervisor->email) 
                ->send();
            }
        
        // Obter os emails dos usuários atribuídos ao projeto
        

        // Enviar email para o usuário atribuído
            if(Mail::to($user->email)->send(new ProjectAssigned($project, $user))){
                Notification::make()
                ->success()
                ->title('Email enviado para ' . $user->email)
                ->send();
            }else{
                Notification::make()
                ->danger()
                ->title('Erro ao enviar email para ' . $user->email)
                ->send();
            }
    }
}
