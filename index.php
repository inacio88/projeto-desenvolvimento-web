<?php

include('config/db_connect.php');

// Conexão por PDO
$consulta = $pdo->query("SELECT nomePedido, adicionais, id FROM pedidos ORDER BY created_at;");
$pedidos = $consulta->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="pt-br">

    <?php include('templates/header.php'); ?>

    <h4 class="center grey-text">Pedidos</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pedidos as $pedido): ?>
                <div class="col s6 md3">
                    <div class="card">
                        <img src="img/pizza.svg" class="pizza">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pedido['nomePedido']);?></h6>
                            <ul>
                                <?php foreach (explode(',', $pedido['adicionais']) as $ing ): ?>
                                    <li> <?php echo htmlspecialchars($ing); ?> </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="form_details.php?id=<?php echo $pedido['id'] ?>" class="brand-text">Mais informações</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php include('templates/footer.php'); ?>
    

</html>