<!DOCTYPE html>
<html lang="es">

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Registrar Empleado</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard v3</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h3 class="card-title">Registrar Empleado</h3>
                    </div>
                    <div class="card-body">
                        <form action="../../controller/UsuariosController/UsuariosCrearController.php" method="POST">

                            <div class="mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" maxlength="50" required>
                            </div>

                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="50" required>
                            </div>

                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" maxlength="8" required>
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="9" required>
                            </div>

                            <div class="mb-3">
                                <label for="puesto" class="form-label">Puesto</label>
                                <select class="form-select" id="puesto" name="puesto" required>
                                    <option value="" disabled selected>Elija el Puesto</option>
                                    <?php foreach ($puestos as $puesto): ?>
                                        <option value="<?php echo htmlspecialchars($puesto['nombrePuesto']); ?>">
                                            <?php echo htmlspecialchars($puesto['nombrePuesto']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="turno" class="form-label">Turno</label>
                                <select class="form-select" id="turno" name="turno" required>
                                    <option value="" disabled selected>Elija el Turno</option>
                                    <?php foreach ($turnos as $turno): ?>
                                        <option value="<?php echo htmlspecialchars($turno['descripcion']); ?>">
                                            <?php echo htmlspecialchars($turno['descripcion']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <input type="checkbox" class="form-check-input" id="habilitado" name="habilitado" maxlength="9" required>
                                <label for="habilitado" class="form-check-label">Habilitado</label>
                            </div>

                            <button type="submit" class="btn btn-primary">Registrar Empleado</button>
                            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                        </form>
                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.col-lg-6 -->
        </div> <!-- end::Row -->
    </div> <!-- end::Container -->

    <!-- Vinculando Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>