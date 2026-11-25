<?php

/*
    NO HACE FALTA PONER ID
    LA PROPIA BASE DE DATOS LA CREA Y LA INCREMENTA AUTOMÁTICAMENTE
*/

// Definición de las credenciales de conexión
$host = 'localhost'; // El host es la dirección a la cual se hace la petición
$user = 'root'; // El usuario por defecto en entornos locales
$password = ''; // La contraseña por defecto (cadena vacía)
$dbname = 'prueba'; // Nombre de la base de datos
$tabla = 'equipos'; // Nombre de la tabla: minúscula y plural


// Datos a insertar
$datos_equipo = [
    'nombre' => 'Cádiz',
    'puntos' => 30,
    'goles_favor' => 40,
    'goles_contra' => 50
];

// Creamos la tira de conexión - OBLIGATORIO
$dsn = "mysql:host={$host};dbname={$dbname};charset=utf8";

try {
    // 1. Establecer la conexión PDO
    $pdo = new PDO($dsn, $user, $password);

    // Configuración para lanzar exceptiones en caso de errores de SQL
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 1.1. Creamos la tabla en caso de que no esté creada
    $sql_create = "CREATE TABLE IF NOT EXISTS {$tabla} (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        puntos INT NOT NULL,
        goles_favor INT NOT NULL,
        goles_contra INT NOT NULL
    )";
    $pdo->exec($sql_create);

    // 2. Definir la consulta de inserción con marcadores de posición (prepared statement)
    // Las consultas preparadas son necesarias para tareas como la creación de nuevos registros
    $sql_insert = "INSERT INTO {$tabla} (nombre, puntos, goles_favor, goles_contra) VALUES (:nombre, :puntos, :goles_favor, :goles_contra)";

    // 3. Preparar la sentencia
    $stmt = $pdo->prepare($sql_insert);

    // 4. Asignar los valores a los marcadores de posición (binding) y ejecutar la sentencia
    $stmt->execute([
        ':nombre' => $datos_equipo['nombre'],
        ':puntos' => $datos_equipo['puntos'],
        ':goles_favor' => $datos_equipo['goles_favor'],
        'goles_contra'=> $datos_equipo['goles_contra'],
    ]);

    // 5. Verificar y mostrar éxito
    if($stmt->rowCount()) {
        echo "¡Inserción exitosa! El quipo {$datos_equipo['nombre']} ha sido añadida con éxito";
    } else {
        echo "La inserción se ejecutó, pero no se afectaron filas";
    }

} catch(PDOException $e) {
    die("Error en la base de datos: " . $e->getMessage());
}

?>