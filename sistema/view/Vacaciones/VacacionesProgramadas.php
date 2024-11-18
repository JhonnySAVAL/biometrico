
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
                    <td><?= $vacacion['fechaInicio'] ?></td>
                    <td><?= $vacacion['fechaFin'] ?></td>
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


<