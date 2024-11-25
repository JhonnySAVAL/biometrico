<?php if ($error): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php else: ?>
    <h3>Reporte de <?php echo ucfirst($tipo); ?></h3>
    <button onclick="imprimirTabla()" class="btn btn-primary">Imprimir</button>
    <table id="tablaReporte" class="table table-bordered table-striped">
        <thead>
            <tr>
                <?php if (!empty($datos)): ?>
                    <?php foreach (array_keys($datos[0]) as $header): ?>
                        <th><?php echo htmlspecialchars($header); ?></th>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <?php foreach ($fila as $valor): ?>
                        <td><?php echo htmlspecialchars($valor); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#tablaReporte').DataTable();

    // Función para imprimir la tabla
    window.imprimirTabla = function () {
        const tabla = document.getElementById('tablaReporte');
        const ventana = window.open('', '', 'height=500,width=800');
        ventana.document.write('<html><head><title>Reporte</title></head><body>');
        ventana.document.write(tabla.outerHTML);
        ventana.document.write('</body></html>');
        ventana.document.close();
        ventana.print();
    };
});
</script>
