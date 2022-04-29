<?php

// Duas maneira de conectar com o mysql
// MySQLi (i significa improved) e PDO (php data object)
// MySQLi

//$conn = mysqli_connect('localhost', 'db_user', '1234', 'restaurante_db');

//Checar a conexão
// if (!$conn) {
//     echo 'erro na conexão mysql' . mysqli_connect_error();
// }



//Tentando conectar por PDO
$username = 'db_user';
$password = '1234';

$pdo = new PDO('mysql:host=localhost;dbname=restaurante_db', $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Checar a conexão
if (!$pdo) {
    echo 'erro na conexão mysql' . mysqli_connect_error();
}

?>



