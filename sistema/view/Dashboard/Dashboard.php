<!--Contenido-->
<div class="col-sm-6">
    <h3 class="mb-0">Dashboard</h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Dashboard v3
        </li>
    </ol>
</div>
</div> <!--end::Row-->
</div> <!--end::Container-->
</div>
<div class="app-content"> <!--begin::Container-->
<div class="container-fluid">
    <div class="row">
        <!-- Asistencias -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Asistencias</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Fecha</th>
                                <th>Hora Entrada</th>
                                <th>Hora Salida</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($asistencias as $asistencia): ?>
                                <tr>
                                    <td><?= $asistencia['nombre'] ?></td>
                                    <td><?= $asistencia['fechaRegistro'] ?></td>
                                    <td><?= $asistencia['horaEntrada'] ?></td>
                                    <td><?= $asistencia['horaSalida'] ?></td>
                                    <td><?= $asistencia['estado'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Justificaciones -->
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Justificaciones</h3>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($justificaciones as $justificacion): ?>
                                <tr>
                                    <td><?= $justificacion['nombre'] ?></td>
                                    <td><?= $justificacion['fechaInicio'] ?></td>
                                    <td><?= $justificacion['fechaFin'] ?></td>
                                    <td><?= $justificacion['motivo'] ?></td>
                                    <td><?= $justificacion['estado'] ?></td>
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