$(document).ready(function () {
    // Inicializa el DataTable
    $('#dataTable').DataTable({
        dom: 'Bfrtip', // Botones, filtros y paginación
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Exportar a Excel',
                exportOptions: {
                    columns: ':not(.no-export)' // Excluye la columna con clase 'no-export'
                }
            },
            {
                extend: 'print',
                text: 'Imprimir',
                exportOptions: {
                    columns: ':not(.no-export)' // Excluye la columna con clase 'no-export'
                }
            }
        ],
        // Agregar filtros por mes y año
        initComplete: function () {
            this.api().columns([2, 3]).every(function () {
                var column = this;
                var select = $('<select><option value="">Todos</option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>');
                });
            });
        },
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json" // Traducción a español
        }
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Botón que disparó el modal
        console.log('Modal abierto'); // Depuración
        console.log(button); // Verificar el botón

        document.getElementById('idPermiso').value = button.getAttribute('data-id');
        document.getElementById('editDniEmpleado').value = button.getAttribute('data-dni');
        document.getElementById('editFechaInicio').value = button.getAttribute('data-fechainicio');
        document.getElementById('editFechaFin').value = button.getAttribute('data-fechafin');
        document.getElementById('editMotivo').value = button.getAttribute('data-motivo');
    });
});


// Enviar datos del formulario
document.getElementById('editForm').addEventListener('submit', function (e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('/biometrico/sistema/controller/AsistenciasController/PermisosController.php?action=actualizar', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        location.reload(); // Recargar la página tras éxito
    })
    .catch(error => console.error('Error:', error));
});