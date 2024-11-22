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

          
    <!-- Tabla para Feriados Anuales -->
    <h2>Feriados Anuales</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feriadosAnuales as $index => $feriado): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($feriado['nombre']) ?></td>
                    <td><?= htmlspecialchars($feriado['fecha']) ?></td>
                    <td>
                        <a href="/biometrico/sistema/controller/FeriadosController.php?action=EditarFeriado&id=<?= $feriado['idFeriado'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="/biometrico/sistema/controller/FeriadosController.php?action=EliminarFeriado&id=<?= $feriado['idFeriado'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este feriado?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Tabla para Feriados Simples -->
    <h2>Feriados Simples</h2>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feriadosSimples as $index => $feriado): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($feriado['nombre']) ?></td>
                    <td><?= htmlspecialchars($feriado['fecha']) ?></td>
                    <td>
                        <a href="/biometrico/sistema/controller/FeriadosController.php?action=EditarFeriado&id=<?= $feriado['idFeriado'] ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="/biometrico/sistema/controller/FeriadosController.php?action=EliminarFeriado&id=<?= $feriado['idFeriado'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este feriado?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<div class="modal" id="modalFeriados">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gestionar Feriados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/biometrico/sistema/controller/FeriadosController.php?action=CrearFeriado">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select class="form-control" id="tipo" name="tipo">
                            <option value="simple">Simple</option>
                            <option value="anual">Anual</option>
                            <option value="inesperado">Inesperado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="año" class="form-label">Año</label>
                        <input type="number" class="form-control" id="año" name="año" value="<?= date('Y') ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

                </div>
            </div>

        </div>
    </div>
</div>

