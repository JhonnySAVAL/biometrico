// Asignar el idEmpleado al formulario cuando se abre el modal
$('#modalAsignarVacacion').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // El botón que activó el modal
    var idEmpleado = button.data('idempleado'); // Obtén el valor de data-idEmpleado

    var modal = $(this);
    modal.find('#idEmpleado').val(idEmpleado); // Asigna el idEmpleado al campo oculto
});
