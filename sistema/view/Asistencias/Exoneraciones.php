<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Gestión de Exoneraciones</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gestión de Exoneraciones</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <!-- Formulario para Solicitar Exoneración -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Solicitar Exoneración</h3>
                    </div>
                    <div class="card-body">
                        <form action="/biometrico/sistema/controller/ExoneracionesController.php?action=solicitarExoneracion" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="dniEmpleado">DNI Empleado</label>
                                <input type="text" class="form-control" id="dniEmpleado" name="dniEmpleado" placeholder="Ingrese el DNI del empleado" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                            <div class="form-group">
                                <label for="fecha_fin">Fecha Fin</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
                            </div>
                            <div class="form-group">
                                <label for="motivo">Motivo</label>
                                <textarea class="form-control" id="motivo" name="motivo" rows="3" placeholder="Describa el motivo" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="documento">Documento Adjunto</label>
                                <input type="file" class="form-control" id="documento" name="documento">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Solicitar Exoneración</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de Exoneraciones -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Exoneraciones Solicitadas</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>DNI Empleado</th>
                                    <th>Nombre</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Días de Exoneración</th>
                                    <th>Motivo</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($exoneraciones as $exoneracion): ?>
                                    <tr>
                                        <td><?= $exoneracion['dniEmpleado'] ?></td>
                                        <td><?= $exoneracion['nombreEmpleado'] ?></td>
                                        <td><?= $exoneracion['fecha_inicio'] ?></td>
                                        <td><?= $exoneracion['fecha_fin'] ?></td>
                                        <td>
                                            <?php 
                                            $diasExoneracion = (strtotime($exoneracion['fecha_fin']) - strtotime($exoneracion['fecha_inicio'])) / 86400 + 1;
                                            echo $diasExoneracion;
                                            ?>
                                        </td>
                                        <td><?= $exoneracion['motivo'] ?></td>
                                        <td>
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                                data-id="<?= $exoneracion['idExoneracion'] ?>"
                                                data-dni="<?= $exoneracion['dniEmpleado'] ?>"
                                                data-fechainicio="<?= $exoneracion['fecha_inicio'] ?>"
                                                data-fechafin="<?= $exoneracion['fecha_fin'] ?>"
                                                data-motivo="<?= $exoneracion['motivo'] ?>">Editar</button>
                                            
                                            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="<?= $exoneracion['idExoneracion'] ?>">Eliminar</button>
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
</div>


<!-- Modales -->
<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Exoneración</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formEditExoneracion" method="POST" action="/biometrico/sistema/controller/AsistenciasController/ExoneracionesController.php?action=ActualizarExoneracion">
                <div class="modal-body">
                    <input type="hidden" id="edit-idExoneracion" name="idExoneracion">
                    <div class="form-group">
                        <label for="edit-idEmpleado">ID Empleado</label>
                        <input type="text" class="form-control" id="edit-idEmpleado" name="idEmpleado" readonly>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="edit-fecha_inicio">Fecha Inicio</label>
                            <input type="date" class="form-control" id="edit-fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="edit-fecha_fin">Fecha Fin</label>
                            <input type="date" class="form-control" id="edit-fecha_fin" name="fecha_fin" required>
                        </div>
                    </div>
                    <div class="form-group"> 
                        <label for="edit-motivo">Motivo</label>
                        <textarea class="form-control" id="edit-motivo" name="motivo" rows="3" required></textarea>
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
                <h5 class="modal-title" id="deleteModalLabel">Eliminar Exoneración</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro de que desea eliminar esta exoneración?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="btn-delete">Eliminar</button>
            </div>
        </div>
    </div>
</div>
