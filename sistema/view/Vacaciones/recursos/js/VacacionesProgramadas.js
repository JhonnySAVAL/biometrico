// Asignar los valores de la vacación al formulario cuando se abre el modal de edición
$('#modalEditarVacacion').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // El botón que activó el modal
    var idVacacion = button.data('idvacacion'); // Obtener el idVacacion del botón

    var modal = $(this);
    modal.find('#idVacacion').val(idVacacion); // Asignar el idVacacion al campo oculto

    // Realizar la llamada AJAX para obtener los detalles de la vacación
    $.ajax({
        url: '/biometrico/sistema/controller/VacacionesController/VacacionesController.php?action=ObtenerVacacion',
        method: 'GET',
        data: { idVacacion: idVacacion },
        success: function(response) {
            // Asegúrate de que `response` sea un objeto JSON
            response = JSON.parse(response);
            
            // Asignar los valores a los campos del formulario
            modal.find('#fecha_inicio').val(response.fecha_inicio); 
            modal.find('#fecha_fin').val(response.fecha_fin); 
            modal.find('#motivo').val(response.motivo); 
        }
    });
});
