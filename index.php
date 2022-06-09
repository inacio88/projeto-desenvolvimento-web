<?php

include('config/db_connect.php');

// Conexão por PDO id, nomeCliente, idMesa, obs, pedido, estado
$consulta = $pdo->query("SELECT id, nomeCliente, idMesa, obs, pedido, estado FROM pedidos ORDER BY id;");
$pedidos = $consulta->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    
    <link rel="stylesheet" href="style.css">
    <title>Restaurante etc</title>
</head>


<body class="grey lighten-4">
    <nav class="white">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Restaurante etc</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
            <li><a href="addPrato.php" class="btn brand">Add prato</a></li>
            <li><a href="gerenciarPrato.php" class="btn brand">Gerenciar pratos</a></li>
            </ul>
        </div>
    </nav>

    <h4 class="center grey-text">Pedidos</h4>
    <div class="container">
        <div class="row">
            <?php foreach($pedidos as $pedido): ?>
                <div class="col s6 md3">
                    <div class="card">
                        <img src="img/pizza.svg" class="pizza">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($pedido['id']) . "° Pedido";?></h6>
                            <h6><?php echo "Cliente: " . htmlspecialchars($pedido['nomeCliente']);?></h6>
                            <h6><?php echo "Mesa: " . htmlspecialchars($pedido['idMesa']);?></h6>
                            
                            <ul>
                                <?php foreach (explode(';', $pedido['pedido']) as $ing ): ?>
                                    <li> <?php echo htmlspecialchars($ing); ?> </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php echo "Obs: " . htmlspecialchars($pedido['obs']);?>
                        </div>
                        
                            
                        
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php include('templates/footer.php'); ?>
    

</html>