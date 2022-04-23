<?php

   

    if (isset($_POST['submit'])) {
        //Significa que algo foi enviado
        //htmlspecialchars() é para tratar de XSS; transforma o conteúdo em entidades de html
        // echo htmlspecialchars($_POST['email']);
        // echo htmlspecialchars($_POST['nomePedido']);
        // echo htmlspecialchars($_POST['adicionais']);

        //Fazendo validação server-side no php, mas poderia também ter sido feita no html
        if (empty($_POST['email'])) {
            //Fazer algo em js aqui
            echo 'Preencha um email! <br/>';
        }
        else{

            //echo htmlspecialchars($_POST['email']);
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo 'Esse não é um email válido <br/>';
            }
        }

        //---------------
        if (empty($_POST['nomePedido'])) {
            //Fazer algo em js aqui
            echo 'Preencha um nome Pedido! <br/>';
        }
        else{
            //echo htmlspecialchars($_POST['nomePedido']);
            //Usando regex para ver se o pedido é valido
            $nomePedido = $_POST['nomePedido'];
            if (!preg_match('/^[a-zA-Z\s]+$/', $nomePedido)) {
                echo ('O nome do pedido está inválido <br/>');
            }
        }

        //-----------------
        if (empty($_POST['adicionais'])) {
            //Fazer algo em js aqui
            echo 'Preencha  adicionais! <br/>';
        }
        else{
            //echo htmlspecialchars($_POST['adicionais']);
            $adicionais = $_POST['adicionais'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $adicionais)) {
                echo ('O campo de adicionais está inválido <br/>');
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
            <input type="text" name="email">
            <label> Nome do pedido: </label>
            <input type="text" name="nomePedido">
            <label> Adicionais: </label>
            <input type="text" name="adicionais">
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>
    
</html>