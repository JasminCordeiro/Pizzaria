<?php
    include_once("templates/header.php");
    include_once("process/orders.php");

?>
    <div id="main-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Gerenciar pedidos:</h2>
                </div>
                <div class="col-md-12 table-container">
                    <table class="table">
                     <thead>
                        <tr>
                            <th scope="col"><span>Pedido</span></th>
                            <th scope="col"><span>Borda</span></th>
                            <th scope="col"><span>Massa</span></th>
                            <th scope="col"><span>Sabores</span></th>
                           <!-- <th scope="col">Status</th> -->
                            <th scope="col"><span></span></th>                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($pizzas as $pizza):?>
                            <tr>
                            <td>#<?=$pizza["id"] ?></td>
                            <td><?=$pizza["borda"] ?></td>
                            <td><?=$pizza["massa"] ?></td>
                            
                            <td>
                                <ul class="sabores-list" >
                                <?php foreach($pizza["sabores"] as $sabor):?>
                                    <li><?= $sabor; ?></li>
                                <?php endforeach;?>

                                </ul>
                            </td>

                             <!-- <td>
                                <form action="process/orders.php" method="POST"  class="form-group update-form">
                                    <input type="hidden" name="type" value="update">
                                    <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                                    <select name="status" class="form-control status-input">
                                        <?php foreach($status as $s):?>
                                        <option value="<?=$s["id"]?>"  <?php echo ($s["id"] == $pizza["status"]) ? "selected" : ""; ?> > <?=$s["tipo"]?></option>
                                        <?php endforeach;?>
                                    </select>
                                    <button type="submit" class="update-btn">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>

                                </form>
                                </td>  -->


                                <td>
                                <form action="process/orders.php" method="POST" >
                                    <input type="hidden" name="type" value="delete">
                                    <input type="hidden" name="id" value="<?= $pizza["id"] ?>">
                                    <button type="submit" class="delete-btn">
                                        <p class="cancel">Cancelar o pedido <i class="fas fa-times"></i></p>
                                        
                                    </button>
                                </form>
                            </td>
                            </tr>
                        <?php endforeach;?>
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once("templates/footer.php");
?>