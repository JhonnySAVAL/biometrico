<!-- Contenedor principal -->
<div class="app-content"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">

            <!-- Cabecera del Dashboard -->
            <div class="col-sm-6">
                <h3 class="mb-0">Lista Empleados</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Empleados</li>
                </ol>
            </div>
        </div> <!--end::Row-->

        <div class="row mt-4"> <!--begin::Row-->
            <div class="col-lg-12">
                <!-- Card de Empleados -->
                <div class="card mb-4">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped align-middle text-center"> <!-- Añadido text-center -->
                            <thead>
                                <tr>
                                    <th>DNI</th>
                                    <th>Nombres</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Puesto</th>
                                    <th>Turno</th>
                                    <th>Habilitado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($usuarios)): ?>
                                    <?php foreach ($usuarios as $empleado): ?>
                                        <tr>
                                            <td><?php echo $empleado['dni']; ?></td>
                                            <td><?php echo $empleado['nombres']; ?></td>
                                            <td><?php echo $empleado['apellidos']; ?></td>
                                            <td><?php echo $empleado['correo']; ?></td>
                                            <td><?php echo $empleado['telefono']; ?></td>
                                            <td><?php echo $empleado['puesto']; ?></td>
                                            <td><?php echo $empleado['turno']; ?></td>
                                            <!-- Centrado Estado -->
                                            <td class="text-center align-middle">
                                                <span class="badge bg-<?php echo $empleado['habilitado'] == 'activo' ? 'success' : 'danger'; ?>">
                                                    <?php echo ucfirst($empleado['habilitado']); ?>
                                                </span>
                                            </td>
                                            <!-- Centrado Acciones -->
                                            <td class="text-center align-middle">
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                                    data-id="<?= $empleado['idEmpleado'] ?>"
                                                    data-nombres="<?= $empleado['nombres'] ?>"
                                                    data-apellidos="<?= $empleado['apellidos'] ?>"
                                                    data-correo="<?= $empleado['correo'] ?>"
                                                    data-telefono="<?= $empleado['telefono'] ?>"
                                                    data-puesto="<?= $empleado['puesto'] ?>"
                                                    data-turno="<?= $empleado['turno'] ?>"
                                                    data-habilitado="<?= $empleado['habilitado'] == 'activo' ? '1' : '0'; ?>">Editar</button>

                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="11" class="text-center">No hay empleados registrados.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.col-lg-12 -->
        </div> <!-- end::Row -->
    </div> <!-- end::Container -->
</div> <!-- end::app-content -->

<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Formulario -->
            <form id="formEditEmpleado" action="/biometrico/sistema/controller/UsuariosController/UsuariosController.php?action=actualizarUsuario" method="POST">
                <div class="modal-body">
                    <!-- Campo oculto para ID -->
                    <input type="hidden" id="edit-id" name="idEmpleado">

                    <!-- Nombres -->
                    <div class="form-group">
                        <label for="edit-nombres">Nombres</label>
                        <input type="text" class="form-control" id="edit-nombres" maxlength="50" name="nombres" required>
                    </div>

                    <!-- Apellidos -->
                    <div class="form-group">
                        <label for="edit-apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="edit-apellidos" maxlength="50" name="apellidos" required>
                    </div>
                    <!-- Correo -->
                    <div class="form-group">
                        <label for="edit-correo">Correo</label>
                        <input type="email" class="form-control" id="edit-correo" maxlength="50" name="correo" required>
                    </div>

                    <!-- Teléfono -->
                    <div class="form-group">
                        <label for="edit-telefono">Teléfono</label>
                        <input type="text" class="form-control" id="edit-telefono" maxlength="9" name="telefono" required>
                    </div>

                    <!-- Puesto -->
                    <div class="form-group">
                        <label for="edit-puesto">Puesto</label>
                        <select class="form-select" id="edit-puesto" name="puesto" required>
                            <option value="" disabled selected>Elija el Puesto</option>
                            <?php foreach ($puestos as $puesto): ?>
                                <option value="<?php echo htmlspecialchars($puesto['nombrePuesto']); ?>">
                                    <?php echo htmlspecialchars($puesto['nombrePuesto']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Turno -->
                    <div class="form-group">
                        <label for="edit-turno">Turno</label>
                        <select class="form-select" id="edit-turno" name="turno" required>
                            <option value="" disabled selected>Elija el Turno</option>
                            <?php foreach ($turnos as $turno): ?>
                                <option value="<?php echo htmlspecialchars($turno['descripcion']); ?>">
                                    <?php echo htmlspecialchars($turno['descripcion']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Habilitado -->
                    <div class="form-group d-flex align-items-center col-lg-11">
                        <input type="checkbox" class="form-check-input me-2" id="habilitado" name="habilitado">
                        <label for="habilitado" class="form-check-label">Habilitado</label>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>