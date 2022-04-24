<?php

// Duas maneira de conectar com o mysql
// MySQLi (i significa improved) e PDO (php data object)
// MySQLi

$conn = mysqli_connect('localhost', 'db_user', '1234', 'restaurante_db');

//Checar a conexão
if (!$conn) {
    echo 'erro na conexão mysql' . mysqli_connect_error();
}

?>