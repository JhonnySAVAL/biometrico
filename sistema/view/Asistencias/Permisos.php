<div class="app-content">
    <div class="container-fluid">
        <div class="row">
            <!-- Título y Navegación -->
            <div class="col-sm-6">
                <h3 class="mb-0">Gestión de Permisos</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Gestión de Permisos</li>
                </ol>
            </div>
        </div>

        <div class="row">
            <!-- Formulario de búsqueda -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Crear Permiso</h3>
                    </div>
                    <div class="card-body">
                        <form action="/biometrico/sistema/controller/AsistenciasController/PermisosController.php?action=solicitarPermiso" method="POST" enctype="multipart/form-data">
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
                                <input type="file" class="form-control" id="documento" name="documento" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Solicitar Permiso</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de permisos -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Permisos Solicitados</h3>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>DNI Empleado</th>
                                    <th>Nombre</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Días de Permiso</th>
                                    <th>Motivo</th>
                                    <th>Documento</th>
                                    <!-- <th>Acciones</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($Permisos as $permiso): ?>
                                    <tr>
                                        <td><?= $permiso['dniEmpleado'] ?></td>
                                        <td><?= $permiso['nombreEmpleado'] ?></td>
                                        <td><?= $permiso['fecha_inicio'] ?></td>
                                        <td><?= $permiso['fecha_fin'] ?></td>
                                        <td>
                                            <?php
                                            $diasPermiso = (strtotime($permiso['fecha_fin']) - strtotime($permiso['fecha_inicio'])) / 86400 + 1;
                                            echo $diasPermiso;
                                            ?>
                                        </td>
                                        <td><?= $permiso['motivo'] ?></td>
                                        <td>
                                            <?php if (!empty($permiso['documento'])): ?>
                                                <a href="<?= $permiso['documento'] ?>" target="_blank">Ver/Descargar</a>
                                            <?php else: ?>
                                                No adjunto
                                            <?php endif; ?>
                                        </td>
                                        <!-- <td>
                                        <!-- <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal"
                                            data-id="<?= $permiso['idPermiso'] ?>"
                                            data-dni="<?= $permiso['dniEmpleado'] ?>"
                                            data-fechainicio="<?= $permiso['fecha_inicio'] ?>"
                                            data-fechafin="<?= $permiso['fecha_fin'] ?>"
                                            data-motivo="<?= $permiso['motivo'] ?>">Editar</button>

                                        <button class="btn btn-danger btn-sm">Eliminar</button>

                                        </td> -->
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

<!-- Modal de edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Permiso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST" enctype="multipart/form-data" action="/biometrico/sistema/controller/AsistenciasController/PermisosController.php?action=actualizar">
    <div class="modal-body">
        <input type="hidden" id="idPermiso" name="idPermiso">
        <input type="hidden" id="documentoActual" name="documentoActual"> <!-- Campo para mantener el documento actual -->

        <div class="form-group">
            <label for="editDniEmpleado">DNI Empleado</label>
            <input type="text" class="form-control" id="editDniEmpleado" name="idEmpleado" readonly>
        </div>
        <div class="form-group">
            <label for="editFechaInicio">Fecha Inicio</label>
            <input type="date" class="form-control" id="editFechaInicio" name="fecha_inicio" required>
        </div>
        <div class="form-group">
            <label for="editFechaFin">Fecha Fin</label>
            <input type="date" class="form-control" id="editFechaFin" name="fecha_fin" required>
        </div>
        <div class="form-group">
            <label for="editMotivo">Motivo</label>
            <textarea class="form-control" id="editMotivo" name="motivo" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="editDocumento">Documento Adjunto</label>
            <input type="file" class="form-control" id="editDocumento" name="documento">
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </div>
</form>

        </div>
    </div>
</div>

<script>
    // Cargar datos en el modal
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que disparó el modal
        document.getElementById('idPermiso').value = button.getAttribute('data-id');
        document.getElementById('editDniEmpleado').value = button.getAttribute('data-dni');
        document.getElementById('editFechaInicio').value = button.getAttribute('data-fechainicio');
        document.getElementById('editFechaFin').value = button.getAttribute('data-fechafin');
        document.getElementById('editMotivo').value = button.getAttribute('data-motivo');
    });

    // Enviar datos del formulario
    document.getElementById('editForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        fetch('/biometrico/sistema/controller/AsistenciasController/PermisosController.php?action=actualizar', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload(); // Recargar la página tras éxito
        })
        .catch(error => console.error('Error:', error));
    });
</script>
