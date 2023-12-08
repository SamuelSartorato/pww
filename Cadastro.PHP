<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Cadastro</title>
    <style>
        .error-message {
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .success-message {
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="login">
        <h2>Cadastro</h2>
        <br>
        <?php
        $message = "";  // Inicializa a variável de mensagem vazia

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];

            if (!empty($username) && !empty($password)) {
                $host = '127.0.0.1';
                $usuario = 'root';
                $senha = '';
                $bancoDeDados = 'rpg';

                // Criar uma conexão MySQLi
                $conn = new mysqli($host, $usuario, $senha, $bancoDeDados);

                // Verificar a conexão
                if ($conn->connect_error) {
                    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                }

                // Preparar e executar a consulta
                $cadastrarUsuario = $conn->prepare("INSERT INTO user (username, password) VALUES (?, ?)");
                $cadastrarUsuario->bind_param("ss", $username, $password);

                if ($cadastrarUsuario->execute()) {
                    $message = '<div class="success-message">Cadastro bem-sucedido! Aguarde enquanto você é redirecionado para fazer o login...</div>';

                    // Redirecionar para o arquivo de login após 2 segundos
                    header("refresh:2;url=login.php");
                } else {
                    $message = '<div class="error-message">Erro ao cadastrar usuário.</div>';
                }

                // Fechar a conexão
                $cadastrarUsuario->close();
                $conn->close();
            } else {
                // Se o formulário foi enviado, mas os campos estão vazios
                $message = '<div class="error-message">Por favor, preencha todos os campos.</div>';
            }
        }
        ?>
        
        <!-- Exibe a mensagem apenas se os dados foram enviados -->
        <?php echo $message; ?>

        <form action="" method="post">
            <label for="username">Usuário</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>
        
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>
