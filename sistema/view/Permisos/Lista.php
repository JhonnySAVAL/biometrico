<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Listado de Justificaciones</h3>
                    <a href="/justificaciones/agregar" class="btn btn-success">Agregar Justificación</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Motivo</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($justificaciones as $justificacion): ?>
                                <tr>
                                    <td><?= $justificacion['nombre'] ?></td>
                                    <td><?= $justificacion['fecha_inicio'] ?></td>
                                    <td><?= $justificacion['fecha_fin'] ?></td>
                                    <td><?= $justificacion['motivo'] ?></td>
                                    <td><?= $justificacion['estado'] ?></td>
                                    <td>
                                        <?php if ($justificacion['estado'] == 'Pendiente'): ?>
                                            <a href="/justificaciones/aprobar/<?= $justificacion['idJustificacion'] ?>" class="btn btn-primary">Aprobar</a>
                                            <a href="/justificaciones/rechazar/<?= $justificacion['idJustificacion'] ?>" class="btn btn-danger">Rechazar</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
