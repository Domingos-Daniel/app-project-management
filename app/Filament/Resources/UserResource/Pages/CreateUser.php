<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Mail\WelcomeNewUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;



    protected function afterCreate()
    {
       // $password = $this->record->password; // Gere uma senha temporária aleatória
        $temp = '12345678';
    
        // Enviar email de boas-vindas para o usuário cadastrado
        try {
            Mail::to($this->record->email)
                ->send(new WelcomeNewUser($this->record, $temp));
    
            // Notificar sucesso no envio
            Notification::make()
                ->success()
                ->title('Email de boas-vindas enviado para ' . $this->record->email)
                ->send();

            Notification::make()
                ->success()
                ->title('Bem Vindo '. $this->record->name)
                ->body('Bem vindo ao sistema. Aconselhamos a alterar a sua palavra-passe.')
                ->persistent()
                ->sendToDatabase($this->record);

        } catch (\Exception $e) {
            // Notificar erro no envio
            Notification::make()
                ->danger()
                ->title('Erro ao enviar email para ' . $this->record->email . ': ' . $e->getMessage())
                ->send();

                Notification::make()
                ->success()
                ->title('Bem Vindo '. $this->record->name)
                ->body('Bem vindo ao sistema. Aconselhamos a alterar a sua palavra-passe.')
                ->persistent()
                ->sendToDatabase($this->record);
        }
    }

}