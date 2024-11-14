<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Listado de Vacaciones</h3>
                    <a href="/vacaciones/agregar" class="btn btn-success">Agregar Vacación</a>
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
                            <?php foreach ($vacaciones as $vacacion): ?>
                                <tr>
                                    <td><?= $vacacion['nombre'] ?></td>
                                    <td><?= $vacacion['fechaInicio'] ?></td>
                                    <td><?= $vacacion['fechaFin'] ?></td>
                                    <td><?= $vacacion['motivo'] ?></td>
                                    <td><?= $vacacion['estado'] ?></td>
                                    <td>
                                        <?php if ($vacacion['estado'] == 'Pendiente'): ?>
                                            <a href="/vacaciones/aprobar/<?= $vacacion['idVacacion'] ?>" class="btn btn-primary">Aprobar</a>
                                            <a href="/vacaciones/rechazar/<?= $vacacion['idVacacion'] ?>" class="btn btn-danger">Rechazar</a>
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
