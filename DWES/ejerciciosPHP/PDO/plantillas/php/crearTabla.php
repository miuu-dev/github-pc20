<?php

    // Credenciales
    $servername = "localhost";
    $username = "root";
    $password = "";

    // conexión y creación de la tabla
    try {
        $conn = new PDO("mysql:host=$servername;dbname=tienda", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "CREATE TABLE productos (
            nombre VARCHAR(150) NOT NULL,
            precio INT NOT NULL DEFAULT 0,
            stock INT NOT NULL DEFAULT 0
        );";

        $conn->exec($query);
        echo "La tabla productos ha sido creada. <br>";
    } catch (PDOException $e) {
        echo "Error: ". $e->getMessage();
    }

?>