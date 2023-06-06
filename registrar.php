<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION["autenticado"]) || $_SESSION["autenticado"] !== true) {
    header("Location: login.html");
    exit();
}

// Recuperar os dados do formulário
$nome = $_POST["nome"];
$tipoRegistro = $_POST["tipo_registro"];

// Conectar-se ao banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portaldocolaborador";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Construir e executar a consulta de inserção
$sql = "INSERT INTO registros (nome, tipo_registro) VALUES ('$nome', '$tipoRegistro')";

if ($conn->query($sql) === true) {
    $mensagem = "Registro realizado com sucesso.";
} else {
    $mensagem = "Erro ao registrar o ponto: " . $conn->error;
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Portal do Colaborador - Registro de Ponto</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h1 {
            color: #333333;
        }
    </style>
</head>
<body>
    <h1>Portal do Colaborador - Registro de Ponto</h1>
    <p><?php echo $mensagem; ?></p>
    <a href="registrar.html">Voltar</a>
</body>
</html>
