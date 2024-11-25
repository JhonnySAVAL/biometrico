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
        <div class="d-flex mb-3">
            <!-- Botón para Crear Feriado Simple -->
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearFeriado" onclick="document.getElementById('tipo').value = 'simple'; document.getElementById('anioDiv').style.display = 'none';">
                Crear Feriado
            </button>
            <!-- Botón para Crear Feriado Anual -->
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalCopiarFeriado" onclick="copiarFeriados(2024)">
                Copiar Feriado Anual
            </button>
            </div>
            <div class="col-lg-5">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2>Feriados Simples</h2>
                    </div>

                    <div class="card-body table-responsive"></div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($feriadosSimples as $index => $feriado): ?>
                                <tr>
                                    <td><?= htmlspecialchars($feriado['nombre']) ?></td>
                                    <td><?= htmlspecialchars($feriado['fecha']) ?></td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarFeriado"
                                            onclick="editarFeriado(<?= $feriado['idFeriado'] ?>)">
                                            Editar
                                        </a>
                                        <a href="/biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=EliminarFeriado&id=<?= $feriado['idFeriado'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este feriado?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="card mb-3">
                    <div class="card-header">
                        <h2>Feriados Anuales</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($feriadosAnuales as $index => $feriado): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($feriado['nombre']) ?></td>
                                        <td><?= htmlspecialchars($feriado['fecha']) ?></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditarFeriado"
                                                onclick="editarFeriado(<?= $feriado['idFeriado'] ?>)">
                                                Editar
                                            </a>
                                            <a href="/biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=EliminarFeriado&id=<?= $feriado['idFeriado'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este feriado?')">Eliminar</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal para Crear Feriados -->
            <div class="modal" id="modalCrearFeriado" tabindex="-1" aria-labelledby="modalCrearFeriadoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCrearFeriadoLabel">Crear Feriado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=CrearFeriado">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo de Feriado</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option value="simple">Simple</option>
                                        <option value="anual">Anual</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="anioDiv" style="display: none;">
                                    <label for="anio" class="form-label">Año</label>
                                    <input type="number" class="form-control" id="anio" name="anio" value="<?= date('Y') ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Copiar Feriados Anuales -->
<div class="modal" id="modalCopiarFeriado">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Copiar Feriados Anuales</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formCopiarFeriado" method="POST" action="/biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=CopiarFeriados">
                    <div class="mb-3">
                        <label for="anioOriginal" class="form-label">Año Original</label>
                        <select class="form-control" id="anioOriginal" name="anioOriginal" required>
                            <?php foreach ($aniosDisponibles as $anio): ?>
                                <option value="<?= $anio['anio'] ?>"><?= $anio['anio'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="anioDestino" class="form-label">Año Destino</label>
                        <input type="number" class="form-control" id="anioDestino" name="anioDestino" required>
                    </div>

                    <div class="mb-3" id="feriadosSeleccionados">
                        <label for="feriados" class="form-label">Seleccionar Feriados</label>
                        <div id="feriadosLista">
                            <!-- Los feriados aparecerán aquí como checkboxes -->
                            <!-- Cargar dinámicamente los feriados con JS -->
                        </div>
                    </div>

                    <button type="button" class="btn btn-primary" id="confirmarCopiarBtn" onclick="confirmarCopiarFeriados()">Confirmar Copiado</button>
                </form>
            </div>
        </div>
    </div>
</div>


            <!-- Modal para Editar Feriados -->
            <div class="modal" id="modalEditarFeriado" tabindex="-1" aria-labelledby="modalEditarFeriadoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalEditarFeriadoLabel">Editar Feriado</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="/biometrico/sistema/controller/ConfiguracionesController/FeriadosController.php?action=ActualizarFeriado">
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required value="<?= htmlspecialchars($feriado['nombre']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" name="fecha" required value="<?= htmlspecialchars($feriado['fecha']) ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="tipo" class="form-label">Tipo de Feriado</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option value="simple" <?= $feriado['tipo'] == 'simple' ? 'selected' : '' ?>>Simple</option>
                                        <option value="anual" <?= $feriado['tipo'] == 'anual' ? 'selected' : '' ?>>Anual</option>
                                    </select>
                                </div>
                                <div class="mb-3" id="anioDiv" style="display: <?= $feriado['tipo'] == 'anual' ? 'block' : 'none' ?>;">
                                    <label for="anio" class="form-label">Año</label>
                                    <input type="number" class="form-control" id="anio" name="anio" value="<?= $feriado['anio'] ?>" required>
                                </div>
                                <input type="hidden" name="idFeriado" value="<?= $feriado['idFeriado'] ?>"> <!-- Id del feriado a editar -->
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>