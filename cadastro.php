<?php
    include_once("templates/headerLogin.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="shortcut icon" href="img/pizza.svg" type="image/x-icon">
    <style>
        

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 300px;
            width: 100%;
        }

        input {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .login-button {
            background-color: #008CBA;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form action="process/processCadastro.php" method="post">
        <h2>Cadastro</h2>
        <?php
            // Exibir mensagens de erro, se houver
            if(isset($_GET['error'])) {
                echo '<p style="color: red;">'.$_GET['error'].'</p>';
            } elseif(isset($_GET['success'])) {
                echo '<p style="color: green;">'.$_GET['success'].'</p>';
            }
        ?>
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" class="login-button">Cadastrar</button>

        <button class="login-button" type="button" onclick="location.href='login.php'">Voltar para Login</button>
    </form>
</body>
</html>
