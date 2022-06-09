<?php

include('config/db_connect.php');

//Comanda

session_start();

if (!(isset($_SESSION['comanda']))) {
    $_SESSION['comanda'];
    //echo "sfae";
}

if (!(isset($_SESSION['cliente']))) {
    $_SESSION['cliente'];
    //echo "sfae";
}

//Limbar a comanda
if (isset($_GET['clear'])) {
    $_SESSION['comanda'] = array();
    $_SESSION['cliente'] = array();
}

//Add na sessão dados da mesa
if (isset($_POST['nomeCliente'])) {
    $_SESSION['cliente']['nomeCliente'] = $_POST['nomeCliente'];
    $_SESSION['cliente']['idMesa'] = $_POST['idMesa'];
    $_SESSION['cliente']['obs'] = $_POST['obs'];
    $_SESSION['cliente']['pedidos'] = $_POST['pedidos'];
    //print_r($_SESSION['cliente']);
    
    //Inserir no banco
    try {
        $stmt = $pdo->prepare('INSERT INTO pedidos(id, nomeCliente, idMesa, obs, pedido, estado) VALUES(:id, :nomeCliente, :idMesa, :obs, :pedido, :estado)');
        $stmt->execute(array(
            ':id' => NULL,
            ':nomeCliente' => $_SESSION['cliente']['nomeCliente'], 
            ':idMesa' => $_SESSION['cliente']['idMesa'], 
            ':obs' => $_SESSION['cliente']['obs'], 
            ':pedido'=> $_SESSION['cliente']['pedidos'], 
            ':estado' => 0
            
        ));
        $_SESSION['comanda'] = array();
        $_SESSION['cliente'] = array();

    } catch(PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }

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
            <a href="cardapio.php" class="brand-logo brand-text">Restaurante etc</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><a href="comanda.php?clear=1" class="btn brand">Limpar pedido</a></li>
                <li><a href="cardapio.php" class="btn brand">Cardápio</a></li>
            </ul>
        </div>
    </nav>


    <h4 class="center grey-text">Pratos selecionados</h4>
    <div class="container">
        <div class="row">
        <table id='tabela'>
                    <tr>
                        <th>Item</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Tempo preparo por prato (min)</th>
                        <th>Subtotal</th>
                    </tr>

            <?php
                $total = 0;
                $pedidos = "";
                foreach($_SESSION['comanda'] as $key => $quant): 
                $consulta = $pdo->query("SELECT * FROM cardapio WHERE id = '$key' ");
                $linha = $consulta->fetch(PDO::FETCH_ASSOC);
            
                $subTotal = $linha['preco'] * $quant;
                $total += $subTotal;
                $pedidos .=  "$quant - {$linha['nomePrato']};";
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
                echo "<tr><td colspan='5'>Total: R$ $total <br> $pedidos </td></tr>";    
            }
            
            ?>
        </table>
            
            <h4 class="center">Dados do cliente</h4>
            <form action="comanda.php" method="POST" class="white">
                <label> Nome cliente: </label>
                <input type="hidden" name="pedidos" value="<?php echo $pedidos ?>">

                <input type="text" name="nomeCliente">
                <div class="red-text"></div>

                <label> Identificação da mesa: </label>
                <input type="text" name="idMesa">
                <div class="red-text"></div>

                <label> Obsevações no pedido: </label>
                <input type="text" name="obs">
                <div class="red-text"> </div>

                <div class="center">
                    <input type="submit" name="submit" value="Confirmar" class="btn brand">
                </div>
            </form>
        
        </div>
    </div>

    <?php include('templates/footer.php'); ?>
    
    <script src="scriptC.js"></script>
</html>