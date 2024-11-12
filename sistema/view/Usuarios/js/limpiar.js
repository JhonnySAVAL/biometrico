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
