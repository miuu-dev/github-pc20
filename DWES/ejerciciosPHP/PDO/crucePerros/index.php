<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cruce de Perros</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" type="image/x-icon" href="img/miuuLogo.png">
    <style>
        @font-face {
            font-family: 'CenturyGothic';
            src: url('fonts/CenturyGothic.otf');
        }
        * { font-family: 'CenturyGothic', sans-serif; }
    </style>
</head>
<body>
    <h1>Cruce de Perros</h1>

    <!-- El action apunta a la carpeta php y al archivo de procesamiento -->
    <form action="php/procesar.php" method="post" id="formulario">
        <h2>Primer perro</h2>
        <div>
            <label for="raza1">Raza: </label>
            <input type="text" id="raza1" name="raza1" required>
        </div>
        <div>
            <label for="color1">Color: </label>
            <input type="text" id="color1" name="color1" required>
        </div>
        <div>
            <label for="edad1">Edad: </label>
            <input type="number" id="edad1" name="edad1" min="0" required>
        </div>
        <div>
            <label for="peso1">Peso: </label>
            <input type="number" step="0.1" id="peso1" name="peso1" min="0" required>
        </div>
        <div>
            <label for="sexo1">Sexo:</label>
            <input type="text" id="sexo1" name="sexo1" required>
        </div>
        
        <hr>

        <h2>Segundo perro</h2>
        <div>
            <label for="raza2">Raza: </label>
            <input type="text" id="raza2" name="raza2" required>
        </div>
        <div>
            <label for="color2">Color: </label>
            <input type="text" id="color2" name="color2" required>
        </div>
        <div>
            <label for="edad2">Edad: </label>
            <input type="number" id="edad2" name="edad2" min="0" required>
        </div>
        <div>
            <label for="peso2">Peso: </label>
            <input type="number" step="0.1" id="peso2" name="peso2" min="0" required>
        </div>
        <div>
            <label for="sexo2">Sexo: </label>
            <input type="text" id="sexo2" name="sexo2" required>
        </div>

        <br>
        <button type="submit">Cruzar perros</button>
    </form>
</body>
</html>