document.addEventListener('DOMContentLoaded', function () {
    const formMarcarEntrada = document.querySelector('#formMarcarEntrada');
    if (formMarcarEntrada) {
        formMarcarEntrada.addEventListener('submit', function (e) {
            e.preventDefault();
            const dni = document.querySelector('#dniEntrada').value;
            const horaEntrada = document.querySelector('#horaEntrada').value; 
        
            fetch('/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=marcarEntrada', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ dni: dni, horaEntrada: horaEntrada, tipo: 'manual' })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    title: data.error ? 'Error!' : '¡Éxito!',
                    text: data.message,
                    icon: data.error ? 'error' : 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if (!data.error) {
                            window.location.reload(); // Recarga para mostrar los cambios.
                        }
                    }
                });
            })
            .catch(error => {
                console.error('Error al marcar la entrada:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'No se pudo procesar la solicitud.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
        
    }


    const formMarcarReceso = document.querySelector('#formMarcarReceso');
    if (formMarcarReceso) {
        formMarcarReceso.addEventListener('submit', function (e) {
            e.preventDefault();
            const dni = document.querySelector('#dniReceso').value;
            const horaReceso = document.querySelector('#horaReceso').value;

            fetch('/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=marcarReceso', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ dni: dni, horaReceso: horaReceso })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    title: data.error ? 'Error!' : '¡Éxito!',
                    text: data.message,
                    icon: data.error ? 'error' : 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed && !data.error) {
                        window.location.reload(); // Recargar para mostrar cambios
                    }
                });
            })
            .catch(error => {
                console.error('Error al marcar el receso:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'No se pudo procesar la solicitud.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    }

    const formMarcarFinReceso = document.querySelector('#formMarcarFinReceso');

    if (formMarcarFinReceso) {
        formMarcarFinReceso.addEventListener('submit', function (e) {
            e.preventDefault();
            const dni = document.querySelector('#dniFinReceso').value;
            const horaRecesoFinal = document.querySelector('#horaFinReceso').value;

            fetch('/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=marcarFinalReceso', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ dniRecesoFinal: dni, horaRecesoFinal: horaRecesoFinal })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    title: data.error ? 'Error!' : '¡Éxito!',
                    text: data.message,
                    icon: data.error ? 'error' : 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed && !data.error) {
                        window.location.reload(); // Recargar para mostrar cambios
                    }
                });
            })
            .catch(error => {
                console.error('Error al marcar el fin del receso:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'No se pudo procesar la solicitud.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    }
    const formMarcarSalida = document.querySelector('#formMarcarSalida');

    if (formMarcarSalida) {
        formMarcarSalida.addEventListener('submit', function (e) {
            e.preventDefault();
            const dni = document.querySelector('#dniSalida').value;
            const horaSalida = document.querySelector('#horaSalida').value;

            fetch('/biometrico/sistema/controller/AsistenciasController/AsistenciasController.php?action=marcarSalida', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ dniSalida: dni, horaSalida: horaSalida })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                Swal.fire({
                    title: data.error ? 'Error!' : '¡Éxito!',
                    text: data.message,
                    icon: data.error ? 'error' : 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed && !data.error) {
                        window.location.reload(); // Recargar para mostrar cambios
                    }
                });
            })
            .catch(error => {
                console.error('Error al marcar la salida:', error);
                Swal.fire({
                    title: 'Error!',
                    text: 'No se pudo procesar la solicitud.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        });
    }
});
