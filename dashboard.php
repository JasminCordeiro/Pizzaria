<?php
    include_once("templates/headerLogin.php");
    include_once("process/orders.php");

?>
<style>

.select-container {
    position: relative;
    display: inline-block;
}

.select-container select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
    background-color: #fff;
    cursor: pointer;
}

.select-container::after {
    content: '\25BC'; /* Símbolo de seta para baixo ▼ */
    font-size: 16px;
    color: #555;
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
}

/* Estilo para os botões (apenas para referência, ajuste conforme necessário) */

.confirm-btn, .delete-btn {
    padding: 10px 20px;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    color: #fff;
}

.confirm-btn {
    background-color: #4caf50; /* Verde */
}

.delete-btn {
    background-color: #f44336; /* Vermelho */
}
</style>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Confira seu Pedido:</h2>
                </div>
                <div class="col-md-12 table-container">
                    <table class="table">
                     <thead>
                        <tr>
                            <th scope="col"><span>Pedido</span></th>
                            <th scope="col"><span>Tamanho</span></th>
                            <th scope="col"><span>Borda</span></th>
                            <th scope="col"><span>Massa</span></th>
                            <th scope="col"><span>Ingredientes</span></th>
                            <th scope="col"><span>Preço</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pizzas as $pizza):?>
                            <?php $precoTotal = isset($pizza["precoTotal"]) ? $pizza["precoTotal"] : 0; ?>
                            <tr>
                            <td><input type="checkbox" name="selected_orders[]" value="<?=$pizza["id"] ?>"></td>
                            <td><?=$pizza["tamanho"] ?></td>
                            <td><?=$pizza["borda"] ?></td>
                            <td><?=$pizza["massa"] ?></td>
                            
                            <td>
                                <ul class="ingredientes-list" >
                                <?php foreach($pizza["ingredientes"] as $ingrediente):?>
                                    <li><?= $ingrediente; ?></li>
                                <?php endforeach;?>

                                </ul>
                            </td>
                            <td>R$ <?= number_format($precoTotal, 2, ',', '.') ?></td>
                            </tr>

                            
                        <?php endforeach;?>
                    </tbody>
                  </table>
                  </div>
            <!-- Botões de confirmação e cancelamento de pedido -->
            <div class="col-md-12 mt-4 mb-4">
                <button class="confirm-btn" onclick="confirmarPedido()">
                    <p class="confirm">Confirmar Pedido <i class="fas fa-check"></i></p>
                </button>
            </div>
            <div class="col-md-12 mb-4">
                <form action="process/orders.php" method="POST" id="cancelForm">
                    <input type="hidden" name="type" value="delete">
                    <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                    <button type="submit" class="delete-btn" onclick="cancelarPedido()">
                        <p class="cancel">Cancelar o pedido <i class="fas fa-times"></i></p>
                    </button>
                </form>
            </div>
            <div class="col-md-12 mb-4">
        <!-- Adicionando um select com opções de método de pagamento -->
        <label for="metodoPagamento">Método de Pagamento:</label>
        <select name="metodoPagamento" id="metodoPagamento" class="form-control">
            <option value="cartao">Cartão de Crédito</option>
            <option value="boleto">Boleto Bancário</option>
            <option value="paypal">PayPal</option>
            <!-- Adicione mais opções conforme necessário -->
        </select>
    </div>
        </div>
    </div>

    <script>
    function confirmarPedido() {
    var selectedOrders = document.querySelectorAll('input[name="selected_orders[]"]:checked');
    if (selectedOrders.length > 0) {
        alert("Pedido confirmado! Redirecionando para a página de confirmação...");
        window.location.href = "index.php";
    } else {
        alert("Por favor, selecione pelo menos um pedido para confirmar.");
    }
}
    function cancelarPedido() {
    var selectedOrders = document.querySelectorAll('input[name="selected_orders[]"]:checked');
    if (selectedOrders.length > 0) {
        var cancelForm = document.getElementById('cancelForm');
        selectedOrders.forEach(function(order) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_orders[]';
            input.value = order.value;
            cancelForm.appendChild(input);
        });
        cancelForm.submit();
    } else {
        alert("Por favor, selecione pelo menos um pedido para cancelar.");
    }
}

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];
    if ($type === 'delete') {
        $id = $_POST['id'];
        // Substitua com a consulta SQL correta para excluir um pedido
        $query = "DELETE FROM pedidos WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $_SESSION['message'] = 'Pedido excluído com sucesso';
        } else {
            $_SESSION['message'] = 'Erro ao excluir pedido';
        }
        header('Location: ../dashboard.php');
        exit();
    }
}
?>
</script>
<?php
    include_once("templates/footer.php");
?>