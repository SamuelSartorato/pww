<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
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
        <h2>Login</h2>
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
                $verificarUsuario = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
                $verificarUsuario->bind_param("ss", $username, $password);
                $verificarUsuario->execute();
                $result = $verificarUsuario->get_result();

                // Exibir mensagem de erro
                if ($result->num_rows > 0) {
                    $message = '<div class="success-message">Login bem-sucedido! Aguarde enquanto você é redirecionado...</div>';
                    
                    // Redirecionar para fichas.php após 2 segundos
                    header("refresh:2;url=fichas.php");
                } else {
                    $message = '<div class="error-message">Usuário ou senha incorretos.</div>';
                }

                // Fechar a conexão
                $verificarUsuario->close();
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
        
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
