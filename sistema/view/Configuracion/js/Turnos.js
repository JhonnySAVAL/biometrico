$(document).ready(function () {
    // Editar Turno
    $('#editModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idTurno = button.data('id');
        var descripcion = button.data('descripcion');
        var entrada = button.data('entrada');
        var salida = button.data('salida');
        var receso = button.data('receso');

        var modal = $(this);
        modal.find('#edit-idTurno').val(idTurno);
        modal.find('#edit-descripcion').val(descripcion);
        modal.find('#edit-entrada').val(entrada);
        modal.find('#edit-salida').val(salida);

        
        modal.find('#edit-receso').val(receso);
    });

    // Eliminar Turno
    $('#deleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var idTurno = button.data('id');
        var descripcion = button.data('descripcion');
        var modal = $(this);
        
        modal.find('.modal-title').text('Eliminar Turno: ' + descripcion);
        
        $.ajax({
            url: '/biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=VerificarUsuariosPorTurno',
            method: 'GET',
            data: { idTurno: idTurno },
            success: function(response) {
                var userListHtml = '';
                if (response.empleados && response.empleados.length > 0) {
                    userListHtml = '<p>Este turno está asignado a los siguientes empleados:</p><ul>';
                    response.empleados.forEach(function (empleado) {
                        userListHtml += '<li>' + empleado.dni + ' - ' + empleado.nombre + ' ' + empleado.apellido + '</li>';
                    });
                    userListHtml += '</ul>';
                    $('#btn-delete').prop('disabled', true);
                } else {
                    userListHtml = '<p>No hay empleados asignados a este turno.</p>';
                    $('#btn-delete').prop('disabled', false);
                }
                modal.find('#user-list').html(userListHtml);
            }
        });
        
        $('#btn-delete').off('click').on('click', function () {
            $.ajax({
                url: '/biometrico/sistema/controller/ConfiguracionesController/TurnosController.php?action=EliminarTurno',
                method: 'POST',
                data: { idTurno: idTurno },
                success: function () {
                    window.location.reload();
                }
            });
        });
    });
});
