<div class="container">
    <h3>Registrar Entrada</h3>
    <form action="/asistencia/entrada" method="POST">
        <div class="form-group">
            <label for="idEmpleado">Empleado</label>
            <select name="idEmpleado" id="idEmpleado" class="form-control">
                <!-- Aquí deberías cargar los empleados desde la base de datos -->
                <option value="1">Juan Pérez</option>
                <option value="2">María González</option>
            </select>
        </div>
        <div class="form-group">
            <label for="horaEntrada">Hora de Entrada</label>
            <input type="time" name="horaEntrada" id="horaEntrada" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Registrar Entrada</button>
    </form>
</div>
