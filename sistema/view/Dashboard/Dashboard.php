<?php
date_default_timezone_set('America/Lima'); // Establece la zona horaria de Perú
?>
<div class="col-sm-6">
    <h3 class="mb-0">Dashboard</h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
        Dashboard
        </li>
    </ol>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
            

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>DNI</th>
                                        <th>Empleado</th>
                                        <th>Puesto</th>
                                        <th>Turno</th>
                                        <th>Estado</th>
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
