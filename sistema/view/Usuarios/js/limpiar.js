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
