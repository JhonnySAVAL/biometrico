<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Listado de Exoneraciones</h3>
                    <a href="/exoneraciones/agregar" class="btn btn-success">Agregar Exoneración</a>
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
                            <?php foreach ($exoneraciones as $exoneracion): ?>
                                <tr>
                                    <td><?= $exoneracion['nombre'] ?></td>
                                    <td><?= $exoneracion['fechaInicio'] ?></td>
                                    <td><?= $exoneracion['fechaFin'] ?></td>
                                    <td><?= $exoneracion['motivo'] ?></td>
                                    <td><?= $exoneracion['estado'] ?></td>
                                    <td>
                                        <?php if ($exoneracion['estado'] == 'Pendiente'): ?>
                                            <a href="/exoneraciones/aprobar/<?= $exoneracion['idExoneracion'] ?>" class="btn btn-primary">Aprobar</a>
                                            <a href="/exoneraciones/rechazar/<?= $exoneracion['idExoneracion'] ?>" class="btn btn-danger">Rechazar</a>
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
