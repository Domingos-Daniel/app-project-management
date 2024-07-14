<html>

    <head>
        <title>Novo Projeto Cadastrado</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                line-height: 1.6;
            }
            .container {
                max-width: 600px;
                margin: 0 auto;
                padding: 20px;
                border: 1px solid #ccc;
                border-radius: 5px;
                background-color: #f9f9f9;
            }
            h1 {
                color: #333;
            }
            ul {
                list-style-type: none;
                padding: 0;
            }
    </head>
    <body>
        <h1>{{ $project->name }}</h1>
        <p>Um novo projeto foi adicionado.</p>
        <p>Detalhes:</p>
        <ul>
            <li><strong>Nome:</strong> {{ $project->name }}</li>
            <li><strong>Descrição:</strong> {{ $project->description }}</li>
            <li><strong>Prioridade:</strong> {{ $project->priority }}</li>
            <li><strong>Data de Criação:</strong> {{ $project->created_at }}</li>
            <li><strong>Data de Entrega:</strong> {{ $project->end_date }}</li>
        </ul>
    </body>
</html>