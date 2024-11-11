<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Registrar Empleado</title>
    <!-- Vinculando Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container-fluid"> <!-- begin::Container -->
        <!-- Row con título y breadcrumb -->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">Registrar Empleado</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard v3</li>
                </ol>
            </div>
        </div> <!-- end::Row -->

        <div class="row"> <!-- begin::Row -->
            <!-- Columna de formulario para registrar empleados -->
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h3 class="card-title">Registrar Empleado</h3>
                    </div>
                    <div class="card-body">
                        <form action="registrar_empleado.php" method="POST">
                            <div class="mb-3">
                                <label for="id" class="form-label">ID</label>
                                <input type="text" class="form-control" id="id" name="id" required>
                            </div>

                            <div class="mb-3">
                                <label for="nombres" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" maxlength="50" required>
                            </div>

                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" maxlength="50" required>
                            </div>

                            <div class="mb-3">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" maxlength="8" required>
                            </div>

                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="9" required>
                            </div>

                            <div class="mb-3">
                                <label for="ubigeo" class="form-label">Ubigeo</label>
                                <input type="text" class="form-control" id="ubigeo" name="ubigeo" maxlength="6" required>
                            </div>

                            <div class="mb-3">
                                <label for="puesto" class="form-label">Puesto</label>
                                <select class="form-select" id="puesto" name="puesto" required>
                                    <option value="">Seleccionar Puesto</option>
                                    <option value="1">Administrador</option>
                                    <option value="2">Contador</option>
                                    <option value="3">Ingeniero</option>
                                    <option value="4">Vendedor</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="turno" class="form-label">Turno</label>
                                <select class="form-select" id="turno" name="turno" required>
                                    <option value="">Seleccionar Turno</option>
                                    <option value="1">Mañana</option>
                                    <option value="2">Tarde</option>
                                    <option value="3">Noche</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Registrar Empleado</button>
                        </form>
                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.col-lg-6 -->

            <!-- Puedes agregar más columnas aquí según lo necesites -->

            <div class="col-lg-6">
                <!-- Card de "Online Store Visitors" -->
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Online Store Visitors</h3>
                            <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column">
                                <span class="fw-bold fs-5">820</span>
                                <span>Visitors Over Time</span>
                            </p>
                            <p class="ms-auto d-flex flex-column text-end">
                                <span class="text-success">
                                    <i class="bi bi-arrow-up"></i> 12.5%
                                </span>
                                <span class="text-secondary">Since last week</span>
                            </p>
                        </div>
                        <div class="position-relative mb-4">
                            <div id="visitors-chart"></div> <!-- Aquí iría el gráfico -->
                        </div>
                        <div class="d-flex flex-row justify-content-end">
                            <span class="me-2">
                                <i class="bi bi-square-fill text-primary"></i> This Week
                            </span>
                            <span>
                                <i class="bi bi-square-fill text-secondary"></i> Last Week
                            </span>
                        </div>
                    </div>
                </div> <!-- /.card -->

                <!-- Card de Productos -->
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h3 class="card-title">Products</h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="bi bi-download"></i>
                            </a>
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="bi bi-list"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Sales</th>
                                    <th>More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Fila de productos -->
                                <tr>
                                    <td>
                                        <img src="../resources/dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                        Some Product
                                    </td>
                                    <td>$13 USD</td>
                                    <td>
                                        <small class="text-success me-1">
                                            <i class="bi bi-arrow-up"></i> 12%
                                        </small>
                                        12,000 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-secondary">
                                            <i class="bi bi-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="../resources/dist/assets/img/default-150x150.png" alt="Product 2" class="rounded-circle img-size-32 me-2">
                                        Another Product
                                    </td>
                                    <td>$29 USD</td>
                                    <td>
                                        <small class="text-info me-1">
                                            <i class="bi bi-arrow-down"></i> 0.5%
                                        </small>
                                        123,234 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-secondary">
                                            <i class="bi bi-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="../resources/dist/assets/img/default-150x150.png" alt="Product 3" class="rounded-circle img-size-32 me-2">
                                        Amazing Product
                                    </td>
                                    <td>$1,230 USD</td>
                                    <td>
                                        <small class="text-danger me-1">
                                            <i class="bi bi-arrow-down"></i> 3%
                                        </small>
                                        198 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-secondary">
                                            <i class="bi bi-search"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="../resources/dist/assets/img/default-150x150.png" alt="Product 4" class="rounded-circle img-size-32 me-2">
                                        Perfect Item
                                        <span class="badge text-bg-danger">NEW</span>
                                    </td>
                                    <td>$199 USD</td>
                                    <td>
                                        <small class="text-success me-1">
                                            <i class="bi bi-arrow-up"></i> 63%
                                        </small>
                                        87 Sold
                                    </td>
                                    <td>
                                        <a href="#" class="text-secondary">
                                            <i class="bi bi-search"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> <!-- /.card -->
            </div> <!-- /.col-lg-6 -->
        </div> <!-- end::Row -->
    </div> <!-- end::Container -->

    <!-- Vinculando Scripts de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>