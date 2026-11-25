<?php

require_once 'Perro.php'; // Como están en la misma carpeta php, se incluye directo
session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recogemos datos perro 1
    $raza1 = $_POST['raza1'] ?? '';
    $color1 = $_POST['color1'] ?? '';
    $peso1 = (float)($_POST['peso1'] ?? 0);
    $edad1 = (int)($_POST['edad1'] ?? 0);
    $sexo1 = $_POST['sexo1'] ?? '';

    // Recogemos datos perro 2
    $raza2 = $_POST['raza2'] ?? '';
    $color2 = $_POST['color2'] ?? '';
    $peso2 = (float)($_POST['peso2'] ?? 0);
    $edad2 = (int)($_POST['edad2'] ?? 0);
    $sexo2 = $_POST['sexo2'] ?? '';

    // Instanciamos
    $perro1 = new Perro($raza1, $color1, $peso1, $edad1, $sexo1);
    $perro2 = new Perro($raza2, $color2, $peso2, $edad2, $sexo2);

    // Cruzamos
    $cachorro = $perro1->cruzar($perro2);

    // Guardamos el resultado en la sesión
    $_SESSION['cachorro'] = $cachorro;

    // Redirigimos a la vista de resultados que está en la misma carpeta
    header('Location: resultado.php');
    exit();
} else {
    // Si intentan entrar directo por la URL, los devolvemos al index
    header('Location: ../index.php');
    exit();
}
?>