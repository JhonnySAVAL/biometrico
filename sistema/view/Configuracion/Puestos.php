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

            <div class="col-lg-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h3 class="card-title">Crear Nuevo Puesto</h3>
                    </div>
                    <div class="card-body">

                        <form action="/biometrico/sistema/controller/ConfiguracionesController/PuestosController.php?action=CrearPuesto" method="POST" id="formCrearPuesto">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nombrePuesto">Nombre del Puesto</label>
                                    <input type="text" class="form-control" id="nombrePuesto" name="nombrePuesto" required>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="area">Área</label>
                                    <input type="text" class="form-control" id="area" name="area">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary">Crear Puesto</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Puestos</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre de Puesto</th>
                                    <th>Área</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Puestos as $Puesto): ?>
                                    <tr>
                                        <td><?= $Puesto['nombrePuesto'] ?></td>
                                        <td><?= $Puesto['area'] ?></td>
                                        <td><?= $Puesto['descripcion'] ?></td>
                                        <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                            data-id="<?= $Puesto['idPuesto'] ?>"
                                            data-nombre="<?= $Puesto['nombrePuesto'] ?>"
                                            data-area="<?= $Puesto['area'] ?>"
                                            data-descripcion="<?= $Puesto['descripcion'] ?>">Editar</button>

                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
    data-id="<?= $Puesto['idPuesto'] ?>"
    data-nombre="<?= $Puesto['nombrePuesto'] ?>">Eliminar</button>

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
                <h5 class="modal-title" id="editModalLabel">Editar Puesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditPuesto" action="/biometrico/sistema/controller/ConfiguracionesController/PuestosController.php?action=ActualizarPuesto" method="POST">
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="idPuesto">
                    <div class="form-group">
                        <label for="edit-nombrePuesto">Nombre del Puesto</label>
                        <input type="text" class="form-control" id="edit-nombrePuesto" name="nombrePuesto" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-area">Área</label>
                        <input type="text" class="form-control" id="edit-area" name="area">
                    </div>
                    <div class="form-group">
                        <label for="edit-descripcion">Descripción</label>
                        <input type="text" class="form-control" id="edit-descripcion" name="descripcion" required>
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
                <h5 class="modal-title" id="deleteModalLabel">Eliminar Puesto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de que desea eliminar este puesto?</p>
                <div id="user-list"></div> <!-- Aquí se mostrarán los empleados vinculados -->
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
