<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "claves";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = "DROP IF EXISTS productos";
        $conn->exec($query);

        echo "La tabla productos se eliminó correctamente";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

?>