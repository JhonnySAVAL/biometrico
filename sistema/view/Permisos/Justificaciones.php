<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">Agregar Justificación</h3>
                </div>
                <div class="card-body">
                    <form action="/justificaciones/agregar" method="POST">
                        <div class="form-group">
                            <label for="idEmpleado">Empleado</label>
                            <select name="idEmpleado" id="idEmpleado" class="form-control" required>
                                <!-- Aquí deberías cargar los empleados desde la base de datos -->
                                <option value="1">Juan Pérez</option>
                                <option value="2">María González</option>
                                <!-- Agregar más empleados según corresponda -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fechaInicio">Fecha Inicio</label>
                            <input type="date" name="fechaInicio" id="fechaInicio" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="fechaFin">Fecha Fin</label>
                            <input type="date" name="fechaFin" id="fechaFin" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="motivo">Motivo</label>
                            <textarea name="motivo" id="motivo" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Agregar Justificación</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
