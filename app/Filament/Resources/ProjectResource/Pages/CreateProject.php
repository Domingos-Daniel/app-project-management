<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Mail\ProjectAssigned;
use App\Mail\ProjectCreated;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateProject extends CreateRecord
{
    protected static string $resource = ProjectResource::class;

   

    protected function afterCreate()
    {
         // Obter todos os emails dos usuários
         $userEmails = User::pluck('email')->toArray();

         // Enviar email para cada usuário
         foreach ($userEmails as $email) {
            if(Mail::to($email)->send(new ProjectCreated($this->record))){
                Notification::make()
                ->success()
                ->title('Email enviado para ' . $email) 
                ->send();
            }else{
                Notification::make()
                ->danger()
                ->title('Erro ao enviar email para ' . $email) 
                ->send();
            }
         }

    }
}
