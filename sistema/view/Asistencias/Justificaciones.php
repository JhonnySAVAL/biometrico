
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
    <h2>Solicitar Justificación</h2>
    <form action="/biometrico/sistema/controller/JustificacionesController.php?action=solicitarJustificacion" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="empleadoId" value="<!-- ID del empleado -->">
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" required>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <textarea name="motivo" id="motivo" required></textarea>
        </div>
        <div class="form-group">
            <label for="documento">Documento (opcional):</label>
            <input type="file" name="documento" id="documento">
        </div>
        <button type="submit" class="btn btn-primary">Solicitar Justificación</button>
    </form>

    <h2>Lista de Justificaciones</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Fecha</th>
                <th>Motivo</th>
                <th>Documento</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($justificaciones as $justificacion): ?>
                <tr>
                    <td><?php echo $justificacion['empleadoId']; ?></td>
                    <td><?php echo $justificacion['fecha']; ?></td>
                    <td><?php echo $justificacion['motivo']; ?></td>
                    <td>
                        <?php if ($justificacion['documento']): ?>
                            <a href="<?php echo $justificacion['documento']; ?>" target="_blank">Ver Documento</a>
                        <?php endif; ?>
                    </td>
                    <td><?php echo $justificacion['estado']; ?></td>
                    <td>
                        <form action="/biometrico/sistema/controller/JustificacionesController.php?action=aprobarJustificacion" method="POST" style="display:inline;">
                            <input type="hidden" name="justificacionId" value="<?php echo $justificacion['idJustificacion']; ?>">
                            <button type="submit" class="btn btn-success">Aprobar</button>
                        </form>
                        <form action="/biometrico/sistema/controller/JustificacionesController.php?action=rechazarJustificacion" method="POST" style="display:inline;">
                            <input type="hidden" name="justificacionId" value="<?php echo $justificacion['idJustificacion']; ?>">
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