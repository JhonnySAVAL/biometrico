document.getElementById('cerrarSesion').addEventListener('click', function(e) {
    e.preventDefault(); // Prevenir el comportamiento por defecto (redirigir inmediatamente)

    // Mostrar la alerta de confirmación de SweetAlert2
    Swal.fire({
        title: "¿Estás seguro de que deseas cerrar sesión?",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire("Has cerrado sesión", "", "success").then(() => {
                window.location.href = "../../controller/AutenticacionController/logout.php";
            });
        } else {
            Swal.fire("Cancelado", "", "info");
        }
    });
});