document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();  // Previene la acción predeterminada del botón

        // Muestra una alerta de SweetAlert
        Swal.fire({
            icon: "error",
            title: "BOTON EN MANTENIMIENTO",
            text: "Este botón está en mantenimiento. Pronto estará disponible."
        });
    });
});


// $('#editModal').on('show.bs.modal', function (event) {
//     var button = $(event.relatedTarget); 
//     var idPuesto = button.data('id');
//     var nombres = button.data('nombres');
//     var apellidos = button.data('apellidos');
//     var dni = button.data('dni');
//     var correo = button.data('correo');
//     var telefono = button.data('telefono');
//     var puesto = button.data('puesto');
//     var turno = button.data('turno');
//     var habilitado = button.data('habilitado');

//     var modal = $(this);
//     modal.find('#edit-id').val(idPuesto);
//     modal.find('#edit-nombres').val(nombres);
//     modal.find('#edit-apellidos').val(apellidos);
//     modal.find('#edit-dni').val(dni);
//     modal.find('#edit-correo').val(correo);
//     modal.find('#edit-telefono').val(telefono);
//     modal.find('#edit-puesto').val(puesto);
//     modal.find('#edit-turno').val(turno);
//     modal.find('#edit-habilitado').val(habilitado);
// });

