document.addEventListener("DOMContentLoaded", function () {
    const editModal = document.getElementById("editModal");

    editModal.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;

        // Obtén los datos desde los atributos data-*
        const id = button.getAttribute("data-id");
        const nombres = button.getAttribute("data-nombres");
        const apellidos = button.getAttribute("data-apellidos");
        const correo = button.getAttribute("data-correo");
        const telefono = button.getAttribute("data-telefono");
        const puesto = button.getAttribute("data-puesto");
        const turno = button.getAttribute("data-turno");
        const habilitado = button.getAttribute("data-habilitado");

        // Rellena los campos del formulario
        document.getElementById("edit-id").value = id;
        document.getElementById("edit-nombres").value = nombres;
        document.getElementById("edit-apellidos").value = apellidos;
        document.getElementById("edit-correo").value = correo;
        document.getElementById("edit-telefono").value = telefono;
        document.getElementById("edit-puesto").value = puesto;
        document.getElementById("edit-turno").value = turno;

        // Marca o desmarca el checkbox según el estado de habilitado
        const habilitadoCheckbox = document.getElementById("habilitado");
        habilitadoCheckbox.checked = habilitado === "1";
    });
});

document.getElementById("formEditEmpleado").addEventListener("submit", function (event) {
    event.preventDefault(); // Evita el envío inmediato del formulario

    Swal.fire({
        title: "¿Estás seguro?",
        text: "¿Quieres editar este empleado?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, editar!",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            // Envía el formulario al confirmar
            this.submit();
        }
    });
});

const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has("success") && urlParams.get("success") === "true") {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Empleado editado exitosamente",
        showConfirmButton: false,
        timer: 1500,
    }).then(() => {
        // Redirige a la misma página sin el parámetro 'success'
        urlParams.delete("success");
        const newUrl = window.location.pathname + "?" + urlParams.toString();
        window.location.replace(newUrl);
    });
}

$(document).ready(function () {
    $("#tablaEmpleados").DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "print",
                text: "Imprimir",
                exportOptions: {
                    columns: ":not(:last-child):not(:nth-last-child(2))", // Excluir las últimas dos columnas
                },
            },
            {
                extend: "excel",
                text: "Exportar a Excel",
                exportOptions: {
                    columns: ":not(:last-child):not(:nth-last-child(2))",
                },
            },
        ],
        language: {
            url: "//cdn.datatables.net/plug-ins/1.13.5/i18n/es-ES.json", // Traducción al español
        },
    });
});
