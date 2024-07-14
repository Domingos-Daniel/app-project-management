<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Novo Projeto Atribuído</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 600px;
            margin: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        p {
            color: #666;
            line-height: 1.6;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            margin-bottom: 10px;
            color: #333;
        }
        li strong {
            color: #555;
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            color: #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $project->name }}</h1>
        </div>
        <p>Você foi atribuído a um novo projeto.</p>
        <p>Detalhes:</p>
        <ul>
            <li><strong>Nome do Projeto:</strong> {{ $project->name }}</li>
            <li><strong>Descrição:</strong> {{ $project->description }}</li>
            <li><strong>Data de Entrega:</strong> {{ $project->end_date }}</li>
            <li><strong>Grau de Prioridade:</strong> {{ $project->priority }}</li>
            <li><strong>Supervisor:</strong> {{ $project->supervisor->name }}</li>
            <li><strong>Data de Atribuição:</strong> {{ $project->created_at }}</li>
        </ul>
        <div class="footer">
            <p>&copy; {{ date('Y') }} SafeQ. Todos os direitos reservados.</p>
        </div>
    </div>
</body>
</html>
