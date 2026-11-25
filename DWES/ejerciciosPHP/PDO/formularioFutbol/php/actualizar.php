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
        'id' => $_POST['id'] ?? '',
        'puntos' => $_POST['puntos'] ?? 0,
        'goles_favor' => $_POST['goles_favor'] ?? 0,
        'goles_contra' => $_POST['goles_contra'] ?? 0
    ];

    // Validar que el ID no esté vacío
    if (empty($datos_equipo['id'])) {
        die("Error: El ID del equipo es obligatorio.");
    }

    // Creamos la tira de conexión
    $dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

    try {
        $pdo = new PDO($dsn, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Crear la tabla si no existe
        $sql_update = "UPDATE {$tabla} SET puntos = :puntos, goles_favor = :goles_favor, goles_contra = :goles_contra WHERE id = :id";
        $stmt=$pdo->prepare($sql_update);

        // Ejecutar con los datos del formulario
        $stmt->execute([
            ':id' => $datos_equipo['id'],
            ':puntos' => $datos_equipo['puntos'],
            ':goles_favor' => $datos_equipo['goles_favor'],
            ':goles_contra' => $datos_equipo['goles_contra'],
        ]);

        if($stmt->rowCount() > 0) {
            echo "¡Actualización exitosa! El equipo <strong>" . htmlspecialchars($datos_equipo['id']) . "</strong> ha sido actualizada con éxito.";
        } else {
            echo "La atualización se ejecutó, pero no se afectaron filas.";
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