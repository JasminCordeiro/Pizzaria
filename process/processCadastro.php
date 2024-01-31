<?php

include_once("../process/conn.php");

class Cadastro {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function cadastrarUsuario($username, $password) {
        // Verifica se o username já existe
        $query = $this->conn->prepare("SELECT * FROM usuarios WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();

        if ($query->rowCount() > 0) {
            return "Username já existe. Escolha outro.";
        }

        // Criação do hash da senha
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insere novo usuário no banco de dados
        $query = $this->conn->prepare("INSERT INTO usuarios (username, password) VALUES (:username, :password)");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $hashedPassword);

        if ($query->execute()) {
            return "Usuário criado com sucesso!";
        } else {
            return "Erro ao cadastrar usuário.";
        }
    }

    public function logarUsuario($username, $password) {
        // Verifica se o usuário é um administrador
        if ($username === 'admin' && $password === 'admin') {
            header("Location: admin.php");
            exit();
        }

        // Caso contrário, verifica as credenciais no banco de dados
        $query = $this->conn->prepare("SELECT * FROM usuarios WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();

        if ($query->rowCount() > 0) {
            $user = $query->fetch(PDO::FETCH_ASSOC);

            // Verifica a senha
            if (password_verify($password, $user['password'])) {
                header("Location: dashboard.php");
                exit();
            } else {
                return "Senha incorreta.";
            }
        } else {
            return "Usuário não encontrado.";
        }
    }
}

?>
