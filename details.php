<?php

    include('config/db_connect.php');


    if(isset($_POST['delete'])){
        //$id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        
        //echo $id_to_delete;
        // $sql = "DELETE FROM pedidos WHERE id = $id_to_delete";
        // if (mysqli_query($conn, $sql)) {
        //     //sucesso
        //     header('Location: index.php');
        // }
        // else {
        //     //falha
        //     echo 'query error ' . mysqli_error($conn);
        // }

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
    


    //checar get request id parametro
    if (isset($_GET['id'])) {
        // $id = mysqli_real_escape_string($conn, $_GET['id']);

        // //a query
        // $sql = "SELECT * FROM pedidos WHERE id = $id";

        // // pegar o retorno da query

        // $result = mysqli_query($conn, $sql);

        // // pegar o retorno em formato de array associativo
        // $pedido = mysqli_fetch_assoc($result);

        // mysqli_free_result($result);
        // mysqli_close($conn);

        //print_r($pedido);

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

    <div class="container center">
        <?php if($pedido):  ?>

            <h4><?php  echo htmlspecialchars($pedido['nomePedido']);  ?></h4>
            <p>Pedido feito por: <?php echo htmlspecialchars($pedido['email']);  ?></p>
            <p><?php echo date($pedido['created_at']);  ?></p>
            <h5>Adicionais</h5>
            <p><?php echo htmlspecialchars($pedido['adicionais']);  ?></p>


            <!-- Deletar -->
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pedido['id'] ?>">
                <input type="submit" name="delete" value="Delete"  class="btn">
            </form>

        <?php  else: ?>
            <!-- fazer algo em javascript aqui -->
            <h5>Esse pedido não existe</h5>
        <?php  endif;  ?>
    </div>

<?php include('templates/footer.php'); ?>


</html>