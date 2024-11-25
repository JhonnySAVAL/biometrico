<?php if ($error): ?>
    <p style="color: red;"><?php echo $error; ?></p>
<?php else: ?>
    <h3>Reporte de <?php echo ucfirst($tipo); ?></h3>
    <div class="d-flex mb-3">
        <button onclick="imprimirTabla()" class="btn btn-primary">Imprimir</button>
    </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        $('#tablaReporte').DataTable({
            language: {
                "sProcessing": "Procesando...",
                "sLengthMenu": "Mostrar _MENU_ registros",
                "sZeroRecords": "No se encontraron resultados",
                "sEmptyTable": "Ningún dato disponible en esta tabla",
                "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
            pageLength: 50 // Mostrar 50 registros por página
        });

        // Función para imprimir la tabla
        window.imprimirTabla = function() {
            const tabla = document.getElementById('tablaReporte');
            const ventana = window.open('', '', 'height=500,width=800');
            ventana.document.write('<html><head><title>Reporte</title></head><body>');
            ventana.document.write('<h3>Reporte</h3>');
            ventana.document.write(tabla.outerHTML);
            ventana.document.write('</body></html>');
            ventana.document.close();
            ventana.print();
        };
    });
</script>