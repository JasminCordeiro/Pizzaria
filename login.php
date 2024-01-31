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
    <link rel="stylesheet" href="css/login.css">
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
    </form>
    </div>
</body>
</html>
<?php
    include_once("templates/footer.php");
?>