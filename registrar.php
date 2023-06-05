<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "portaldocolaborador";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Processamento do formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $tipoRegistro = $_POST["tipo_registro"];

    // Inserir registro no banco de dados
    $sql = "INSERT INTO registros (nome, tipo_registro) VALUES ('$nome', '$tipoRegistro')";

    if ($conn->query($sql) === TRUE) {
        echo "Registro realizado com sucesso.";
    } else {
        echo "Erro ao registrar: " . $conn->error;
    }
}

$conn->close();
?>

