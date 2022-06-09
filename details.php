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
        $nomePrato = $_POST['nomePrato'];
        $preco = $_POST['preco'];
        $tempoPreparo = $_POST['tempoPreparo'];
        $ingredientes = $_POST['ingredientes'];
        // $nomePedido = "pedido5";
        // $email = "b5@mail.com";
        // $adicionais = "dddddd";
//("SELECT id, nomePrato = :nomePrato, preco = :preco, tempoPreparo = :tempoPreparo, ingredientes = :ingredientes");
        try {
            $stmt = $pdo->prepare('UPDATE pedidos SET nomePrato = :nomePrato, preco = :preco, tempoPreparo = :tempoPreparo, ingredientes = :ingredientes WHERE id = :id ');
            $stmt->execute(array(
                ':id' => $id,
                'nomePrato' => $nomePrato, 
                'preco' => $preco, 
                'tempoPreparo' => $tempoPreparo, 
                'ingredientes' => $ingredientes
            ));
            header('Location: index.php');
            
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


?>
