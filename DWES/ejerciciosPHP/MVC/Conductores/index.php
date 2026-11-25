<?php

    require_once("./model/Conductor.php");
    require_once("./controller/ConductorController.php");
    require_once("./model/Conexion.php");

    // ---- INSTANCIANDO CONTROLADOR ----
    $controller = new ConductorController();

    // ---- OBTENEMOS URI ----
    $uri = strtok($_SERVER["REQUEST_URI"], '?');

    // ---- LIMPIAMOS RUTA ----
    if(strpos($uri,'conductores/') !== false) {
        $partes = explode('conductores/', $uri);
        $ruta = $partes[1] ?? '';
    } else {
        $ruta = $uri;
    }

    // ---- SI INCLUYE index.php SE EXTRAE ----
    $ruta = str_replace('index.php', '', $ruta);

    // ---- CREAMOS ARRAYS FILTRANDO ELEMENTOS VACÍOS ----
    $array_ruta = array_values(array_filter(explode('/', $ruta)));

    // ---- FUNCIÓN DE LA RUTA SEGÚN LO DESEADO ----
    if (isset($array_ruta[0]) && $array_ruta[0] !== '') {
        switch($array_ruta[0]) {
            case "borrar":
                if (isset($array_ruta[1]) && is_numeric($array_ruta[1])) {
                    $controller->borrar((int)$array_ruta[1]);
                } else {
                    echo "ID de coche no válido para borrar.";
                }
                break;
        
            case "ver":
                if (isset($array_ruta[1]) && is_numeric($array_ruta[1])) {
                    $controller->ver((int)$array_ruta[1]);
                } else {
                    echo "ID de coche no válido";
                }
                break;

            case "alta":
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $controller->formularioAlta();
                } else {
                    echo "No se pudo añadir un nuevo conductor";
                }
                break;

            case "actualizar":
            if (isset($array_ruta[1]) && is_numeric($array_ruta[1])) {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $controller->actualizar((int)$array_ruta[1], $_POST);
                } else {
                    $controller->actualizar((int)$array_ruta[1], $_POST);
                }
            } else {
                echo "ID de conductor no válido para actualizar.";
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

?>