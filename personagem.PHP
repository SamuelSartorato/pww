<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Detalhes do Personagem</title>
    <style>
        .character-details {
            margin: 20px;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .character-details img {
            max-width: 100%;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .character-details h2 {
            margin-bottom: 20px;
        }

        .attribute-list {
            list-style: none;
            padding: 0;
        }

        .attribute-list li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
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

        if (isset($_GET["nome_personagem"])) {
            $nome_personagem = $_GET["nome_personagem"];

            // Consulta SQL para obter os detalhes do personagem
            $sqlDetails = "SELECT * FROM estudo WHERE nome_personagem = '$nome_personagem'";
            $resultDetails = $conn->query($sqlDetails);

            if ($resultDetails && $resultDetails->num_rows > 0) {
                $characterDetails = $resultDetails->fetch_assoc();
                ?>
                <h1 class="text-center mt-4">Detalhes do Personagem</h1>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="character-details">
                            <h2><?= $characterDetails["nome_personagem"] ?></h2>
                            <ul class="attribute-list">
                                <li><strong>Força:</strong> <?= $characterDetails["Forca"] ?></li>
                                <li><strong>Agilidade:</strong> <?= $characterDetails["Agilidade"] ?></li>
                                <li><strong>Presença:</strong> <?= $characterDetails["Presenca"] ?></li>
                                <li><strong>Inteligência:</strong> <?= $characterDetails["Intelecto"] ?></li>
                                <li><strong>Vigor:</strong> <?= $characterDetails["Vigor"] ?></li>
                                <li><strong>Origem:</strong> <?= $characterDetails["Origem"] ?></li>
                                <li><strong>NEX:</strong> <?= $characterDetails["Nex"] ?></li>
                                <!-- Adicione outros atributos conforme necessário -->
                            </ul>
                            <a href="fichas.html" class="btn btn-primary">Voltar</a>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo '<p class="text-center">Detalhes do personagem não encontrados.</p>';
            }
        } else {
            echo '<p class="text-center">ID do personagem não fornecido.</p>';
        }
        ?>
    </div>

    <!-- Adicione o script aqui se necessário -->

</body>
</html>
