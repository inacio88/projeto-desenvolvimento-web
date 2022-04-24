<?php
// Duas maneira de conectar com o mysql
// MySQLi (i significa improved) e PDO (php data object)
// MySQLi

$conn = mysqli_connect('localhost', 'db_user', '1234', 'restaurante_db');

//Checar a conexão
if (!$conn) {
    echo 'erro na conexão mysql' . mysqli_connect_error();
}

// query para os pedidos
$sql = 'SELECT nomePedido, adicionais, id FROM pedidos ORDER BY created_at';

// fazer a query e pegar os retornos
$result = mysqli_query($conn, $sql);

//Pegar o resultado como linhas em um array
$pedidos = mysqli_fetch_all($result, MYSQLI_ASSOC);

//Liberar o resultado da memória

mysqli_free_result($result);

//Fechar a conexão com o banco
mysqli_close($conn);

//Imprimindo o array
//print_r($pedidos);


//
//print_r(explode(',', $pedidos[0]['adicionais']));

?>

<!DOCTYPE html>
<html lang="pt-br">

    <?php include('templates/header.php'); ?>

    <h4 class="center grey-text">Pedidos</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pedidos as $pedido){ ?>
                <div class="col s6 md3">
                    <div class="card">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pedido['nomePedido']);?></h6>
                            <ul>
                                <?php foreach (explode(',', $pedido['adicionais']) as $ing ) { ?>
                                    <li> <?php echo htmlspecialchars($ing); ?> </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="#" class="brand-text">Mais informações</a>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>

    <?php include('templates/footer.php'); ?>
    

</html>