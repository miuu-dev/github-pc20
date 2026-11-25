<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Coche</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            margin: 0;
            padding: 2rem;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }
        h1 {
            color: #2c3e50;
            margin-top: 0;
            font-size: 1.8rem;
            border-bottom: 2px solid #ecf0f1;
            padding-bottom: 0.5rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1.5rem;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            border-bottom: 2px solid #ddd;
        }
        td {
            border-bottom: 1px solid #eee;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Detalle del Conductor</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Puntos</th>
                <th>Ciudad</th>
                <th>Multas</th>
                <th>Estado</th>
                <th>Fecha de Creación</th>
                <th>Fecha de Última modificación</th>
            </tr>
            <?php foreach ($rowset as $row): ?>
                <tr>
                    <td><?php echo ($row->id ?? ''); ?></td>
                    <td><?php echo ($row->nombre ?? ''); ?></td>
                    <td><?php echo ($row->puntos ?? ''); ?></td>
                    <td><?php echo ($row->ciudad ?? ''); ?></td>
                    <td><?php echo ($row->multas ?? ''); ?></td>
                    <td><?php echo ($row->estado ?? ''); ?></td>
                    <td><?php echo ($row->creado?->format("d/m/Y") ?? ''); ?></td>
                    <td><?php echo ($row->modificado?->format("d/m/Y") ?? ''); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>