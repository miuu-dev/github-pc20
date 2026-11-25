<?php
$mensaje = $mensaje ?? null;
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicar sesión</title>
    <style>
        /* Configuración general */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f0ff;
            color: #352747;
        }

        /* Centrar el formulario */
        .contenedor {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Tarjeta del formulario */
        .tarjeta {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(100, 70, 140, 0.12);
        }

        h1 {
            text-align: center;
            color: #8056b3;
            margin-bottom: 10px;
        }

        .descripcion {
            text-align: center;
            color: #887c96;
            font-size: 14px;
            margin-bottom: 30px;
        }

        /* Campos */
        .campo {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d9cbea;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input:focus {
            border-color: #9b72cf;
            box-shadow: 0 0 0 3px rgba(155, 114, 207, 0.15);
        }

        /* Botón */
        button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 9px;
            background: #9065c5;
            color: white;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s, transform 0.2s;
        }

        button:hover {
            background: #7650a7;
            transform: translateY(-2px);
        }

        /* Mensaje de error o información */
        .mensaje {
            background: #fff0f0;
            color: #a13e55;
            border: 1px solid #f2c9d0;
            border-radius: 8px;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        /* Adaptación a móviles */
        @media (max-width: 480px) {
            .tarjeta {
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>

    <main class="contenedor">
        <section class="tarjeta">
            <h1>Iniciar sesión</h1>

            <form action="" method="POST">

                <div class="campo">
                    <label for="usuario">Nombre de usuario</label>
                    <input
                        type="text"
                        id="usuario"
                        name="usuario"
                        placeholder="Escribe tu usuario"
                        required>
                </div>

                <div class="campo">
                    <label for="pwd">Contraseña</label>
                    <input
                        type="password"
                        id="pwd"
                        name="pwd"
                        placeholder="Escribe tu contraseña"
                        required>
                </div>

                <button type="submit">Iniciar sesión</button>
            </form>
        </section>
    </main>

</body>

</html>