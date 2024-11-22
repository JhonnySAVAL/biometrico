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
