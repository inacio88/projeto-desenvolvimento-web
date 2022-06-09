<?php 
include('config/db_connect.php');
 //checar get request id parametro
 if (isset($_GET['id'])) {
       

    //------------------------------------------------------------
    //-----------------------------PDO----------------------------
    //------------------------------------------------------------
    $id = $_GET['id'];
    $consulta = $pdo->query("SELECT * FROM cardapio WHERE id = $id;");
    $pedido = $consulta->fetch(PDO::FETCH_ASSOC);


}
?>


<!DOCTYPE html>
<html lang="pt-br">

<?php include('templates/header.php'); ?>

    <div class="container center detalhe" >
        <?php if($pedido):  ?>

         


            <form action="details.php" method="POST">
                <section class="detalhe">
                    <h5>Detalhes do pedido: <input name="nomePrato" type="text" value="<?php echo htmlspecialchars($pedido['nomePrato']);?>"></h5>
                    <p>Preço: <input name="preco" type="text" value="<?php echo htmlspecialchars($pedido['preco']);?>"> </p>
                    <p>Tempo de preparo: <input name="tempoPreparo" type="text" value="<?php echo htmlspecialchars($pedido['tempoPreparo']);?>"> </p>
                    <h6>Ingredientes</h6>
                    <p><input name="ingredientes" type="text" value="<?php echo htmlspecialchars($pedido['ingredientes']);  ?>"></p>
                    
                </section>
                <div class='box'>
                    <!-- Editar -->
                        <div>    
                            <input type="hidden" name="id_to_edit" value="<?php echo $pedido['id'] ?>">
                            <input type="submit" name="edit" value="Salvar Aterações"  class="btn" >   
                        </div>
        
                
                    <!-- Deletar -->
                    <div>
                        <form action="details.php" method="POST">
                            <input type="hidden" name="id_to_delete" value="<?php echo $pedido['id'] ?>">
                            <input type="submit" name="delete" value="Deletar"  class="btn">
                        </form>
                    </div>
                
                </div>
            </form>   
            
        
            <?php  else: ?>
            <!-- fazer algo em javascript aqui -->
            <h5>Esse pedido não existe</h5>
        <?php  endif;  ?>
    </div>

<?php include('templates/footer.php'); ?>


</html>