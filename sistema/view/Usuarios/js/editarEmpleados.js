// $('#editEmpleadoModal').on('show.bs.modal', function (event) {
//     var button = $(event.relatedTarget); 
//     var idEmpleado = button.data('id');
//     var nombreEmpleado = button.data('nombre');
//     var dni = button.data('dni');
//     var telefono = button.data('telefono');
//     var puesto = button.data('puesto');
//     var turno = button.data('turno');
    
//     var modal = $(this);
//     modal.find('#edit-idEmpleado').val(idEmpleado);
//     modal.find('#edit-nombres').val(nombreEmpleado);
//     modal.find('#edit-dni').val(dni);
//     modal.find('#edit-telefono').val(telefono);
//     modal.find('#edit-puesto').val(puesto);
//     modal.find('#edit-turno').val(turno);
// });

// $('#deleteEmpleadoModal').on('show.bs.modal', function (event) {
//     var button = $(event.relatedTarget); 
//     var idEmpleadoEliminar = button.data('id'); 
//     var nombreEmpleado = button.data('nombre'); 
    
//     var modal = $(this);
//     modal.find('.modal-title').text('Eliminar empleado: ' + nombreEmpleado);
//     modal.data('idEmpleadoEliminar', idEmpleadoEliminar);

//     // Realizamos una llamada AJAX para verificar si el empleado tiene alguna vinculación
//     $.ajax({
//         url: '/biometrico/sistema/controller/EmpleadosController.php?action=VerificarTareasPorEmpleado',
//         method: 'GET',
//         data: { idEmpleado: idEmpleadoEliminar },
//         success: function (response) {
//             var userListHtml = ''; 
//             if (response.tareas && response.tareas.length > 0) {
//                 userListHtml = '<p>Este empleado tiene las siguientes tareas vinculadas:</p><ul>';
//                 response.tareas.forEach(function (tarea) {
//                     userListHtml += '<li>Tarea: ' + tarea.nombre + ' - Estado: ' + tarea.estado + '</li>';
//                 });
//                 userListHtml += '</ul>';
//                 $('#btn-deleteEmpleado').prop('disabled', true);  // Deshabilitar el botón de eliminación
//             } else {
//                 userListHtml = '<p>No hay tareas vinculadas a este empleado.</p>';
//                 $('#btn-deleteEmpleado').prop('disabled', false);  // Habilitar el botón de eliminación
//             }
//             modal.find('#task-list').html(userListHtml);
//         },
//         error: function() {
//             Swal.fire({
//                 title: 'Error',
//                 text: 'Hubo un problema con la conexión al servidor.',
//                 icon: 'error'
//             });
//         }
//     });
// });

// $('#btn-deleteEmpleado').off('click').on('click', function () {
//     var idEmpleadoEliminar = $('#deleteEmpleadoModal').data('idEmpleadoEliminar');
//     if (idEmpleadoEliminar !== undefined && $('#btn-deleteEmpleado').prop('disabled') === false) {
//         $.ajax({
//             url: '/biometrico/sistema/controller/EmpleadosController.php?action=EliminarEmpleado',
//             method: 'POST',
//             data: { idEmpleado: idEmpleadoEliminar },
//             success: function (response) {
//                 if (response.success) {
//                     Swal.fire({
//                         title: 'Éxito',
//                         text: 'El empleado ha sido eliminado correctamente.',
//                         icon: 'success'
//                     }).then(() => {
//                         location.reload();  
//                     });
//                 } else {
//                     Swal.fire({
//                         title: 'Error',
//                         text: 'Este empleado tiene tareas vinculadas. No se puede eliminar.',
//                         icon: 'error'
//                     });
//                 }
//             },
//             error: function() {
//                 Swal.fire({
//                     title: 'Error',
//                     text: 'Hubo un problema con la conexión al servidor.',
//                     icon: 'error'
//                 });
//             }
//         });
//     } else {
//         alert('Primero debe mover las tareas vinculadas a este empleado.');
//     }
// });

document.getElementById('formEditEmpleado').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío inmediato del formulario

    // Mostrar la alerta de confirmación con SweetAlert
    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres confirmar la edición?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, editar!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Si el usuario confirma, enviar el formulario
            this.submit();

            // Esperar 1 segundo antes de recargar la página (para dar tiempo a que se procese la actualización)
            setTimeout(function() {
                location.reload();  
            }, 1000); 
        }
    });
});