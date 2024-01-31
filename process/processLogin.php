<?php
// Conectar ao banco de dados (substitua as informações de conexão conforme necessário)
$servername = "localhost:3307";
$username = "root";
$password = "Samlat03";
$dbname = "pizzaria";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Processar dados de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Substitua este trecho pela lógica de validação e autenticação adequada
    // (por exemplo, verificação de usuário/senha no banco de dados)
    // Este exemplo é simplificado e não seguro!
    $sql = "SELECT * FROM usuarios WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Verifique se o usuário é um administrador
        if($username === "admin") {
            header("Location: ../admin.php");
        } else{
            // Login bem-sucedido, redirecione para a página principal
            header("Location: ../dashboard.php");
    }
    } else {
        // Login falhou, redirecione com uma mensagem de erro
        header("Location: ../index.php?error=Nome de usuário ou senha incorretos");
    }
}

$conn->close();
?>