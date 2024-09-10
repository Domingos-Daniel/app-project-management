<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alteração no Projeto: {{ $project->name }}</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; padding: 0; margin: 0;">
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border: 1px solid #dddddd; border-radius: 5px;">
        <div style="background-color: #007bff; color: #ffffff; padding: 15px; text-align: center; border-radius: 5px 5px 0 0;">
            <h1 style="font-size: 24px; margin: 0;">Alteração no Projeto: {{ $change->title }}</h1>
        </div>
        <div style="padding: 20px;">
            <p style="color: #333333; font-size: 16px;">O projeto <strong>{{ $project->name }}</strong> recebeu uma alteração.</p>
            <p style="color: #333333; font-size: 16px;">Aqui estão os detalhes da alteração:</p>
            <ul style="list-style-type: none; padding: 0;">
                <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Título da Alteração:</strong> {{ $change->title }}</li>
                <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Descrição da Alteração:</strong> {{ $change->description }}</li>
                <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Razão:</strong> {{ $change->reason }}</li>
                <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Total Horas:</strong> {{ $change->thora }}</li>
                <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Aprovado:</strong> {{ $change->approved ? 'Sim' : 'Não' }}</li>
                <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Usuário que Alterou:</strong> {{ $userWhoUpdated->name }}</li>
                <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Data da Alteração:</strong> {{ $change->timestamp }}</li>
            </ul>
        </div>
        <div style="text-align: center; padding: 15px; background-color: #f9f9f9; border-top: 1px solid #dddddd; border-radius: 0 0 5px 5px;">
            <p style="color: #777777; font-size: 14px;">&copy; {{ date('Y') }} SafeQ. Todos os direitos reservados.</p>
        </div>
    </div>
</body>

</html>
