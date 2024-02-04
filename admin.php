<?php
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
            <form action="process/orders.php" method="POST" id="cancelForm">
                <input type="hidden" name="type" value="delete">
                
                <div class="row">
                    <?php foreach ($pizzas as $pizza) : ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body ">
                                    <h5 class="card-title"><h3>Pedido #<?= $pizza["id"]?>:</h3></h5>
                                    <br>
                                        <p class="card-text"><strong>Tamanho:</strong> <?= $pizza["tamanho"]?></p>
                                        <p class="card-text"><strong>Borda:</strong> <?= $pizza["borda"]?></p>
                                        <p class="card-text"><strong>Massa:</strong> <?= $pizza["massa"]?></p>
                                        <p class="card-text"><strong>Ingredientes:</strong>
                                            <ul class="ingredientes-list-adm">
                                                
                                                <?php foreach ($pizza["ingredientes"] as $ingrediente)  : ?>
                                                <li> <?= $ingrediente ?></li>
                                                <?php endforeach; ?>
                                            </ul> 
                                        </p>
                                            <p class="card-text" ><strong>Preço:</strong> <?= number_format($pizza["precoTotal"], 2, ',', '.')?></p>
                                            
                                            <input type="checkbox" name="selected_orders[]" value="<?= $pizza["id"] ?>">
                                </div>    
                            </div>    
                        
                </div>

                    <?php endforeach; ?>
                    </div>
                    <button type="submit" class="btn btn-danger" onclick="cancelarPedido()">Excluir Selecionados</button>
                    
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
                    <!-- Emissão de relatórios -->
                    <div class="col-md-12">
                    <h3 class="text-center">Relatórios</h3>
                    </div>       
                    <div class="row justify-content-center" id="relatorios">

                    <div class="col-md-4 mb-4 text-center">
                        <form action="process/relatorio.php" method="post">
                            <input type="hidden" name="relatorio" value="pedidos">
                            <button type="submit" class="btn btn-primary">Relatório de pedidos</button>
                        </form>
                    </div>

                    <div class="col-md-4 mb-4 text-center">
                        <form action="process/relatorio.php" method="post">
                            <input type="hidden" name="relatorio" value="ingredientes">
                            <button type="submit" class="btn btn-primary">Relatório de ingredientes</button>
                        </form>
                    </div>

                    <div class="col-md-4 mb-4 text-center">
                        <form action="process/relatorio.php" method="post">
                            <input type="hidden" name="relatorio" value="usuarios">
                            <button type="submit" class="btn btn-primary">Relatório de usuários</button>
                        </form>
                    </div>
            </div>


</div>



<?php
// Exemplo básico de inclusão de rodapé
include_once("templates/footer.php");
?>
