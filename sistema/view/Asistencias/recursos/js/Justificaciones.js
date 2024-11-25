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

document.addEventListener("DOMContentLoaded", function () {
    // Variables para los modales y formularios
    const editModal = document.getElementById("editModal");
    const deleteModal = document.getElementById("deleteModal");
    const formEdit = document.getElementById("formEdit");
    const formDelete = document.getElementById("formDelete");

    // Evento para rellenar el modal de edición
    document.querySelectorAll("[data-bs-target='#editModal']").forEach(button => {
        button.addEventListener("click", function () {
            // Rellenar campos del modal de edición
            const id = this.dataset.id;
            const fechaInicio = this.dataset.fechainicio;
            const fechaFin = this.dataset.fechafin;
            const motivo = this.dataset.motivo;

            // Establece los valores en los campos del modal
            formEdit.action = `/biometrico/sistema/controller/AsistenciasController/JustificacionesController.php?action=actualizarJustificaciones&id=${id}`;
            formEdit.querySelector("#edit-fecha_inicio").value = fechaInicio;
            formEdit.querySelector("#edit-fecha_fin").value = fechaFin;
            formEdit.querySelector("#edit-motivo").value = motivo;
        });
    });

    // Evento para gestionar la eliminación con SweetAlert
    document.querySelectorAll("[data-bs-target='#deleteModal']").forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();

            const id = this.dataset.id;

            // Confirmación con SweetAlert
            Swal.fire({
                title: "¿Estás seguro?",
                text: "No podrás deshacer esta acción.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Enviar formulario de eliminación
                    formDelete.action = `/biometrico/sistema/controller/AsistenciasController/JustificacionesController.php?action=EliminarJustificacion&id=${id}`;
                    formDelete.submit();
                }
            });
        });
    });
});
