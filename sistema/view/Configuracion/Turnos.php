<div class="col-sm-6">
    <h3 class="mb-0">Dashboard</h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
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



        <div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Crear Nuevo Turno</h3>
                    </div>
                    <div class="card-body">
                        <form action="/biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=CrearTurno" method="POST" id="formCrearTurno">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            </div>
                            <div class="form-group">
                                <label for="entrada">Entrada</label>
                                <input type="time" class="form-control" id="entrada" name="entrada" required>
                            </div>
                            <div class="form-group">
                                <label for="salida">Salida</label>
                                <input type="time" class="form-control" id="salida" name="salida" required>
                            </div>
                            <div class="form-group">
                                <label for="duracion">Duración</label>
                                <input type="time" class="form-control" id="duracion" name="duracion" required>
                            </div>
                            <div class="form-group">
                                <label for="receso">Receso</label>
                                <input type="time" class="form-control" id="receso" name="receso" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear Turno</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Turnos</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Entrada</th>
                                    <th>Salida</th>
                                    <th>Duración</th>
                                    <th>Receso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Turnos as $Turno): ?>
                                    <tr>
                                        <td><?= $Turno['descripcion'] ?></td>
                                        <td><?= $Turno['entrada'] ?></td>
                                        <td><?= $Turno['salida'] ?></td>
                                        <td><?= $Turno['duracion'] ?></td>
                                        <td><?= $Turno['receso'] ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="<?= $Turno['idTurno'] ?>"
                                                data-descripcion="<?= $Turno['descripcion'] ?>"
                                                data-entrada="<?= $Turno['entrada'] ?>"
                                                data-salida="<?= $Turno['salida'] ?>"
                                                data-duracion="<?= $Turno['duracion'] ?>"
                                                data-receso="<?= $Turno['receso'] ?>">Editar</button>
                                            
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="<?= $Turno['idTurno'] ?>"
                                                data-descripcion="<?= $Turno['descripcion'] ?>">Eliminar</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Modal de Edición -->
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel">Editar Turno</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="formEditTurno" action="/biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=ActualizarTurno" method="POST">
                            <div class="modal-body">
                                <input type="hidden" id="edit-idTurno" name="idTurno">
                                <div class="form-group">
                                    <label for="edit-descripcion">Descripción</label>
                                    <input type="text" class="form-control" id="edit-descripcion" name="descripcion" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-entrada">Entrada</label>
                                    <input type="time" class="form-control" id="edit-entrada" name="entrada" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-salida">Salida</label>
                                    <input type="time" class="form-control" id="edit-salida" name="salida" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-duracion">Duración</label>
                                    <input type="time" class="form-control" id="edit-duracion" name="duracion" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit-receso">Receso</label>
                                    <input type="time" class="form-control" id="edit-receso" name="receso" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal de Eliminación -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Eliminar Turno</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro de que desea eliminar este turno?</p>
                            <div id="user-list"></div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" id="btn-delete">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>




        </div>
    </div>










</div>
</div>