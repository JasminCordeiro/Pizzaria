<?php
    include_once("templates/header.php");
    include_once("process/pizza.php");

?>
    <div id="main-banner">
        <h1>Faça seu pedido</h1>
    </div>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Monte a pizza como desejar:</h2>    
                    <form action="process/pizza.php" method="POST" id="pizza-form">

                        <div class="form-group">
                            <label for="tamanho">Tamanho:</label>
                            <select name="tamanho" id="tamanho" class="form-control">
                                <option value="">Selecione o tamanho</option>
                                <?php foreach($tamanhos as $tamanho): ?>
                                    <option value="<?= $tamanho["id"] ?>" data-preco="<?= $tamanho["preco"] ?>"><?= $tamanho["tipo"] ?> - R$ <?= number_format($tamanho["preco"], 2, ',', '.') ?></option>                                
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="borda">Borda:</label>
                            <select name="borda" id="borda" class="form-control">
                                <option value="">Selecione a borda</option>
                                <?php foreach($bordas as $borda): ?>
                                    <option value="<?= $borda["id"] ?>" data-preco="<?= $borda["preco"] ?>"><?= $borda["tipo"] ?> - R$ <?= number_format($borda["preco"], 2, ',', '.') ?></option>
                                    
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="massa">Massa:</label>
                            <select name="massa" id="massa" class="form-control">
                
                            <option value="">Selecione a massa</option>
                                <?php foreach($massas as $massa): ?>
                                    <option value="<?= $massa["id"] ?>" data-preco="<?= $massa["preco"] ?>"><?= $massa["tipo"] ?> - R$ <?= number_format($massa["preco"], 2, ',', '.') ?></option>
                                <?php endforeach; ?>
                                
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="ingredientes">Ingredientes:</label>
                            <select multiple name="ingredientes[]" id="ingredientes" class="form-control">      
                                <?php foreach($ingredientes as $ingrediente): ?>
                                    <option value="<?= $ingrediente["id"] ?>" data-preco="<?= $ingrediente["preco"] ?>">
                                    <?= $ingrediente["nome"] ?> - R$ <?= number_format($ingrediente["preco"], 2, ',', '.') ?></option>    
                                <?php endforeach; ?>           
                            </select>
                        </div>

                        <div class="form-group">
                            <link href="dashboard.php">
                              <input type="submit" class="btn btn-primary" value="Fazer Pedido!">
                            </link>
                        </div>

                    </form>
                   
                    <p class="total-container">Total: R$ <span id="precoTotal">0.00</span></p>


                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="js/script.js"></script>
<?php
    include_once("templates/footer.php");
    
?>