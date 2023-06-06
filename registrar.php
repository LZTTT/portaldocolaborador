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

// Autenticação do usuário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricula = $_POST["matricula"];
    $senha = $_POST["senha"];

    // Consultar o banco de dados para verificar as credenciais do usuário
    $sql = "SELECT id, nome FROM usuarios WHERE matricula = '$matricula' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Autenticação bem-sucedida
        $row = $result->fetch_assoc();
        $nomeUsuario = $row["nome"];
        $idUsuario = $row["id"];

        // Verificar qual botão foi clicado
        if (isset($_POST["tipo_registro"])) {
            $tipoRegistro = $_POST["tipo_registro"];
        }

        // Processamento do formulário
        if (!empty($tipoRegistro)) {
            $nome = $_POST["nome"];

            // Inserir registro no banco de dados
            $sql = "INSERT INTO registros (id_usuario, nome, tipo_registro) VALUES ('$idUsuario', '$nome', '$tipoRegistro')";

            if ($conn->query($sql) === TRUE) {
                echo "Registro realizado com sucesso. Bem-vindo, $nomeUsuario!";
            } else {
                echo "Erro ao registrar: " . $conn->error;
            }
        }
    } else {
        echo "Autenticação falhou. Verifique suas credenciais.";
    }
}

$conn->close();
?>
