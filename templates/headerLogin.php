<?php 

    include("process/conn.php");

    $msg = "";

if(isset($_SESSION["msg"])){

    $msg = $_SESSION["msg"];
    $status = $_SESSION["status"];

    $_SESSION["msg"] = "";
    $_SESSION["status"] = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faça seu pedido!</title>
    <!--Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- App CSS --> 
    <link rel="stylesheet" href="css/styles.css">
    <!-- fav-icon --> 
    <link rel="shortcut icon" href="img/pizza.svg" type="image/x-icon">
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg">
        <a href="index.php" class="navbar-brand">
            <img src="img/pizza.svg" alt="Pizzaria" id="brand-logo">
        </a>
       


       </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a href="index.php" class="nav-link">Peça sua pizza</a>
                </li>
            </ul>
        </div>
        </nav>
    </header>
    <?php if($msg !=""):?>
        <div class="alert alert-<?= $status ?>">
            <p><?= $msg ?></p>
        </div>
    <?php endif; ?>



