<?php
$servername = 'localhost';
$username = 'root';
$password = '';

try {
    // 1. Conexión al servidor MySQL (sin especificar dbname)
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Sentencia SQL para crear la base de datos si no existe
    $query = "DROP DATABASE IF EXISTS (nombre BBDD)";
    $conn->exec($query);

    echo "Base de datos '(nombre BBDD)' eliminada correctamente (o no existía).";

} catch (PDOException $e) {
    echo "Error al eliminar la base de datos: " . $e->getMessage();
}
?>