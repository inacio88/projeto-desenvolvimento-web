<?php

include('config/db_connect.php');

// Conexão por PDO
$consulta = $pdo->query("SELECT id, nomePrato, preco, tempoPreparo, ingredientes FROM cardapio ORDER BY nomePrato;");
$pratos = $consulta->fetchAll(PDO::FETCH_ASSOC);


//Comanda

session_start();

if (!(isset($_SESSION['comanda']))) {
    $_SESSION['comanda'];
    //echo "sfae";
}

//Limbar a comanda

if (isset($_GET['clear'])) {
    $_SESSION['comanda'] = array();
}

//Checando se já tem algo na comanda
//compra
$out = "";
if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $quantidade = $_GET['quantidade'];

    echo "id: $id , quantidade: $quantidade";

    if ($id > 0 && filter_var($quantidade, FILTER_VALIDATE_INT)) {
        //Valor valido
        
        if ($_SESSION['comanda'][$id]) {
            $_SESSION['comanda'][$id] += $quantidade;
        }
        else{
            $_SESSION['comanda'][$id] = $quantidade;
        }

    }
    else{
        //Valor ruim
        $out = "Valor inválido";
    }

}


?>

<!DOCTYPE html>
<html lang="pt-br">

    <?php //include('templates/header.php'); ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Restaurante etc</title>
</head>


<body class="grey lighten-4">
    <nav class="white">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Restaurante etc</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="addPrato.php" class="btn brand">Add prato</a></li>
                <li><a href="cardapio.php?clear=1" class="btn brand">Limpar pedido</a></li> 
            </ul>
        </div>
    </nav>

    <?php
        print_r($_SESSION['comanda']);
        echo $out;
    ?>

    <h4 class="center grey-text">Cardápio</h4>
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
                            <!-- <a href="cardapio.php?id=<?php //echo $prato['id'] ?>" class="brand-text">Add à comanda</a> -->
                            <form action="cardapio.php" method="get">
                                    <input type="hidden" name="id" id="id" value="<?php echo $prato['id'] ?>">
                                    <label for="quantidade">Quantidade</label>
                                    <input type="number" name="quantidade" id="quantidade" min="0" max="9" size="5">
                                    <input type="submit" value="Add à comanda" class="brand-text">
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>

    <?php include('templates/footer.php'); ?>
    

</html>