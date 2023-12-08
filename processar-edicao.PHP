<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["editar_ficha"])) {
    $host = '127.0.0.1';
    $usuario = 'root';
    $senha = '';
    $bancoDeDados = 'rpg';

    $conn = new mysqli($host, $usuario, $senha, $bancoDeDados);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $id = $_POST["id"];
    $nome_personagem = $_POST["nome_personagem"];
    // Adicione outros campos do formulário conforme necessário

    $sqlUpdate = "UPDATE estudo SET nome_personagem = '$nome_personagem' WHERE id = $id";

    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location: fichas.php");
        exit();
    } else {
        echo '<p class="text-danger text-center">Erro ao editar registro: ' . $conn->error . '</p>';
    }
} else {
    // Redirecionar para a página principal se alguém tentar acessar este script diretamente
    header("Location: fichas.php");
    exit();
}
?>