<?php
// Incluyo los archivos necesarios
require_once("./model/Coche.php");
require_once("./controller/CocheController.php");
require_once("./model/Conexion.php");

// Instancio el controlador
$controller = new CocheController();

// 1. Obtenemos la URI y eliminamos parámetros GET si los hay
$uri = strtok($_SERVER["REQUEST_URI"], '?');

// 2. Limpiamos la ruta extrayendo todo lo que hay a partir de "coches/"
if (strpos($uri, 'coches/') !== false) {
    $partes = explode('coches/', $uri);
    $ruta = $partes[1] ?? '';
} else {
    $ruta = $uri;
}

// 3. Si por casualidad incluye index.php, lo eliminamos
$ruta = str_replace('index.php', '', $ruta);

// 4. Creamos el array de ruta filtrando los elementos vacíos
$array_ruta = array_values(array_filter(explode("/", $ruta)));

// 5. Decidimos la ruta en función de los elementos del array
if (isset($array_ruta[0]) && $array_ruta[0] !== '') {
    switch ($array_ruta[0]) {
        case "ver":
            if (isset($array_ruta[1]) && is_numeric($array_ruta[1])) {
                $controller->ver((int)$array_ruta[1]);
            } else {
                echo "ID de coche no válido";
            }
            break;

        case "color":
            if (isset($array_ruta[1])) {
                $controller->verColor($array_ruta[1]);
            } else {
                echo "Color no válido.";
            }
            break;

        case "baja":
            if (isset($array_ruta[1]) && is_numeric($array_ruta[1])) {
                $controller->baja((int)$array_ruta[1]);
            } else {
                echo "ID de coche no válido para dar de baja.";
            }
            break;

        case "alta":
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $controller->alta($_POST);
            } else {
                $controller->formularioAlta();
            }
            break;

        case "actualizar":
            if (isset($array_ruta[1]) && is_numeric($array_ruta[1])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $controller->actualizar((int)$array_ruta[1], $_POST);
                } else {
                    $controller->formularioActualizacion((int)$array_ruta[1]);
                }
            } else {
                echo "ID de coche no válido para actualizar.";
            }
            break;

        default:
            echo "La ruta solicitada no existe. Se mostrarán todos los coches.<br>";
            $controller->index();
            break;
    }
} else {
    $controller->index();
}