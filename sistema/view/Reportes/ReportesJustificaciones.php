
<div class="col-sm-6">
    <h3 class="mb-0">Dashboard</h3>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Dashboard v3
        </li>
    </ol>
</div>
</div> 
</div> 
</div>
<div class="app-content"> 
    <div class="container-fluid"> 
        <div class="row">
        <div class="container">
    <h2>Reporte Consolidado de Empleados</h2>
    
    <!-- Botón para generar reporte general de todos los empleados -->
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-primary" onclick="generarReporteGeneral()">Generar Reporte General</button>
    </div>

    <!-- Tabla de empleados con opciones de reporte -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Empleado</th>
                <th>Departamento</th>
                <th>Puesto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($empleados as $empleado): ?>
                <tr>
                    <td><?php echo $empleado['nombre']; ?></td>
                    <td><?php echo $empleado['departamento']; ?></td>
                    <td><?php echo $empleado['puesto']; ?></td>
                    <td>
                        <!-- Botón para ver asistencia -->
                        <button class="btn btn-info btn-sm" onclick="verAsistencia(<?php echo $empleado['idEmpleado']; ?>)">Asistencia</button>

                        <!-- Botón para ver permisos -->
                        <button class="btn btn-warning btn-sm" onclick="verPermisos(<?php echo $empleado['idEmpleado']; ?>)">Permisos</button>

                        <!-- Botón para ver tardanzas -->
                        <button class="btn btn-danger btn-sm" onclick="verTardanzas(<?php echo $empleado['idEmpleado']; ?>)">Tardanzas</button>

                        <!-- Botón para ver justificaciones -->
                        <button class="btn btn-secondary btn-sm" onclick="verJustificaciones(<?php echo $empleado['idEmpleado']; ?>)">Justificaciones</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>




            
        </div>
    </div>
</div>