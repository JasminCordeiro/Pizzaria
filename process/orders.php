<?php

  include_once("conn.php");

  $method = $_SERVER["REQUEST_METHOD"];

  if($method === "GET") {

    $pedidosQuery = $conn->query("SELECT * FROM pedidos;");

    $pedidos = $pedidosQuery->fetchAll();

    $pizzas = [];

    // Montando pizza
    foreach($pedidos as $pedido) {

      $pizza = [];

      // definir um array para a pizza
      $pizza["id"] = $pedido["pizza_id"];

      // resgatando a pizza
      $pizzaQuery = $conn->prepare("SELECT * FROM pizzas WHERE id = :pizza_id");

      $pizzaQuery->bindParam(":pizza_id", $pizza["id"]);

      $pizzaQuery->execute();

      $pizzaData = $pizzaQuery->fetch(PDO::FETCH_ASSOC);

      // resgatando o tamanho da pizza


      $tamanhoQuery = $conn->prepare("SELECT * FROM tamanhos WHERE id = :tamanho_id");

      $tamanhoQuery->bindParam(":tamanho_id", $pizzaData["tamanho_id"]);

      $tamanhoQuery->execute();

      $tamanho = $tamanhoQuery->fetch(PDO::FETCH_ASSOC);

      $pizza["tamanho"] = $tamanho["tipo"];


      // resgatando a borda da pizza
      $bordaQuery = $conn->prepare("SELECT * FROM bordas WHERE id = :borda_id");

      $bordaQuery->bindParam(":borda_id", $pizzaData["borda_id"]);

      $bordaQuery->execute();

      $borda = $bordaQuery->fetch(PDO::FETCH_ASSOC);

      $pizza["borda"] = $borda["tipo"];

      // resgatando a borda da pizza
      $massaQuery = $conn->prepare("SELECT * FROM massas WHERE id = :massa_id");

      $massaQuery->bindParam(":massa_id", $pizzaData["massa_id"]);

      $massaQuery->execute();

      $massa = $massaQuery->fetch(PDO::FETCH_ASSOC);

      $pizza["massa"] = $massa["tipo"];

      // resgatando os ingredientes da pizza
      $ingredientesQuery = $conn->prepare("SELECT * FROM pizza_ingrediente WHERE pizza_id = :pizza_id");

      $ingredientesQuery->bindParam(":pizza_id", $pizza["id"]);

      $ingredientesQuery->execute();

      $ingredientes = $ingredientesQuery->fetchAll(PDO::FETCH_ASSOC);

      // resgatando o nome dos ingredientes
      $ingredientesDaPizza = [];

      $ingredienteQuery = $conn->prepare("SELECT * FROM ingredientes WHERE id = :ingrediente_id");

       //resgatando o preço total da pizza
       $pizza["precoTotal"] = $pedido["preco_total"];

      foreach($ingredientes as $ingrediente) {

        $ingredienteQuery->bindParam(":ingrediente_id", $ingrediente["ingrediente_id"]);

        $ingredienteQuery->execute();

        $ingredientePizza = $ingredienteQuery->fetch(PDO::FETCH_ASSOC);

        array_push($ingredientesDaPizza, $ingredientePizza["nome"]);

      }

      $pizza["ingredientes"] = $ingredientesDaPizza;

      // Adicionar o array de pizza, ao array das pizzas
      array_push($pizzas, $pizza);

    }


  } else if($method === "POST") {

    // verificando tipo de POST
    $type = $_POST["type"];

    // deletar pedido
    

      if ($type === "delete") {
        $selectedOrders = isset($_POST["selected_orders"]) ? $_POST["selected_orders"] : [];

        if (!empty($selectedOrders)) {
            $placeholders = implode(',', array_fill(0, count($selectedOrders), '?'));

            $deleteQuery = $conn->prepare("DELETE FROM pedidos WHERE pizza_id IN ($placeholders)");

            foreach ($selectedOrders as $index => $pizzaId) {
                $deleteQuery->bindValue($index + 1, $pizzaId, PDO::PARAM_INT);
            }

            $deleteQuery->execute();

            $_SESSION["msg"] = "Pedido(s) cancelado(s) com sucesso!";
            $_SESSION["status"] = "success";
        }
    } elseif ($type === "insert") {
        // Inserir novo pedido
        $pizzaId = $_POST["id"];
        $precoTotal = $_POST["preco_total"];

        $stmt = $conn->prepare("INSERT INTO pedidos (pizza_id, preco_total) VALUES (:pizza_id, :preco_total) ON DUPLICATE KEY UPDATE preco_total = :preco_total");
        $stmt->bindParam(":pizza_id", $pizzaId, PDO::PARAM_INT);
        $stmt->bindParam(":preco_total", $precoTotal, PDO::PARAM_STR);

        $stmt->execute();

        $_SESSION["msg"] = "Pedido inserido com sucesso!";
        $_SESSION["status"] = "success";
    }

      if (strpos($_SERVER['HTTP_REFERER'], 'admin.php') !== false) {
        header("Location: ../admin.php");
      } else {
        header("Location: ../dashboard.php");
      }
    
    exit();
  
  }
?>
