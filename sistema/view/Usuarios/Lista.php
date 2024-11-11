<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista - Empleados</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .btn-floating {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 9999;
            font-size: 18px;
        }
    </style>
</head>

<body>

    <!-- Contenedor principal -->
    <div class="app-content"> <!--begin::Container-->
        <div class="container-fluid"> <!--begin::Row-->
            <div class="row">

                <!-- Cabecera del Dashboard -->
                <div class="col-sm-6">
                    <h3 class="mb-0">Lista Empleados</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Empleados</li>
                    </ol>
                </div>
            </div> <!--end::Row-->

            <div class="row mt-4"> <!--begin::Row-->
                <div class="col-lg-12">
                    <!-- Card de Empleados -->
                    <div class="card mb-4">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Lista de Empleados</h3>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-primary btn-floating">
                                <i class="bi bi-person-plus"></i> Registrar Usuario
                            </a>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>DNI</th>
                                        <th>Correo</th>
                                        <th>Teléfono</th>
                                        <th>Ubigeo</th>
                                        <th>Puesto</th>
                                        <th>Turno</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($empleados)): ?>
                                        <?php foreach ($empleados as $empleado): ?>
                                            <tr>
                                                <td><?php echo $empleado['idEmpleado']; ?></td>
                                                <td><?php echo $empleado['nombres']; ?></td>
                                                <td><?php echo $empleado['apellidos']; ?></td>
                                                <td><?php echo $empleado['dni']; ?></td>
                                                <td><?php echo $empleado['correo']; ?></td>
                                                <td><?php echo $empleado['telefono']; ?></td>
                                                <td><?php echo $empleado['idUbigeo']; ?></td>
                                                <td><?php echo $empleado['idPuesto']; ?></td>
                                                <td><?php echo $empleado['idTurno']; ?></td>
                                                <td>
                                                    <span class="badge bg-<?php echo $empleado['estado'] == 'activo' ? 'success' : 'danger'; ?>">
                                                        <?php echo ucfirst($empleado['estado']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-pencil"></i> Editar
                                                    </a>
                                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i> Eliminar
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="11" class="text-center">No hay empleados registrados.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- /.card -->
                </div> <!-- /.col-lg-12 -->
            </div> <!-- end::Row -->
        </div> <!-- end::Container -->
    </div> <!-- end::app-content -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>