function mostrarAlertaExito(mensaje) {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: mensaje,
        showConfirmButton: false,
        timer: 1500
    });
}

function mostrarAlertaError(mensaje) {
    Swal.fire({
        icon: "error",
        title: "Oops...",
        text: mensaje,
        footer: '<a href="#">Why do I have this issue?</a>'
    });
}