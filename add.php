<?php
    include('config/db_connect.php');

    $email = $nomePedido = $adicionais = '';

   $erros = array('email'=>'','nomePedido'=>'', 'adicionais'=>'');

    if (isset($_POST['submit'])) {
        //Significa que algo foi enviado
        //htmlspecialchars() é para tratar de XSS; transforma o conteúdo em entidades de html
        // echo htmlspecialchars($_POST['email']);
        // echo htmlspecialchars($_POST['nomePedido']);
        // echo htmlspecialchars($_POST['adicionais']);

        //Fazendo validação server-side no php, mas poderia também ter sido feita no html
        if (empty($_POST['email'])) {
            //Fazer algo em js aqui
            $erros['email'] = 'Preencha um email! <br/>';
        }
        else{

            //echo htmlspecialchars($_POST['email']);
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erros['email'] = 'Esse não é um email válido <br/>';
            }
        }

        //---------------
        if (empty($_POST['nomePedido'])) {
            //Fazer algo em js aqui
            $erros['nomePedido'] = 'Preencha um nome Pedido! <br/>';
        }
        else{
            //echo htmlspecialchars($_POST['nomePedido']);
            //Usando regex para ver se o pedido é valido /^[a-zA-Z0-9]+$/
            $nomePedido = $_POST['nomePedido'];
            if (!preg_match('/^[a-zA-Z0-9]+$/', $nomePedido)) {
                $erros['nomePedido'] = 'O nome do pedido está inválido <br/>';
            }
        }

        //-----------------
        if (empty($_POST['adicionais'])) {
            //Fazer algo em js aqui
            $erros['adicionais'] = 'Preencha  adicionais! <br/>';
        }
        else{
            //echo htmlspecialchars($_POST['adicionais']);
            $adicionais = $_POST['adicionais'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $adicionais)) {
                $erros['adicionais'] =  'O campo de adicionais está inválido <br/>';
            }
        }

        //Se todas as posições desse array estirem vazias, então essa função retorna falso
        //No caso, se tiver alguma msg nesse array é pq teve erro, e a função retorna true
        if (array_filter($erros)) {
            //echo 'Tem erro no formulário';
        }
        else{
            //echo 'O formulário está válido';
            
            //Mysqli-----------------------------------------
            //Essa função é para lidar com sql injection
            // $email = mysqli_real_escape_string($conn, $_POST['email']);
            // $nomePedido = mysqli_real_escape_string($conn, $_POST['nomePedido']);
            // $adicionais = mysqli_real_escape_string($conn, $_POST['adicionais']);

            //Criando a query sql

            // $sql = "INSERT INTO pedidos(nomePedido, email, adicionais) VALUES('$nomePedido','$email','$adicionais')";

            
            // // salvar no banco e checar
            // if(mysqli_query($conn, $sql)){
            //     //Se a query tiver dado certo
            //     header('Location: index.php');
            // }
            // else {
            //     echo 'query error: ' . mysql_error($conn);
            // }


            //---------------------------------------------------
            //---------------------PDO---------------------------
            //---------------------------------------------------
            // try {

            //     $stmt = $pdo->prepare('INSERT INTO pessoas VALUES(:id, :nome, :fone, :email, :insta)');
            //     $stmt->execute(array(
            //       ':id'    => Null,
            //       ':nome'  => $nome,
            //       ':fone'  => $fone,
            //       ':email' => $email,
            //       ':insta' => $insta
            //     ));
            //     echo("<script>alert('Dados registrados com sucesso....');</script>");
            //     //echo $stmt->rowCount();
            //   } catch(PDOException $e) {
            //     echo 'Error: ' . $e->getMessage();
            //   }

            try {
                $stmt = $pdo->prepare('INSERT INTO pedidos(id, nomePedido, email, adicionais) VALUES(:id, :nomePedido, :email, :adicionais)');
                $stmt->execute(array(
                    ':id' => NULL,
                    ':nomePedido' => $nomePedido,
                    ':email' => $email,
                    ':adicionais' => $adicionais,
                    
                    
                ));
                header('Location: index.php');

            } catch(PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }

            

        }


    }// Fim da verificação do POST

?>

<!DOCTYPE html>
<html lang="pt-br">

    <?php include('templates/header.php'); ?>


    <section class="container grey-text">
        <h4 class="center">Add pedido</h4>
        <form action="add.php" method="POST" class="white">
            <label> Email: </label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"> <?php echo $erros['email']; ?> </div>

            <label> Nome do pedido: </label>
            <input type="text" name="nomePedido" value="<?php echo htmlspecialchars($nomePedido) ?>"> 
            <div class="red-text"> <?php echo $erros['nomePedido']; ?> </div>

            <label> Adicionais: </label>
            <input type="text" name="adicionais" value="<?php echo htmlspecialchars($adicionais) ?>">
            <div class="red-text"> <?php echo $erros['adicionais']; ?> </div>

            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>
    
</html>