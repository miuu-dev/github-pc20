<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'coches';
$dbtable = 'miscoches';

try {
    // Añadido ;dbname=$dbname para seleccionar la base de datos
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "CREATE TABLE IF NOT EXISTS $dbtable (
                id INT AUTO_INCREMENT PRIMARY KEY,
                marca VARCHAR(150) NOT NULL,
                modelo VARCHAR(150) NOT NULL,
                color VARCHAR(150) NOT NULL,
                propietario VARCHAR(150) NOT NULL,
                precio DECIMAL(10,2) DEFAULT 0
            );";

    $conn->exec($query);
    echo "La tabla '$dbtable' ha sido creada correctamente. <br>";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}