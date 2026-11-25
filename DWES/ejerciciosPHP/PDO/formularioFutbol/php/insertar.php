<?php

// Verificar que los datos se hayan enviado por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Definición de las credenciales de conexión
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'equipoFutbol';
    $tabla = 'equipos';

    // Recoger y sanitizar/validar los datos del formulario
    $datos_equipo = [
        'nombre' => $_POST['nombre'] ?? '',
        'puntos' => $_POST['puntos'] ?? 0,
        'goles_favor' => $_POST['goles_favor'] ?? 0,
        'goles_contra' => $_POST['goles_contra'] ?? 0
    ];

    // Creamos la tira de conexión
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Crear la tabla si no existe
        $sql_create = "CREATE TABLE IF NOT EXISTS {$tabla} (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            puntos INT NOT NULL,
            goles_favor INT NOT NULL,
            goles_contra INT NOT NULL
        )";
        $pdo->exec($sql_create);

        // Consulta de inserción preparada
        $sql_insert = "INSERT INTO {$tabla} (nombre, puntos, goles_favor, goles_contra) VALUES (:nombre, :puntos, :goles_favor, :goles_contra)";
        $stmt = $pdo->prepare($sql_insert);

        // Ejecutar con los datos del formulario
        $stmt->execute([
            ':nombre' => $datos_equipo['nombre'],
            ':puntos' => $datos_equipo['puntos'],
            ':goles_favor' => $datos_equipo['goles_favor'],
            ':goles_contra' => $datos_equipo['goles_contra'],
        ]);

        if($stmt->rowCount()) {
            echo "¡Inserción exitosa! El equipo <strong>" . htmlspecialchars($datos_equipo['nombre']) . "</strong> ha sido añadido con éxito.";
        } else {
            echo "La inserción se ejecutó, pero no se afectaron filas.";
        }

    } catch(PDOException $e) {
        die("Error en la base de datos: " . $e->getMessage());
    }

} else {
    // Si intentan acceder directamente a procesar.php sin enviar el formulario
    header("Location: index.html");
    exit();
}

?>