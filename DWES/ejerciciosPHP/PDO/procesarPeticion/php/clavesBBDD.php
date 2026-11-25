<?php

    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "CREATE DATABASE claves";
        $conn->exec($query);

        echo "La base de datos 'claves' ha sido creada correctamente. <br>";
    } catch(PDOException $e) {
        echo "Ha ocurrido un error: <br>" . $e->getMessage();
    }
    
?>