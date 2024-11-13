
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


        <div class="container">
    <h2>Solicitar Permiso</h2>
    <form action="/biometrico/sistema/controller/PermisosController.php?action=solicitarPermiso" method="POST">
        <input type="hidden" name="empleadoId" value="<!-- ID del empleado -->">
        <div class="form-group">
            <label for="fechaInicio">Fecha de Inicio:</label>
            <input type="date" name="fechaInicio" id="fechaInicio" required>
        </div>
        <div class="form-group">
            <label for="fechaFin">Fecha de Fin:</label>
            <input type="date" name="fechaFin" id="fechaFin" required>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <textarea name="motivo" id="motivo" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Solicitar Permiso</button>
    </form>

    <h2>Lista de Permisos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Fin</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($permisos as $permiso): ?>
                <tr>
                    <td><?php echo $permiso['empleadoId']; ?></td>
                    <td><?php echo $permiso['fechaInicio']; ?></td>
                    <td><?php echo $permiso['fechaFin']; ?></td>
                    <td><?php echo $permiso['motivo']; ?></td>
                    <td><?php echo $permiso['estado']; ?></td>
                    <td>
                        <form action="/biometrico/sistema/controller/PermisosController.php?action=aprobarPermiso" method="POST" style="display:inline;">
                            <input type="hidden" name="permisoId" value="<?php echo $permiso['idPermiso']; ?>">
                            <button type="submit" class="btn btn-success">Aprobar</button>
                        </form>
                        <form action="/biometrico/sistema/controller/PermisosController.php?action=rechazarPermiso" method="POST" style="display:inline;">
                            <input type="hidden" name="permisoId" value="<?php echo $permiso['idPermiso']; ?>">
                            <button type="submit" class="btn btn-danger">Rechazar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


            
        </div>
    </div>
</div>