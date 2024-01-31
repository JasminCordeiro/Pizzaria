<?php
    include_once("templates/headerLogin.php");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="shortcut icon" href="img/pizza.svg" type="image/x-icon">
    <style>
        .login-container{
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

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
        .signup-button {
            background-color: #008CBA;
            margin-top: 10px; /* Adicionei uma margem superior para separar os botões */
        }
    </style>
</head>
<body>
    <div class="login-container">
    <form action="process/processLogin.php" method="post">
        <h2>Login</h2>
        <?php
            // Exibir mensagens de erro, se houver
            if(isset($_GET['error'])) {
                echo '<p style="color: red;">'.$_GET['error'].'</p>';
            }
        ?>
        <label for="username">Usuário:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Senha:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Entrar</button>

        <button class="signup-button" type="button" onclick="location.href='cadastro.php'">Cadastrar</button>
    </form>
    </div>
</body>
</html>
<?php
    include_once("templates/footer.php");
?>