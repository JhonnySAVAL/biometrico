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

    <div class="row justify-content-center">
        <div class="col-lg-6"> <!-- El formulario ahora ocupará el 80% del ancho -->
            <div class="card mb-6 align-items-center">
                <div class="card-body col-md-10">
                    <form id="formCrearUsuario" action="../../controller/UsuariosController/UsuariosCrearController.php?action=agregarUsuario" method="POST">
                        
                        <div class="row mb-4">
                            <!-- Aumenté el ancho de los campos -->
                            <div class="form-group col-md-6">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" maxlength="50" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="50" required>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>

                        <div class="row mb-4">
                            <div class="form-group col-md-6">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" maxlength="8" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="9" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="form-group col-md-6">
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

                            <div class="form-group col-md-6">
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
                        </div>

                        <div class="mb-3">
                            <input type="checkbox" class="form-check-input" id="habilitado" name="habilitado">
                            <label for="habilitado" class="form-check-label">Habilitado</label>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" id="regsitraremp">Registrar Empleado</button>
                            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <button class="btn btn-warning" id="limpiar">Limpiar</button>
                </div>
            </div> <!-- /.card -->
        </div> <!-- /.col-lg-8 -->
    </div> <!-- end::Row -->
</div> <!-- end::Container -->
