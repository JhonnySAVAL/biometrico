<div class="container">
    <h3>Asistencias del <?= $fecha ?></h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Hora Entrada</th>
                <th>Hora Salida</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($asistencias as $asistencia): ?>
                <tr>
                    <td><?= $asistencia['nombre'] ?></td>
                    <td><?= $asistencia['horaEntrada'] ?></td>
                    <td><?= $asistencia['horaSalida'] ?></td>
                    <td><?= $asistencia['estado'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
