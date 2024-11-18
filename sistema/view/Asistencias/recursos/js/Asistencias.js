document.addEventListener('DOMContentLoaded', function () {
    const btnTodosEmpleados = document.getElementById('btnTodosEmpleados');
    const btnEmpleadosConEntrada = document.getElementById('btnEmpleadosConEntrada');
    const btnEmpleadosAusentes = document.getElementById('btnEmpleadosAusentes');
    const btnEmpleadosConFalta = document.getElementById('btnEmpleadosConFalta');

    const empleadosGenerales = document.getElementById('empleadosGenerales');
    const empleadosEntrada = document.getElementById('empleadosEntrada');
    const empleadosAusentes = document.getElementById('empleadosAusentes');
    const empleadosConFalta = document.getElementById('empleadosConFalta');

    btnTodosEmpleados.addEventListener('click', function () {
        mostrarLista(empleadosGenerales);
    });

    btnEmpleadosConEntrada.addEventListener('click', function () {
        mostrarLista(empleadosEntrada);
    });

    btnEmpleadosAusentes.addEventListener('click', function () {
        mostrarLista(empleadosAusentes);
    });

    btnEmpleadosConFalta.addEventListener('click', function () {
        mostrarLista(empleadosConFalta);
    });

    function mostrarLista(listaAmostrar) {
        empleadosGenerales.style.display = 'none';
        empleadosEntrada.style.display = 'none';
        empleadosAusentes.style.display = 'none';
        empleadosConFalta.style.display = 'none';
        listaAmostrar.style.display = 'block';
    }

    mostrarLista(empleadosGenerales);
});

function marcarEntrada(empleadoId) {
    const formData = new FormData();
    formData.append('empleadoId', empleadoId);
    formData.append('action', 'marcarEntrada');  // Acción para el backend

    fetch('/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=marcarEntrada', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Convertimos la respuesta a formato JSON
    .then(data => {
        if (data.success) {
            alert(data.message);  // Mensaje de éxito
            if (data.redirect) {
                window.location.href = data.redirect;  // Redirección a la URL proporcionada en la respuesta
            }
        } else {
            alert('Error: ' + data.message);  // Si no fue exitoso, mostramos el mensaje de error
        }
    })
    .catch(error => {
        console.error('Error:', error);  // Si ocurre un error en la solicitud
        alert('Hubo un error al procesar la solicitud.');
    });
}

function marcarReceso(empleadoId) {
    const formData = new FormData();
    formData.append('empleadoId', empleadoId);  // Empleado
    formData.append('action', 'marcarReceso');  // Acción

    fetch('/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=marcarReceso', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  // Convertimos la respuesta a formato JSON
    .then(data => {
        if (data.success) {
            alert(data.message);  // Mensaje de éxito
            if (data.redirect) {
                window.location.href = data.redirect;  // Redirección
            }
        } else {
            alert('Error: ' + data.message);  // Mensaje de error
        }
    })
    .catch(error => {
        console.error('Error:', error);  // Error
        alert('Hubo un error al procesar la solicitud.');
    });
}
function marcarSalida(empleadoId) {
    // Crear un objeto FormData para enviar los datos
    const formData = new FormData();
    formData.append('empleadoId', empleadoId);  // Asegúrate de pasar el id del empleado
    formData.append('action', 'marcarSalida');  // Acción que se debe ejecutar en el backend

    // Realizar la solicitud POST con fetch
    fetch('/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=marcarSalida', {
        method: 'POST',   // El método de la solicitud
        body: formData    // Los datos que se enviarán al servidor
    })
    .then(response => {
        // Verifica si la respuesta es exitosa
        return response.json();  // Convertimos la respuesta a formato JSON
    })
    .then(data => {
        if (data.success) {
            // Si la respuesta es exitosa, mostramos el mensaje
            alert(data.message);  // Muestra un mensaje de éxito

            // Si hay una URL de redirección, la redirigimos
            if (data.redirect) {
                window.location.href = data.redirect;  // Redirige a la URL que devuelve el servidor
            }
        } else {
            // Si la respuesta es negativa, mostramos el mensaje de error
            alert('Error: ' + data.message);  // Muestra un mensaje de error
        }
    })
    .catch(error => {
        // Si hubo un error en la solicitud, mostramos el error
        console.error('Error:', error);  // Muestra el error en la consola
        alert('Hubo un error al procesar la solicitud.');
    });
}




