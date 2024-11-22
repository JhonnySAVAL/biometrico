<div class="col-sm-6">
    <h3 class="mb-0">Dashboard</h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Dashboard v3
        </li>
    </ol>
</div>
</div>
</div>
</div>
<div class="app-content">
    <div class="container-fluid">
        <div class="row">

            <div class="container-fluid">
                <div class="row">
                    <h3>Vacaciones Programadas</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Motivo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vacaciones as $vacacion): ?>
                                <tr>
                                    <td><?= htmlspecialchars($vacacion['nombres']) ?></td>
                                    <td><?= $vacacion['fecha_inicio'] ?></td>
                                    <td><?= $vacacion['fecha_fin'] ?></td>
                                    <td><?= htmlspecialchars($vacacion['motivo']) ?></td>
                                    <td>
                                        <button class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#modalEditarVacacion' data-idVacacion='<?= $vacacion['idVacacion'] ?>'>Editar</button>
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

<div class="modal fade" id="modalEditarVacacion" tabindex="-1" aria-labelledby="modalEditarVacacionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarVacacionLabel">Editar Vacaciones</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarVacacion" method="POST" action="/biometrico/sistema/controller/VacacionesController/VacacionesController.php?action=EditarVacacion">
                    <input type="hidden" name="idVacacion" id="idVacacion">
                    <div class="mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                        <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" required>
                    </div>
                    <div class="mb-3">
                        <label for="motivo" class="form-label">Motivo</label>
                        <textarea class="form-control" name="motivo" id="motivo" rows="3" required></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>