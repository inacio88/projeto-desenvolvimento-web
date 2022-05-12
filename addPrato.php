<?php
    include('config/db_connect.php');

    $nomePrato = $ingredientes = '';

   $erros = array('nomePrato'=>'','ingredientes'=>'', 'preco' => '', 'tempoPreparo' => '','ingredientes' => '' );

    if (isset($_POST['submit'])) {
        
        //Fazendo validação server-side no php, mas poderia também ter sido feita no html
        if (empty($_POST['nomePrato'])) {
            //Fazer algo em js aqui
            $erros['nomePrato'] = 'Preencha um nome de prato! <br/>';
        }
        else{
            
            $nomePrato = $_POST['nomePrato'];
            if (!preg_match('/^[a-zA-Z0-9]+$/', $nomePrato)) {
                $erros['nomePrato'] = 'O nome do prato está inválido <br/>';
            }
        }

        //---------------
        if (empty($_POST['preco'])) {
            //Fazer algo em js aqui
            $erros['preco'] = 'Preencha um nome preço! <br/>';
        }
        else{
            
            $preco = $_POST['preco'];
            if (!preg_match('/^[0-9]+$/', $preco)) {
                $erros['preco'] = 'O preço do pedido está inválido <br/>';
            }
        }
        //---------------
        if (empty($_POST['tempoPreparo'])) {
            //Fazer algo em js aqui
            $erros['tempoPreparo'] = 'Preencha o tempo de preparo! <br/>';
        }
        else{
            
            $tempoPreparo = $_POST['tempoPreparo'];
            if (!preg_match('/^[0-9]+$/', $tempoPreparo)) {
                $erros['tempoPreparo'] = 'O tempo de preparo do prato está inválido <br/>';
            }
        }

        //-----------------
        if (empty($_POST['ingredientes'])) {
            //Fazer algo em js aqui
            $erros['ingredientes'] = 'Preencha os ingredientes! <br/>';
        }
        else{
            //echo htmlspecialchars($_POST['adicionais']);
            $ingredientes = $_POST['ingredientes'];
            if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredientes)) {
                $erros['ingredientes'] =  'O campo de ingredientes está inválido <br/>';
            }
        }

        //Se todas as posições desse array estirem vazias, então essa função retorna falso
        //No caso, se tiver alguma msg nesse array é pq teve erro, e a função retorna true
        if (array_filter($erros)) {
            //echo 'Tem erro no formulário';
        }
        else{
            

            try {
                $stmt = $pdo->prepare('INSERT INTO cardapio(id, nomePrato, preco, tempoPreparo, ingredientes) VALUES(:id, :nomePrato, :preco, :tempoPreparo, :ingredientes)');
                $stmt->execute(array(
                    ':id' => NULL,
                    ':nomePrato' => $nomePrato,
                    ':preco' => $preco,
                    ':tempoPreparo' => $tempoPreparo,
                    ':ingredientes' => $ingredientes,
                    
                    
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

    <div class="container detalhe">
        <section class="grey-text detalhe">
            <h4 class="center">Add prato</h4>
            <form action="addPrato.php" method="POST" class="white">
                <label> nomePrato: </label>
                <input type="text" name="nomePrato" value="<?php echo htmlspecialchars($nomePrato) ?>">
                <div class="red-text"> <?php echo $erros['nomePrato']; ?> </div>

                <label> preco: </label>
                <input type="text" name="preco" value="<?php echo htmlspecialchars($preco) ?>"> 
                <div class="red-text"> <?php echo $erros['preco']; ?> </div>

                <label> tempoPreparo: </label>
                <input type="text" name="tempoPreparo" value="<?php echo htmlspecialchars($tempoPreparo) ?>">
                <div class="red-text"> <?php echo $erros['tempoPreparo']; ?> </div>

                <label> ingredientes: </label>
                <input type="text" name="ingredientes" value="<?php echo htmlspecialchars($ingredientes) ?>">
                <div class="red-text"> <?php echo $erros['ingredientes']; ?> </div>

                <div class="center">
                    <input type="submit" name="submit" value="submit" class="btn brand">
                </div>
            </form>
        </section>
    </div>

    <?php include('templates/footer.php'); ?>
    
</html>