<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "tienda";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "INSERT INTO productos(nombre, precio, stock) VALUES ('Mesa', 60, 100), ('Silla', 30, 500), ('Armario', 200, 200);";
        $conn->exec($query);

        echo "Las inserciones se han realizado de manera correcta.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

?>