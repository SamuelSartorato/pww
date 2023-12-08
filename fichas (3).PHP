<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./Fichas_files/bootstrap.min.css" rel="stylesheet">
    <title>Fichas</title>
    <style>
        .screen-card {
            margin: 10px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .screen-card h4 {
            margin-bottom: 10px;
        }

        .screen-card p {
            margin-bottom: 20px;
        }

        .btn-group {
            margin-top: 10px;
        }

        .btn-group a,
        .btn-group button {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mt-4">Fichas</h1>

        <?php
        // Conectar ao banco de dados
        $host = '127.0.0.1';
        $usuario = 'root';
        $senha = '';
        $bancoDeDados = 'rpg';

        $conn = new mysqli($host, $usuario, $senha, $bancoDeDados);

        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }

        // Operação de Leitura (Read)
        $sqlRead = "SELECT nome_personagem, NomeJogador FROM estudo";
        $result = $conn->query($sqlRead);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="screen-card">
                            <h4><?= $row["nome_personagem"] ?></h4>
                            <p><?= $row["NomeJogador"] ?></p>
                            <div class="btn-group">
                                <a href="personagem.php?nome_personagem=<?= $row["nome_personagem"] ?>" class="btn btn-primary">Exibir</a>
                                <a href="editar-rpg.PHP?nome_personagem=<?= $row["nome_personagem"] ?>" class="btn btn-danger text-white">Editar</a>
                                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" style="display: inline;">
                                    <input type="hidden" name="nome_personagem" value="<?= $row["nome_personagem"] ?>">
                                    <button type="submit" name="excluir" class="btn btn-danger text-white">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo '<p class="text-center">Nenhuma ficha encontrada.</p>';
        }

        // Operação de Criação (Create)
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["criar_ficha"])) {
            $nome_personagem = $_POST["nome_personagem"];
            $NomeJogador = $_POST["NomeJogador"];

            $sqlCreate = "INSERT INTO estudo (nome_personagem, NomeJogador) VALUES ('$nome_personagem', '$NomeJogador')";

            if ($conn->query($sqlCreate) === TRUE) {
                echo '<p class="text-success text-center">Registro criado com sucesso!</p>';
            } else {
                echo '<p class="text-danger text-center">Erro ao criar registro: ' . $conn->error . '</p>';
            }
        }

        // Operação de Exclusão (Delete)
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["excluir"])) {
            $nome_personagem = $_POST["nome_personagem"];

            $sqlDelete = "DELETE FROM estudo WHERE nome_personagem = '$nome_personagem'";

            if ($conn->query($sqlDelete) === TRUE) {
                echo '<p class="text-success text-center">Registro excluído com sucesso!</p>';
            } else {
                echo '<p class="text-danger text-center">Erro ao excluir registro: ' . $conn->error . '</p>';
            }
        }
        ?>

        <!-- Formulário para criar uma nova ficha -->
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="screen-card">
                    <input type="text" name="nome_personagem" placeholder="Nome do Personagem" required>
                    <input type="text" name="NomeJogador" placeholder="Nome do Jogador" required>
                    <button type="submit" name="criar_ficha" class="btn btn-success">Criar Ficha</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
