<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Projeto Cadastrado</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; background-color: #f4f4f4; padding: 0; margin: 0;">
    <div style="max-width: 600px; margin: 20px auto; padding: 20px; background-color: #ffffff; border: 1px solid #dddddd; border-radius: 5px;">
        <h1 style="color: #333333; font-size: 24px; text-align: center;">Novo Projeto: {{ $project->name }}</h1>
        <p style="color: #555555; font-size: 16px;">Um novo projeto foi adicionado ao sistema.</p>
        <p style="color: #555555; font-size: 16px;">Aqui estão os detalhes do projeto:</p>
        <ul style="list-style-type: none; padding: 0;">
            <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Nome:</strong> {{ $project->name }}</li>
            <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Descrição:</strong> {{ $project->description }}</li>
            <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Prioridade:</strong> {{ $project->priority }}</li>
            <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Data de Criação:</strong> {{ $project->created_at }}</li>
            <li style="color: #333333; font-size: 16px; margin-bottom: 10px;"><strong>Data de Entrega:</strong> {{ $project->end_date }}</li>
        </ul>
        <p style="text-align: center; margin-top: 20px; font-size: 14px; color: #777777;">&copy; {{ date('Y') }} Todos os direitos reservados.</p>
    </div>
</body>

</html>
