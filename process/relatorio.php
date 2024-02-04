<style>
    /* Estilo para as tabelas */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    
}

/* Estilo para as células do cabeçalho */
th {
    background-color: #333;
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    color: #fff;
    
}

/* Estilo para as células dos dados */
td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

/* Estilo para linhas alternadas (opcional) */
tr:nth-child(even) {
    background-color: #fff;
}

</style>









<?php
include_once("conn.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["relatorio"])) {
    $relatorioId = $_POST["relatorio"];


    $query = "";
    $titulo = "";
    $colunas = [];


    switch ($relatorioId) {
        case "pedidos":
            $query = "SELECT * FROM pedidos";
            $titulo = "Relatório de Pedidos";
            $colunas = ["id", "pizza_id", "preco_total"];
            break;
        case "ingredientes":
            $query = "SELECT * FROM ingredientes";
            $titulo = "Relatório de Ingredientes";
            $colunas = ["id", "nome", "preco"];
            break;
        case "usuarios":
            $query = "SELECT * FROM usuarios";
            $titulo = "Relatório de Usuários";
            $colunas = ["id", "username", "password"];
            break;
        default:
            
            echo "Relatório não encontrado.";
            exit();
    }

    $result = $conn->query($query);

    if ($result) {
        echo "<h2>$titulo</h2>";
        echo "<table border='1'>
                <tr>";

        
        foreach ($colunas as $coluna) {
            echo "<th>$coluna</th>";
        }

        echo "</tr>";

        
        if ($result->rowCount() > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";

                
                foreach ($colunas as $coluna) {
                    echo "<td>{$row[$coluna]}</td>";
                }

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='" . count($colunas) . "'>Nenhum registro encontrado.</td></tr>";
        }

        echo "</table>";
    } else {
        echo "Erro na consulta: " . $conn->errorInfo()[2];
    }
}


$conn = null;
?>
