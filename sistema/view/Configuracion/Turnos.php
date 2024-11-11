<form action="/turnos/registrar" method="POST">
    <label for="descripcion">Descripción del Turno:</label>
    <input type="text" name="descripcion" required>
    
    <label for="entrada">Hora de Entrada:</label>
    <input type="time" name="entrada" required>
    
    <label for="salida">Hora de Salida:</label>
    <input type="time" name="salida" required>
    
    <label for="duracion">Duración:</label>
    <input type="time" name="duracion" required>
    
    <label for="receso">Receso:</label>
    <input type="time" name="receso" required>
    
    <button type="submit">Registrar Turno</button>
</form>
<table>
    <thead>
        <tr>
            <th>Descripción</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>Duración</th>
            <th>Receso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($turnos as $turno): ?>
        <tr>
            <td><?php echo $turno['descripcion']; ?></td>
            <td><?php echo $turno['entrada']; ?></td>
            <td><?php echo $turno['salida']; ?></td>
            <td><?php echo $turno['duracion']; ?></td>
            <td><?php echo $turno['receso']; ?></td>
            <td>
                <a href="/turnos/ver/<?php echo $turno['idTurno']; ?>">Ver</a>
                <a href="/turnos/editar/<?php echo $turno['idTurno']; ?>">Editar</a>
                <form action="/turnos/eliminar/<?php echo $turno['idTurno']; ?>" method="POST">
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
