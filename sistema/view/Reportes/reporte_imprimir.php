<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte - <?php echo ucfirst($tipo); ?></title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Reporte: <?php echo ucfirst($tipo); ?></h1>
    <h3>Fechas seleccionadas:</h3>
    <ul>
        <?php foreach ($fechas as $fecha): ?>
            <li><?php echo htmlspecialchars($fecha); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php if (!empty($reporte)): ?>
        <table>
            <thead>
                <tr>
                    <?php foreach (array_keys($reporte[0]) as $columna): ?>
                        <th><?php echo htmlspecialchars($columna); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reporte as $fila): ?>
                    <tr>
                        <?php foreach ($fila as $valor): ?>
                            <td><?php echo htmlspecialchars($valor); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron datos para las fechas seleccionadas.</p>
    <?php endif; ?>
</body>
</html>
