<div class="container">
    <h3>Registrar Salida</h3>
    <form action="/asistencia/salida/<?= $idAsistencia ?>" method="POST">
        <div class="form-group">
            <label for="horaSalida">Hora de Salida</label>
            <input type="time" name="horaSalida" id="horaSalida" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Registrar Salida</button>
    </form>
</div>
