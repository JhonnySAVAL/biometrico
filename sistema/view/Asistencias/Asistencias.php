<?php
date_default_timezone_set('America/Lima'); // Establece la zona horaria de Perú
?>
<div class="col-sm-6">
    <h3 class="mb-0">Asistencias</h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Asistencias
        </li>
    </ol>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Asistencias</h3>
                    </div>
                    <div class="card-body">
                    <div class="d-flex mb-3">
                        <button class="btn btn-success btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#modalMarcarEntrada">Marcar Entrada</button>
                        <button class="btn btn-warning btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#modalMarcarReceso">Marcar Receso</button>
                        <button class="btn btn-warning btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#modalMarcarFinReceso">Marcar FIN Receso</button>
                        <button class="btn btn-danger btn-sm mx-1" data-bs-toggle="modal" data-bs-target="#modalMarcarSalida">Marcar Salida</button>
                    </div>


                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>DNI</th>
                                        <th>Empleado</th>
                                        <th>Puesto</th>
                                        <th>Turno</th>
                                        <th>Estado</th>
                                        <th>Hora de Ingreso</th>
                                        <th>Hora Receso</th>
                                        <th>Hora Fin Receso</th>
                                        <th>Hora de Salida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($estadoAsistencias as $asistencia): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($asistencia['dni']) ?></td>
                                            <td><?= htmlspecialchars($asistencia['nombres'] . ' ' . $asistencia['apellidos']) ?></td>
                                            <td><?= htmlspecialchars($asistencia['puesto']) ?></td>
                                            <td><?= htmlspecialchars($asistencia['turno']) ?></td>
                                            <td><?= htmlspecialchars($asistencia['estado']) ?></td>
                                            <td><?= htmlspecialchars($asistencia['hora_entrada']) ?></td>
                                            <td><?= htmlspecialchars($asistencia['hora_receso']) ?></td>
                                            <td><?= htmlspecialchars($asistencia['hora_receso_final']) ?></td>
                                            <td><?= htmlspecialchars($asistencia['hora_salida']) ?></td>
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
</div>


<!-- Modal para marcar entrada -->
<div class="modal fade" id="modalMarcarEntrada" tabindex="-1" aria-labelledby="modalMarcarEntradaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formMarcarEntrada">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMarcarEntradaLabel">Marcar Entrada</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Campo para ingresar DNI del empleado -->
                    <div class="mb-3">
                        <label for="dniEntrada" class="form-label">DNI del Empleado</label>
                        <input type="text" class="form-control" id="dniEntrada" name="dni" required maxlength="8" minlength="8" pattern="\d{8}" placeholder="Ingrese DNI de 8 dígitos">
                    </div>
                    <div class="mb-3">
                        <label for="horaEntrada" class="form-label">Hora de Entrada</label>
                        <input type="text" class="form-control" id="horaEntrada" name="horaEntrada" value="<?php echo date('H:i'); ?>" readonly disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar Entrada</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para marcar receso -->
<div class="modal fade" id="modalMarcarReceso" tabindex="-1" aria-labelledby="modalMarcarRecesoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formMarcarReceso">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMarcarRecesoLabel">Marcar Receso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="dniReceso" class="form-label">DNI del Empleado</label>
                        <input type="text" class="form-control" id="dniReceso" name="dniReceso" required maxlength="8" minlength="8" pattern="\d{8}" placeholder="Ingrese DNI de 8 dígitos">
                    </div>
                    <div class="mb-3">
                        <label for="horaReceso" class="form-label">Hora de Inicio de Receso</label>
                        <input type="text" class="form-control" id="horaReceso" name="horaReceso" value="<?php echo date('H:i'); ?>" readonly disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Registrar Receso</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para marcar fin de receso -->
<div class="modal fade" id="modalMarcarFinReceso" tabindex="-1" aria-labelledby="modalMarcarFinRecesoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formMarcarFinReceso">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMarcarFinRecesoLabel">Marcar Fin de Receso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="dniFinReceso" class="form-label">DNI del Empleado</label>
                        <input type="text" class="form-control" id="dniFinReceso" name="dniFinReceso" required maxlength="8" minlength="8" pattern="\d{8}" placeholder="Ingrese DNI de 8 dígitos">
                    </div>
                    <div class="mb-3">
                        <label for="horaFinReceso" class="form-label">Hora de Fin de Receso</label>
                        <input type="text" class="form-control" id="horaFinReceso" name="horaFinReceso" value="<?php echo date('H:i'); ?>" readonly disabled>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-warning">Registrar Fin de Receso</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para marcar salida -->
<div class="modal fade" id="modalMarcarSalida" tabindex="-1" aria-labelledby="modalMarcarSalidaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formMarcarSalida">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMarcarSalidaLabel">Marcar Salida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="dniSalida" class="form-label">DNI del Empleado</label>
                        <input type="text" class="form-control" id="dniSalida" name="dniSalida" required maxlength="8" minlength="8" pattern="\d{8}" placeholder="Ingrese DNI de 8 dígitos">
                    </div>
                    <div class="mb-3">
                        <label for="horaSalida" class="form-label">Hora de Salida</label>
                        <input type="text" class="form-control" id="horaSalida" name="horaSalida" value="<?php echo date('H:i'); ?>" readonly disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Registrar Salida</button>
                </div>
            </form>
        </div>
    </div>
</div>