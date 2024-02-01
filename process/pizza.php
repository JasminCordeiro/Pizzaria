<?php 

    include_once("conn.php");



    $method = $_SERVER["REQUEST_METHOD"];

    if ($method === "GET") {

        $tamanhosQuery = $conn->query("SELECT * FROM tamanhos;");

        $tamanhos = $tamanhosQuery->fetchAll();


        $bordasQuery = $conn->query("SELECT * FROM bordas;");

        $bordas = $bordasQuery->fetchAll();

        
        $massasQuery = $conn->query("SELECT * FROM massas;");

        $massas = $massasQuery->fetchAll();

        
        $ingredientesQuery = $conn->query("SELECT * FROM ingredientes;");

        $ingredientes = $ingredientesQuery->fetchAll();
         
        
    } else if($method === "POST"){
        
        $data = $_POST;
        
        $tamanho = $data["tamanho"];
        $borda = $data["borda"];
        $massa = $data["massa"];
        $ingredientes = $data["ingredientes"];

        if (empty($_POST['tamanho']) || empty($_POST['borda']) || empty($_POST['massa'])) {

            $campoVazio = [];
            
            
            if(empty($_POST['tamanho'])){
                $campoVazio[] = 'tamanho';
            }
            if(empty($_POST['borda'])){
                $campoVazio[] = 'borda';
            }
            if(empty($_POST['massa'])){
                $campoVazio[] = 'massa';
            }

            $_SESSION["msg"] = "Selecione no mínimo uma opção para: " . implode(', ',$campoVazio);
            $_SESSION["status"] = "warning";

            
        } else {
            
            $stmt = $conn->prepare("INSERT INTO pizzas (borda_id, massa_id, tamanho_id) VALUES (:borda,:massa,:tamanho)");
            $stmt->bindParam(":tamanho", $tamanho, PDO::PARAM_INT);
            $stmt->bindParam(":borda", $borda, PDO::PARAM_INT);
            $stmt->bindParam(":massa", $massa, PDO::PARAM_INT);

            $stmt->execute();
            


            $pizzaId = $conn->lastInsertId();

            $stmt = $conn->prepare("INSERT INTO pizza_ingrediente (pizza_id, ingrediente_id) VALUES (:pizza,:ingrediente)");

            foreach($ingredientes as $ingrediente){
                $stmt->bindParam(":pizza", $pizzaId, PDO::PARAM_INT);
                $stmt->bindParam(":ingrediente", $ingrediente, PDO::PARAM_INT);

                $stmt->execute();

            }

            $stmt = $conn->prepare("INSERT INTO pedidos (pizza_id) VALUES (:pizza)");

            $statusId = 1;
            $stmt->bindParam(":pizza", $pizzaId);

            $stmt->execute();


            $_SESSION["msg"] = "Pedido realizado com sucesso!";
            $_SESSION["status"] = "success";

        }
        
        header("Location:..");

    }
    
?>