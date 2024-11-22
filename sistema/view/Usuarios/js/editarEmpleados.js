$('#editModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Botón que activó el modal

    // Obtén los valores de los atributos data-*
    var idPuesto = button.data('id') || ''; // Valor por defecto si no existe
    var nombres = button.data('nombres') || '';
    var apellidos = button.data('apellidos') || '';
    var dni = button.data('dni') || '';
    var correo = button.data('correo') || '';
    var telefono = button.data('telefono') || '';
    var puesto = button.data('puesto') || '';
    var turno = button.data('turno') || '';
    var habilitado = button.data('habilitado') || '';

    // Llenar los campos del modal
    var modal = $(this);
    modal.find('#edit-id').val(idPuesto);
    modal.find('#edit-nombres').val(nombres);
    modal.find('#edit-apellidos').val(apellidos);
    modal.find('#edit-dni').val(dni);
    modal.find('#edit-correo').val(correo);
    modal.find('#edit-telefono').val(telefono);
    modal.find('#edit-puesto').val(puesto);
    modal.find('#edit-turno').val(turno);

    // Configurar el checkbox de habilitado
    modal.find('#habilitado').prop('checked', habilitado === 'activo');
});