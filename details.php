<?php

    include('config/db_connect.php');

    //Deletar
    if(isset($_POST['delete'])){
       

        $id_to_delete = $_POST['id_to_delete'];

        try {
            $stmt = $pdo->prepare("DELETE FROM pedidos WHERE id = :id");
            $stmt->bindParam(':id', $id_to_delete);
            $stmt->execute();
            header('Location: index.php');
            
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    //Editar
    if(isset($_POST['edit'])){
       

        $id = $_POST['id_to_edit'];
        $nomePedido = $_POST['nomePedido'];
        $email = $_POST['email'];
        $adicionais = $_POST['adicionais'];
        // $nomePedido = "pedido5";
        // $email = "b5@mail.com";
        // $adicionais = "dddddd";

        try {
            $stmt = $pdo->prepare('UPDATE pedidos SET nomePedido = :nomePedido, email = :email, adicionais = :adicionais WHERE id = :id ');
            $stmt->execute(array(
                ':id' => $id,
                ':nomePedido' => $nomePedido,
                ':email' => $email,
                ':adicionais' => $adicionais
            ));
            header('Location: index.php');
            
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


?>
