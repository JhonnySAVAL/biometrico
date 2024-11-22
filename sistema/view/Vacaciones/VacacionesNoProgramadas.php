<div class="col-sm-6">
    <h3 class="mb-0"></h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Vacaciones sin programar
        </li>
    </ol>
</div>

<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-6">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3>Empleados Sin Vacaciones Programadas</h3>
                            </div>
                            <div class="card-body">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Empleado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($empleados as $empleado): ?>
                                            <tr>
                                                <td><?= htmlspecialchars($empleado['nombres']) ?></td>
                                                <td>
                                                <button class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#modalAsignarVacacion' data-idEmpleado='<?= $empleado['idEmpleado'] ?>'>Asignar Vacaciones</button>

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
    </div>
</div>


<div class="modal fade" id="modalAsignarVacacion" tabindex="-1" aria-labelledby="modalAsignarVacacionLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalAsignarVacacionLabel">Asignar Vacaciones</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAsignarVacacion" method="POST" action="/biometrico/sistema/controller/VacacionesController/VacacionesController.php?action=AsignarVacacion">
          <input type="hidden" name="idEmpleado" id="idEmpleado"> 
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
            <button type="submit" class="btn btn-primary">Guardar Vacaciones</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

