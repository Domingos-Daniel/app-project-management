<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Mail\WelcomeNewUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Filament\Notifications\Notification;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;



    protected function afterCreate()
    {
        $id_user = $this->record->id;
        // Definir uma senha temporária
        $password = Str::random(8); // Gere uma senha temporária aleatória
        $this->record->password = bcrypt($password); // Criptografe a senha e salve no banco
        $this->record->save();
    
        // Enviar email de boas-vindas para o usuário cadastrado
        try {
            Mail::to($this->record->email)
                ->send(new WelcomeNewUser($this->record, $password));
    
            // Notificar sucesso no envio
            Notification::make()
                ->success()
                ->title('Email de boas-vindas enviado para ' . $this->record->email)
                ->send();

            Notification::make()
                ->success()
                ->title('Bem Vindo '. $this->record->name)
                ->body('Bem vindo ao sistema. Aconselhamos a alterar a sua palavra-passe. A sua palavra-passe temporária é: ' . $password)
                ->actions([
                    Actions\Action::make('Alterar Palavra-Passe')
                        ->url(fn () => route('filament.admin.pages.my-profile'))
                        ->openInNewTab(),
                ])
                ->persistent()
                ->inline()
                ->sendToDatabase($id_user);

        } catch (\Exception $e) {
            // Notificar erro no envio
            Notification::make()
                ->danger()
                ->title('Erro ao enviar email para ' . $this->record->email . ': ' . $e->getMessage())
                ->send();
        }
    }

}