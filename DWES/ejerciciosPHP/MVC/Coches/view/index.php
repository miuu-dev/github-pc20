<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Coches</title>
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

        th,
        td {
            padding: 12px 15px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: 600;
            border-bottom: 2px solid #ddd;
        }

        tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        tr:hover {
            background-color: #f1f4f6;
        }

        td {
            border-bottom: 1px solid #eee;
            color: #555;
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>Listado de Coches</h1>
        <table>
            <tr>
                <th>id</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Propietario</th>
                <th>Precio</th>
            </tr>
            <?php foreach ($rowset as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row->id ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row->marca ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row->modelo ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row->color ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row->propietario ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($row->precio ?? ''); ?> €</td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>