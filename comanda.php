<?php

include('config/db_connect.php');

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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $quant = $_GET['quant'];
    
    if ($quant > 0 && filter_var($quant, FILTER_VALIDATE_INT)) {
        //Valor valido
        $_SESSION['comanda'][$id] = $quant;
    }

    elseif($quant==0){
        unset($_SESSION['comanda'][$id]);
    }
    else{
        //Fazer algo em JS aqui
        echo "Inválido";
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
                <li><a href="comanda.php?clear=1" class="btn brand">Limpar pedido</a></li>
                <li><a href="cardapio.php" class="btn brand">Cardápio</a></li>
            </ul>
        </div>
    </nav>


    <h4 class="center grey-text">Pratos selecionados</h4>
    <div class="container">
        <div class="row">
        <table>
                    <tr>
                        <th>Item</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Tempo preparo por prato (min)</th>
                        <th>Subtotal</th>
                    </tr>

            <?php
                $total = 0;
                foreach($_SESSION['comanda'] as $key => $quant): 
                $consulta = $pdo->query("SELECT * FROM cardapio WHERE id = '$key' ");
                $linha = $consulta->fetch(PDO::FETCH_ASSOC);
            
                $subTotal = $linha['preco'] * $quant;
                $total += $subTotal;
            echo "
                <tr>
                    <td>{$linha['nomePrato']}</td>
                    <td>{$linha['preco']}</td>
                    <td>
                    <form action='comanda.php' method='GET'>
                        <input type='number' name='quant' value='$quant' style='width: 40px' min='0'>
                        <input type='hidden' name='id' value='$key'>
                        <input type='submit' value='atualizar'>
                    </form>
                    </td>
                    <td>{$linha['tempoPreparo']}</td>
                    <td>R$ $subTotal</td>

                </tr>
            ";
            
            endforeach;
            if (empty($_SESSION['comanda'])) {
                echo "<tr><td colspan='5'>Nenhum pedido até agora </td></tr>";
            }
            else {
                echo "<tr><td colspan='5'>Total: R$ $total </td></tr>";    
            }
            
            ?>
        </table>
        </div>
    </div>

    <?php include('templates/footer.php'); ?>
    

</html>