
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
    <h2>Solicitar Exoneración</h2>
    <form action="/biometrico/sistema/controller/ExoneracionesController.php?action=solicitarExoneracion" method="POST">
        <input type="hidden" name="empleadoId" value="<!-- ID del empleado -->">
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>
        </div>
        <div class="form-group">
            <label for="tipo_exoneracion">Tipo de Exoneración:</label>
            <select name="tipo_exoneracion" id="tipo_exoneracion" required>
                <option value="asistencia">Asistencia</option>
                <option value="tardanza">Tardanza</option>
                <option value="receso">Receso</option>
            </select>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <textarea name="motivo" id="motivo" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Solicitar Exoneración</button>
    </form>

    <h2>Lista de Exoneraciones</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Motivo</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exoneraciones as $exoneracion): ?>
                <tr>
                    <td><?php echo $exoneracion['empleadoId']; ?></td>
                    <td><?php echo $exoneracion['fecha']; ?></td>
                    <td><?php echo $exoneracion['tipo_exoneracion']; ?></td>
                    <td><?php echo $exoneracion['motivo']; ?></td>
                    <td><?php echo $exoneracion['estado']; ?></td>
                    <td>
                        <form action="/biometrico/sistema/controller/ExoneracionesController.php?action=aprobarExoneracion" method="POST" style="display:inline;">
                            <input type="hidden" name="exoneracionId" value="<?php echo $exoneracion['idExoneracion']; ?>">
                            <button type="submit" class="btn btn-success">Aprobar</button>
                        </form>
                        <form action="/biometrico/sistema/controller/ExoneracionesController.php?action=rechazarExoneracion" method="POST" style="display:inline;">
                            <input type="hidden" name="exoneracionId" value="<?php echo $exoneracion['idExoneracion']; ?>">
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