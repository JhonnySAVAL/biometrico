$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var idPuesto = button.data('id');
    var nombrePuesto = button.data('nombre');
    var area = button.data('area');
    var descripcion = button.data('descripcion');
    
    var modal = $(this);
    modal.find('#edit-id').val(idPuesto);
    modal.find('#edit-nombrePuesto').val(nombrePuesto);
    modal.find('#edit-area').val(area);
    modal.find('#edit-descripcion').val(descripcion);
});
$('#deleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // El botón que abre el modal
    var idPuestoEliminar = button.data('id'); // Obtienes el id del puesto
    var nombrePuesto = button.data('nombre'); // Obtienes el nombre del puesto
    
    // Guardamos el idPuestoEliminar en una variable global del modal
    var modal = $(this);
    modal.find('.modal-title').text('Eliminar puesto: ' + nombrePuesto);
    
    // Almacenamos el ID del puesto en el modal para acceder a él en el evento de eliminación
    modal.data('idPuestoEliminar', idPuestoEliminar);

    // Hacemos la llamada AJAX para verificar los empleados vinculados
    $.ajax({
        url: '/biometrico/sistema/controller/ConfiguracionesController/PuestosController.php?action=VerificarUsuariosPorPuesto',
        method: 'GET',
        data: { idPuesto: idPuestoEliminar },
        success: function (response) {
            var userListHtml = ''; // Variable para contener el HTML de la lista de empleados
            
            if (response.empleados && response.empleados.length > 0) {
                // Si hay empleados, mostramos su lista
                userListHtml = '<p>Este puesto tiene los siguientes empleados vinculados:</p><ul>';
                response.empleados.forEach(function (empleado) {
                    userListHtml += '<li>DNI: ' + empleado.dni + ' - ' + empleado.nombre + '</li>';
                });
                userListHtml += '</ul>';
                $('#btn-delete').prop('disabled', true);  // Deshabilitar el botón de eliminación
            } else {
                // Si no hay empleados, mostramos un mensaje vacío
                userListHtml = '<p>No hay empleados vinculados a este puesto.</p>';
                $('#btn-delete').prop('disabled', false);  // Habilitar el botón de eliminación
            }

            // Actualizamos el modal con el HTML de la lista de empleados o mensaje vacío
            modal.find('#user-list').html(userListHtml);
        },
        error: function() {
            Swal.fire({
                title: 'Error',
                text: 'Hubo un problema con la conexión al servidor.',
                icon: 'error'
            });
        }
    });
});


$('#btn-delete').off('click').on('click', function () {
    // Recuperamos el idPuestoEliminar almacenado en el modal
    var idPuestoEliminar = $('#deleteModal').data('idPuestoEliminar');
    
    if (idPuestoEliminar !== undefined && $('#btn-delete').prop('disabled') === false) {
        $.ajax({
            url: '/biometrico/sistema/controller/ConfiguracionesController/PuestosController.php?action=EliminarPuesto',
            method: 'POST',
            data: { idPuesto: idPuestoEliminar },
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'El puesto ha sido eliminado correctamente.',
                        icon: 'success'
                    }).then(() => {
                        location.reload();  
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Este puesto tiene empleados vinculados. No se puede eliminar.',
                        icon: 'error'
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema con la conexión al servidor.',
                    icon: 'error'
                });
            }
        });
    } else {
        alert('Primero debe mover los empleados vinculados a este puesto.');
    }
});



document.getElementById('formCrearPuesto').addEventListener('submit', function(event) {
    event.preventDefault(); 

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres crear este nuevo puesto?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, crear!'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
            setTimeout(function() {
                location.reload();  
            }, 1000); 
        }
    });
});
