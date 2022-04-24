<?php

    include('config/db_connect.php');
    //checar get request id parametro
    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        //a query
        $sql = "SELECT * FROM pedidos WHERE id = $id";

        // pegar o retorno da query

        $result = mysqli_query($conn, $sql);

        // pegar o retorno em formato de array associativo
        $pedido = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($conn);

        //print_r($pedido);
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
        <?php  else: ?>
            <!-- fazer algo em javascript aqui -->
            <h5>Esse pedido não existe</h5>
        <?php  endif;  ?>
    </div>

<?php include('templates/footer.php'); ?>


</html>