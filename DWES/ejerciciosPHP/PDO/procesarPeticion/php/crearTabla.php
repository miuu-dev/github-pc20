<?php

    // Credenciales
    $servername = "localhost";
    $username = "root";
    $password = "";

    // conexión y creación de la tabla
    try {
        $conn = new PDO("mysql:host=$servername;dbname=claves", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "CREATE TABLE usuarios (
            id INT(11) NOT NULL,
            user VARCHAR(255) NOT NULL,
            pw VARCHAR(255) NOT NULL
        );";

        $conn->exec($query);
        echo "La tabla usuarios ha sido creada. <br>";
    } catch (PDOException $e) {
        echo "Error: ". $e->getMessage();
    }

?>