<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'coches';


try {
    // CORREGIDO: DSN correcto separando con ';' y pasando usuario/pass como argumentos de PDO
    $conn = new PDO("mysql:host=$host", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "CREATE DATABASE IF NOT EXISTS $dbname";
    $conn->exec($query);

    echo "La base de datos '$dbname' ha sido creada correctamente o ya existía. <br>";
} catch (PDOException $e) {
    echo "Ha ocurrido un error: <br>" . $e->getMessage();
}
