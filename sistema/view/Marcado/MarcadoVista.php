<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card mt-5">
                <div class="card-header text-center">
                    <h3>Marcado</h3>
                </div>
                <div class="card-body text-center">
                    <p class="mb-4">Seleccione una opción para marcar su asistencia:</p>
                    <div class="d-flex justify-content-around">
                        <button type="button" class="btn btn-success btn-lg" id="btnEntrada">Marcar Entrada</button>
                        <button type="button" class="btn btn-danger btn-lg" id="btnSalida">Marcar Salida</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('btnEntrada').addEventListener('click', function() {
    // Realizar una solicitud para marcar la entrada
    fetch('/biometrico/sistema/controller/MarcarController/MarcadoVistaController.php?action=marcarEntrada')
        .then(response => response.json())  // Convertir la respuesta en JSON
        .then(data => {
            if (data.success) {
                // Esperamos 5 segundos antes de redirigir
                setTimeout(() => {
                    window.location.href = '/biometrico/sistema/view/Marcado/MarcadoVista.php'; // Redirigir
                }, 5000); // 5 segundos
            } else {
                alert(data.message); // Mostrar el mensaje de error
            }
        })
        .catch(error => {
            alert('Hubo un error al marcar la entrada.');
        });
});

document.getElementById('btnSalida').addEventListener('click', function() {
    // Realizar una solicitud para marcar la salida
    fetch('/biometrico/sistema/controller/MarcarController/MarcadoVistaController.php?action=marcarSalida')
        .then(response => response.json())  // Convertir la respuesta en JSON
        .then(data => {
            if (data.success) {
                alert('Salida marcada correctamente.');
                window.location.href = '/biometrico/sistema/view/Marcado/MarcadoVista.php'; // Redirigir
            } else {
                alert(data.message); // Mostrar el mensaje de error
            }
        })
        .catch(error => {
            alert('Hubo un error al marcar la salida.');
        });
});

</script>