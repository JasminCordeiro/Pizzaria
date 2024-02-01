<?php
// Aqui você deve incluir suas configurações, classes e lógica necessárias

// Exemplo: include_once("config.php");
// Exemplo: include_once("classes/PedidoManager.php");
// Exemplo: Verifique as permissões do administrador antes de permitir o acesso a esta página

// Exemplo básico de inclusão de arquivos de configuração e lógica de pedidos
include_once("templates/headerLogin.php");
include_once("process/orders.php");

?>

<!-- Estrutura HTML da Página Admin -->
<div id="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Gerenciamento de Pedidos</h2>
            </div>
            <div class="col-md-12 table-container">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Pedido</th>
                            <th scope="col">Tamanho</th>
                            <th scope="col">Borda</th>
                            <th scope="col">Massa</th>
                            <th scope="col">Ingredientes</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pizzas as $pizza) : ?>
                            <tr>
                                <td><?= $pizza["id"] ?></td>
                                <td><?= $pizza["tamanho"] ?></td>
                                <td><?= $pizza["borda"] ?></td>
                                <td><?= $pizza["massa"] ?></td>
                                <td>
                                    <ul class="ingredientes-list">
                                        <?php foreach ($pizza["ingredientes"] as $ingrediente) : ?>
                                            <li><?= $ingrediente; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </td>
                                <td>
                                    <form action="process/orders.php" method="POST">
                                        <input type="hidden" name="type" value="delete">
                                        <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                                        <button typy="submit" class="btn btn-danger">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
// Exemplo básico de inclusão de rodapé
include_once("templates/footer.php");
?>
