<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Registrar Admin</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="/biometrico/sistema/controller/DashboardController/DashboardController.php?action=MostrarDashboard">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Dashboard v3</li>
            </ol>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-6"> <!-- El formulario ahora ocupará el 80% del ancho -->
            <div class="card mb-6 align-items-center">
                <div class="card-body col-md-10">
                    <!-- Mostrar errores si existen -->
                    <?php if (!empty($errores)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errores as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form id="formCrearAdmin" action="../../controller/AdminController/AdminController.php?action=CrearAdmin" method="POST">
                        
                        <div class="row mb-4">
                            <!-- Aumenté el ancho de los campos -->
                            <div class="form-group col-md-6">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" maxlength="50" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" title="Solo se permiten letras y espacios." required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="50" pattern="^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$" title="Solo se permiten letras y espacios." required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="form-group col-md-6">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" pattern="^\d{8}$" maxlength="8" title="Ingrese un DNI válido (8 dígitos numéricos)." required>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="submit" class="btn btn-primary" id="regsitraremp">Registrar Admin</button>
                            <a href="javascript:history.back()" class="btn btn-secondary">Volver</a>
                        </div>
                    </form>
                </div>

                <div class="card-footer text-center">
                    <button class="btn btn-warning" id="limpiar">Limpiar</button>
                </div>
            </div> <!-- /.card -->
        </div> <!-- /.col-lg-8 -->
    </div> <!-- end::Row -->
</div> <!-- end::Container -->


<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 10px;
        text-align: center;
        border: 1px solid #ddd;
    }
    th {
        background-color: #f4f4f4;
    }
    td {
        height: 50px;
    }

    .btn-fecha {
        width: 100%;
        padding: 10px;
        background-color: #f8f9fa;
        border: none;
        cursor: pointer;
    }
    .btn-fecha:hover {
        background-color: #e2e6ea;
    }
    .seleccionable {
        cursor: pointer;
        border: none;
        background-color: #f8f9fa;
        transition: background-color 0.2s;
    }
    .seleccionable:hover {
        background-color: #e2e6ea;
    }

</style>

<?php
// Configurar el idioma a español
setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'es');

function generarCalendario($mes, $año) {
    $diasSemana = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
    $primerDiaMes = mktime(0, 0, 0, $mes, 1, $año);
    $diasEnMes = date('t', $primerDiaMes);
    $diaSemanaInicio = date('N', $primerDiaMes);
    $nombreMes = strftime('%B', $primerDiaMes);

    echo "<table border='1' style='width:100%; text-align:center;'>";
    echo "<tr><th colspan='7' style='background-color: #f4f4f4;'>" . ucfirst($nombreMes) . " $año</th></tr>";
    echo "<tr>";
    foreach ($diasSemana as $dia) {
        echo "<th style='background-color: #f0f0f0;'>$dia</th>";
    }
    echo "</tr><tr>";

    // Espacios vacíos antes del inicio del mes
    for ($i = 1; $i < $diaSemanaInicio; $i++) {
        echo "<td></td>";
    }

    // Generar días del mes
    for ($dia = 1; $dia <= $diasEnMes; $dia++) {
        $fechaCompleta = $año . '-' . str_pad($mes, 2, '0', STR_PAD_LEFT) . '-' . str_pad($dia, 2, '0', STR_PAD_LEFT);
        echo "<td><button class='seleccionable' data-fecha='$fechaCompleta' style='width:100%; padding:10px;'>$dia</button></td>";

        if (($dia + $diaSemanaInicio - 1) % 7 == 0) {
            echo "</tr><tr>";
        }
    }

    // Espacios vacíos al final del mes
    $espaciosRestantes = (7 - (($diasEnMes + $diaSemanaInicio - 1) % 7)) % 7;
    for ($i = 0; $i < $espaciosRestantes; $i++) {
        echo "<td></td>";
    }

    echo "</tr>";
    echo "</table>";
}

// Llamar a la función
$mes = date('m'); // Mes actual
$año = date('Y'); // Año actual
generarCalendario($mes, $año);
?>

<div class="modal fade" id="modalFechas" tabindex="-1" aria-labelledby="modalFechasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFechasLabel">Fechas seleccionadas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <ul id="listaFechas"></ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let seleccionando = false;
    const botones = document.querySelectorAll('.seleccionable');
    const listaFechas = document.getElementById('listaFechas');
    const modal = new bootstrap.Modal(document.getElementById('modalFechas'));
    const fechasSeleccionadas = new Set();

    botones.forEach(boton => {
        // Iniciar selección al presionar el mouse
        boton.addEventListener('mousedown', function () {
            seleccionando = true;
            agregarFecha(boton);
        });

        // Continuar seleccionando al pasar por encima
        boton.addEventListener('mouseover', function () {
            if (seleccionando) {
                agregarFecha(boton);
            }
        });
    });

    // Finalizar selección al soltar el mouse
    document.addEventListener('mouseup', function () {
        if (seleccionando) {
            seleccionando = false;
            mostrarModal();
        }
    });

    function agregarFecha(boton) {
        const fecha = boton.getAttribute('data-fecha');
        if (!fechasSeleccionadas.has(fecha)) {
            fechasSeleccionadas.add(fecha);
            boton.style.backgroundColor = '#d1e7dd'; // Cambia el color al seleccionarlo
        }
    }

    function mostrarModal() {
        // Limpiar lista del modal
        listaFechas.innerHTML = '';
        // Agregar fechas seleccionadas al modal
        fechasSeleccionadas.forEach(fecha => {
            const li = document.createElement('li');
            li.textContent = fecha;
            listaFechas.appendChild(li);
        });
        modal.show(); // Mostrar el modal
    }
});
</script>
