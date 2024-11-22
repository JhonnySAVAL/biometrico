document.getElementById('limpiar').addEventListener('click', function(e){
    e.preventDefault();
    Swal.fire({
        title: "¿Limpiar los datos?",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('formCrearUsuario').reset();
        }
    });
    
});
// Selecciona el formulario
document.getElementById('formCrearUsuario').addEventListener('submit', function(event) {
    event.preventDefault(); // Evita el envío inmediato del formulario

    Swal.fire({
        title: '¿Estás seguro?',
        text: "¿Quieres crear este nuevo empleado?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, crear!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Envía el formulario al confirmar
            this.submit();
        }
    });
});

// Detectar el parámetro 'success' en la URL
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('success') && urlParams.get('success') === 'true') {
    Swal.fire({
        position: "top-end",
        icon: "success",
        title: "Empleado editado exitosamente",
        showConfirmButton: false,
        timer: 1500
    }).then(() => {
        // Redirige a la misma página sin el parámetro 'success'
        const newUrl = window.location.pathname + window.location.search.split('&')[0];  // Quitar solo 'success'
        window.location.replace(newUrl);  // Redirige sin el parámetro 'success'
    });
}
