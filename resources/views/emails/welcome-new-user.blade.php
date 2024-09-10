<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo, {{ $user->name }}!</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border-radius: 10px; border: 1px solid #dddddd;">
        <div style="background-color: #007bff; color: #ffffff; padding: 15px; border-radius: 10px 10px 0 0; text-align: center;">
            <h1 style="font-size: 24px; margin: 0;">Bem-vindo, {{ $user->name }}!</h1>
        </div>
        <div style="padding: 20px;">
            <p style="font-size: 16px; color: #333333;">Estamos muito felizes por você ter se juntado a nós! Utilize as informações abaixo para acessar sua conta:</p>
            <ul style="list-style-type: none; padding: 0;">
                <li style="font-size: 16px; color: #333333; margin-bottom: 10px;"><strong>Email:</strong> {{ $user->email }}</li>
                <li style="font-size: 16px; color: #333333; margin-bottom: 10px;"><strong>Senha Temporária:</strong> {{ $password }}</li>
            </ul>
            <p style="font-size: 16px; color: #333333;">Recomendamos que você altere sua senha o quanto antes após o primeiro login. Acesse o sistema usando o botão abaixo:</p>
            <div style="text-align: center; margin-top: 20px;">
                <a href="{{ route('filament.admin.auth.login') }}" style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-size: 16px;">Acessar Sistema</a>
            </div>
        </div>
        <div style="text-align: center; padding: 15px; background-color: #f9f9f9; border-top: 1px solid #dddddd; border-radius: 0 0 10px 10px;">
            <p style="color: #777777; font-size: 14px;">&copy; {{ date('Y') }} Sua Empresa. Todos os direitos reservados.</p>
        </div>
    </div>
</body>

</html>
