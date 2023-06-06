<?php
session_start();

// Autenticação do usuário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    // Conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "portaldocolaborador";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Falha na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consultar o banco de dados para verificar as credenciais do usuário
    $sql = "SELECT id, nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Autenticação bem-sucedida
        $_SESSION["autenticado"] = true;

        $row = $result->fetch_assoc();
        $_SESSION["nomeUsuario"] = $row["nome"];

        header("Location: registrar.html");
        exit();
    } else {
        // Credenciais inválidas, redirecionar de volta para a página de login
        header("Location: login.html");
        exit();
    }

    $conn->close();
} else {
    header("Location: login.html");
    exit();
}
?>
