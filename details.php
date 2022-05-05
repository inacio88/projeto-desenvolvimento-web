<?php

    include('config/db_connect.php');

    //Deletar
    if(isset($_POST['delete'])){
       

        $id_to_delete = $_POST['id_to_delete'];

        try {
            $stmt = $pdo->prepare("DELETE FROM pedidos WHERE id = :id");
            $stmt->bindParam(':id', $id_to_delete);
            $stmt->execute();
            header('Location: index.php');
            
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    //Editar
    if(isset($_POST['edit'])){
       

        $id = $_POST['id_to_edit'];
        $nomePedido = $_POST['nomePedido'];
        $email = $_POST['email'];
        $adicionais = $_POST['adicionais'];
        // $nomePedido = "pedido5";
        // $email = "b5@mail.com";
        // $adicionais = "dddddd";

        try {
            $stmt = $pdo->prepare('UPDATE pedidos SET nomePedido = :nomePedido, email = :email, adicionais = :adicionais WHERE id = :id ');
            $stmt->execute(array(
                ':id' => $id,
                ':nomePedido' => $nomePedido,
                ':email' => $email,
                ':adicionais' => $adicionais
            ));
            header('Location: index.php');
            
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


    //checar get request id parametro
    if (isset($_GET['id'])) {
       

        //------------------------------------------------------------
        //-----------------------------PDO----------------------------
        //------------------------------------------------------------
        $id = $_GET['id'];
        $consulta = $pdo->query("SELECT * FROM pedidos WHERE id = $id;");
        $pedido = $consulta->fetch(PDO::FETCH_ASSOC);


    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include('templates/header.php'); ?>

    <div class="container center detalhe" >
        <?php if($pedido):  ?>

            <!-- <h4><?php  //echo htmlspecialchars($pedido['nomePedido']);  ?></h4>
            <p>Pedido feito por: <?php //echo htmlspecialchars($pedido['email']);  ?></p>
            <p><?php //echo date($pedido['created_at']);  ?></p>
            <h5>Adicionais</h5>
            <p><?php //echo htmlspecialchars($pedido['adicionais']);  ?></p> -->


            <form action="details.php" method="POST">
                <section class="detalhe">
                    <h5>Detalhes do pedido: <input name="nomePedido" type="text" value="<?php echo htmlspecialchars($pedido['nomePedido']);?>"></h5>
                    <p>Pedido feito por: <input name="email" type="text" value="<?php echo htmlspecialchars($pedido['email']);?>"> </p>
                    <h6>Adicionais</h6>
                    <p><input name="adicionais" type="text" value="<?php echo htmlspecialchars($pedido['adicionais']);  ?>"></p>
                    <p>Criado em: <?php echo date($pedido['created_at']); ?> </p>
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