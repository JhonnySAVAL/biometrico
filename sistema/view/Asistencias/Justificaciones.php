<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Gestión de Justificaciones</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Gestión de Justificaciones</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <!-- Formulario para Solicitar Justificación -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Solicitar Justificación</h3>
                    </div>
                    <div class="card-body">
                        <form action="/biometrico/sistema/controller/JustificacionesController.php?action=solicitarJustificacion" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="dniEmpleado">DNI Empleado</label>
                                <input type="text" class="form-control" id="dniEmpleado" name="dniEmpleado" placeholder="Ingrese el DNI del empleado" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_fin">Fecha Fin</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                            </div>
                            <div class="form-group">
                                <label for="motivo">Motivo</label>
                                <textarea class="form-control" id="motivo" name="motivo" rows="3" placeholder="Describa el motivo" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="documento">Documento Adjunto</label>
                                <input type="file" class="form-control" id="documento" name="documento">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Solicitar Justificación</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Lista de Justificaciones -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Justificaciones Solicitadas</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>DNI Empleado</th>
                                    <th>Fecha</th>
                                    <th>Motivo</th>
                                    <th>Documento</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($justificaciones as $justificacion): ?>
                                    <tr>
                                        <td><?= $justificacion['dniEmpleado'] ?></td>
                                        <td><?= $justificacion['fecha'] ?></td>
                                        <td><?= $justificacion['motivo'] ?></td>
                                        <td>
                                            <?php if ($justificacion['documento']): ?>
                                                <a href="<?= $justificacion['documento'] ?>" target="_blank">Ver Documento</a>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= $justificacion['estado'] ?></td>
                                        <td>
                                            <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#aprobarModal" 
                                                    data-id="<?= $justificacion['idJustificacion'] ?>">Aprobar</button>
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rechazarModal" 
                                                    data-id="<?= $justificacion['idJustificacion'] ?>">Rechazar</button>
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
</div>

<!-- Modal Aprobar Justificación -->
<div class="modal fade" id="aprobarModal" tabindex="-1" aria-labelledby="aprobarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="aprobarModalLabel">Aprobar Justificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/biometrico/sistema/controller/JustificacionesController.php?action=aprobarJustificacion" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="aprobar-idJustificacion" name="idJustificacion">
                    <p>¿Está seguro de aprobar esta justificación?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Aprobar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Rechazar Justificación -->
<div class="modal fade" id="rechazarModal" tabindex="-1" aria-labelledby="rechazarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rechazarModalLabel">Rechazar Justificación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/biometrico/sistema/controller/JustificacionesController.php?action=rechazarJustificacion" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="rechazar-idJustificacion" name="idJustificacion">
                    <p>¿Está seguro de rechazar esta justificación?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Rechazar</button>
                </div>
            </form>
        </div>
    </div>
</div>
