<?php

    include('config/db_connect.php');

    //Deletar
    if(isset($_GET['deletar'])){
       

        $id_to_delete = $_GET['deletar'];

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
    if(isset($_GET['estado'])){
        $id = $_GET['estado'];
        $estado = 1;
        try {
            $stmt = $pdo->prepare('UPDATE pedidos SET estado = :estado WHERE id = :id ');
            $stmt->execute(array(
                ':id' => $id,
                ':estado' => $estado
            ));
            header('Location: index.php');
            
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }


?>
