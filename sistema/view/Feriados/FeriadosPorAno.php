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

                    
                <h3>Feriados del Año <?= $año ?></h3>
<table class="table">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Tipo</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($feriados as $feriado): ?>
            <tr>
                <td><?= htmlspecialchars($feriado['nombre']) ?></td>
                <td><?= $feriado['fecha'] ?></td>
                <td><?= $feriado['tipo'] ?></td>
                <td>
                    <!-- Aquí puedes agregar botones de editar/eliminar según sea necesario -->
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Formularios para crear nuevos feriados -->
<a href="/biometrico/sistema/controller/FeriadosController/FeriadosController.php?action=CrearFeriado&año=<?= $año ?>" class="btn btn-primary">Crear Feriado</a>
<a href="/biometrico/sistema/controller/FeriadosController/FeriadosController.php?action=CrearFeriadoAnual" class="btn btn-secondary">Crear Feriado Anual</a>
<a href="/biometrico/sistema/controller/FeriadosController/FeriadosController.php?action=CopiarFeriadosPorAno" class="btn btn-info">Copiar Feriados</a>


                </div>
            </div>

        </div>
    </div>
</div>

