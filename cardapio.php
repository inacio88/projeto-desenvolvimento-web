<?php

include('config/db_connect.php');

// Conexão por PDO
$consulta = $pdo->query("SELECT id, nomePrato, preco, tempoPreparo, ingredientes FROM cardapio ORDER BY nomePrato;");
$pratos = $consulta->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="pt-br">

    <?php include('templates/header.php'); ?>

    <h4 class="center grey-text">pratos</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pratos as $prato): ?>
                <div class="col s6 md3">
                    <div class="card">
                        <img src="img/pizza.svg" class="pizza">
                        <div class="card-content center">
                            <h5><?php echo htmlspecialchars($prato['nomePrato']);?></h5>
                            <p>Preço: R$ <?php echo htmlspecialchars($prato['preco']);?></p>
                            <p>Tempo de preparo: <?php echo htmlspecialchars($prato['tempoPreparo']);?>min</p>
                            <ul>ingredientes:
                                <?php foreach (explode(',', $prato['ingredientes']) as $ing ): ?>
                                    <li> <?php echo htmlspecialchars($ing); ?> </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-align">
                            <a href="form_details.php?id=<?php echo $prato['id'] ?>" class="brand-text">Mais informações</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php include('templates/footer.php'); ?>
    

</html>