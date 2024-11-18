
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

<div class="app-content"> 
    <div class="container-fluid"> 
        <div class="row">
        <div class="container-fluid">
    <div class="row">
        <h3>Empleados Sin Vacaciones Programadas</h3>
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


