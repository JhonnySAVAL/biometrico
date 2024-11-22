<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Agregar Exoneración</h3>
                </div>
                <div class="card-body">
                    <form action="/exoneraciones/agregar" method="POST">
                        <div class="form-group">
                            <label for="idEmpleado">Empleado</label>
                            <select name="idEmpleado" id="idEmpleado" class="form-control" required>
                                <!-- Aquí deberías cargar los empleados desde la base de datos -->
                                <option value="1">Juan Pérez</option>
                                <option value="2">María González</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha_inicio">Fecha Inicio</label>
                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fecha_fin">Fecha Fin</label>
                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Motivo</label>
                            <textarea name="motivo" id="motivo" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Agregar Exoneración</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
