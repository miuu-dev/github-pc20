<?php

require_once 'Perro.php'; // Necesario para que PHP reconozca el objeto de la clase dentro de la sesión
session_start(); // se pone siempre despues del require_one()

// Recuperamos el cachorro de la sesión y lo borramos para que no se quede guardado para siempre
$cachorro = $_SESSION['cachorro'] ?? null;
unset($_SESSION['cachorro']);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Cruce</title>
    <link rel="icon" type="image/x-icon" href="../img/miuuLogo.png">
    <style>
        @font-face {
            font-family: 'CenturyGothic';
            src: url('../fonts/CenturyGothic.otf');
        }

        * {
            font-family: 'CenturyGothic', sans-serif;
        }
    </style>
</head>

<body>
    <h1>Resultado del cruce de perros</h1>

    <?php if ($cachorro !== null): ?>
        <div class="resultado-exito">
            <h3>¡Cruce exitoso! Se ha obtenido un cachorro:</h3>
            <ul>
                <li><strong>Raza:</strong> <?php echo $cachorro->getRaza(); ?></li>
                <li><strong>Color:</strong> <?php echo $cachorro->getColor(); ?></li>
                <li><strong>Peso:</strong> <?php echo $cachorro->getPeso(); ?> kg</li>
                <li><strong>Edad:</strong> <?php echo $cachorro->getEdad(); ?> años</li>
                <li><strong>Sexo:</strong> <?php echo $cachorro->getSexo(); ?></li>
            </ul>
        </div>
    <?php else: ?>
        <div class="resultado-error">
            <h3>Cruce no realizado</h3>
            <p>Los dos perros son del mismo sexo, por lo que no pueden procrear</p>
        </div>
    <?php endif; ?>

    <br>
    <a href="../index.php">← Volver al formulario</a>
</body>

</html>