<?php
$host = '127.0.0.1';
$usuario = 'root';
$senha = '';
$bancoDeDados = 'rpg';

$conn = new mysqli($host, $usuario, $senha, $bancoDeDados);

if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

function buscarPersonagemPorNome($conn, $nome_personagem) {
    $stmt = $conn->prepare("SELECT * FROM estudo WHERE nome_personagem = ?");
    $stmt->bind_param("s", $nome_personagem);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $personagem = $result->fetch_assoc();
        $stmt->close();
        return $personagem;
    } else {
        $stmt->close();
        return null; // Retorna null se o personagem não for encontrado
    }
}

function atualizarPersonagem($conn, $dados) {
    $stmt = $conn->prepare("UPDATE estudo SET NomeJogador=?, Classe=?, Origem=?, Nex=?, Forca=?, Agilidade=?, Presenca=?, Intelecto=?, Vigor=? WHERE nome_personagem=?");
    $stmt->bind_param("sssiiiiiis", $dados['NomeJogador'], $dados['Classe'], $dados['Origem'], $dados['Nex'], $dados['Forca'], $dados['Agilidade'], $dados['Presenca'], $dados['Intelecto'], $dados['Vigor'], $dados['nome_personagem']);
    
    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $dadosFormulario = [
        'NomeJogador' => $_POST['nome_jogador'],
        'nome_personagem' => $_POST['nome_personagem'],
        'Classe' => $_POST['classe'],
        'Origem' => $_POST['origem'],
        'Nex' => $_POST['nex'],
        'Forca' => $_POST['forca'],
        'Agilidade' => $_POST['agilidade'],
        'Presenca' => $_POST['presenca'],
        'Intelecto' => $_POST['intelecto'],
        'Vigor' => $_POST['vigor'],
    ];

    // Atualiza o personagem no banco de dados
    if (atualizarPersonagem($conn, $dadosFormulario)) {
        echo "Alterações salvas com sucesso!";
    } else {
        echo "Erro ao salvar as alterações.";
    }
}

// Se não houver nome_personagem, redireciona para a página de listagem
$nome_personagem = isset($_GET["nome_personagem"]) ? $_GET["nome_personagem"] : null;

if (!$nome_personagem) {
    header("Location: fichas.php");
    exit();
}

// Lógica para preencher o formulário no modo de edição
$personagem = buscarPersonagemPorNome($conn, $nome_personagem);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://getbootstrap.com/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Personagem</title>
</head>
<body class="text-center">
    <div class="porra">
        <div class="">
            <div class="col-4 offset-4" style="margin-top: 70px;">
                <form method="post" action="">
                   <input type="hidden" name="nome_personagem" value="<?php echo isset($personagem['nome_personagem']) ? $personagem['nome_personagem'] : ''; ?>">
                    <table class="table">
                        <tr>
                            <th>Atributos</th>
                            <th>SOMA</th>
                        </tr>
                        <tr>
                            <td>Nome do Jogador</td>
                            <td><input type="text" value="<?php echo isset($personagem['NomeJogador']) ? $personagem['NomeJogador'] : ''; ?>" name="nome_jogador" required></td>
                        </tr>
                        <tr>
                            <td>Nome do Personagem</td>
                            <td><input type="text" value="<?php echo isset($personagem['nome_personagem']) ? $personagem['nome_personagem'] : ''; ?>" name="nome_personagem" required></td>
                        </tr>
                       <tr>
                            <td>Classe</td>
                            <td><input type="text" value="<?php echo isset($personagem['Classe']) ? $personagem['Classe'] : ''; ?>" name="classe" required></td>
                        </tr>
                        <tr>
                            <td>Origem</td>
                            <td><input type="text" value="<?php echo isset($personagem['Origem']) ? $personagem['Origem'] : ''; ?>" name="origem" required></td>
                        </tr>
                        <tr>
                            <td>NEX</td>
                            <td><input type="number" value="<?php echo isset($personagem['Nex']) ? $personagem['Nex'] : ''; ?>" name="nex" max="99" required></td>
                        </tr>
                        <tr>
                            <td>Força</td>
                            <td><input type="number" value="<?php echo isset($personagem['Forca']) ? $personagem['Forca'] : ''; ?>" name="forca" required></td>
                        </tr>
                        <tr>
                            <td>Agilidade</td>
                            <td><input type="number" value="<?php echo isset($personagem['Agilidade']) ? $personagem['Agilidade'] : ''; ?>" name="agilidade" required></td>
                        </tr>
                        <tr>
                            <td>Presença</td>
                            <td><input type="number" value="<?php echo isset($personagem['Presenca']) ? $personagem['Presenca'] : ''; ?>" name="presenca" required></td>
                        </tr>
                        <tr>
                            <td>Inteligencia</td>
                            <td><input type="number" value="<?php echo isset($personagem['Intelecto']) ? $personagem['Intelecto'] : ''; ?>" name="intelecto" required></td>
                        </tr>
                        <tr>
                            <td>Vigor</td>
                            <td><input type="number" value="<?php echo isset($personagem['Vigor']) ? $personagem['Vigor'] : ''; ?>" name="vigor" required></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</body>
</html>