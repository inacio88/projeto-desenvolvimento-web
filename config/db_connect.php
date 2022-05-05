<?php

// PDO
$username = 'db_user';
$password = '1234';

$pdo = new PDO('mysql:host=localhost;dbname=restaurante_db', $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Checar a conexão
if (!$pdo) {
    echo 'erro na conexão mysql' . mysqli_connect_error();
}

?>



