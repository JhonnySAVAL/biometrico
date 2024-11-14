
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

            


            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Online Store Visitors</h3> <a href="javascript:void(0);" class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">View Report</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="d-flex flex-column"> <span class="fw-bold fs-5">820</span> <span>Visitors Over Time</span> </p>
                            <p class="ms-auto d-flex flex-column text-end"> <span class="text-success"> <i class="bi bi-arrow-up"></i> 12.5%
                                </span> <span class="text-secondary">Since last week</span> </p>
                        </div>
                        <div class="position-relative mb-4">
                            <div id="visitors-chart"></div>
                        </div>
                        <div class="d-flex flex-row justify-content-end"> <span class="me-2"> <i class="bi bi-square-fill text-primary"></i> This Week
                            </span> <span> <i class="bi bi-square-fill text-secondary"></i> Last Week
                            </span> </div>
                    </div>
                </div> 
                <div class="card mb-4">
                    <div class="card-header border-0">
                        <h3 class="card-title">Products</h3>
                        <div class="card-tools"> <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-download"></i> </a> <a href="#" class="btn btn-tool btn-sm"> <i class="bi bi-list"></i> </a> </div>
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
                                <tr>
                                    <td> <img src="../resources/dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                        Some Product
                                    </td>
                                    <td>$13 USD</td>
                                    <td> <small class="text-success me-1"> <i class="bi bi-arrow-up"></i>
                                            12%
                                        </small>
                                        12,000 Sold
                                    </td>
                                    <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                </tr>
                                <tr>
                                    <td> <img src="../resources/dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                        Another Product
                                    </td>
                                    <td>$29 USD</td>
                                    <td> <small class="text-info me-1"> <i class="bi bi-arrow-down"></i>
                                            0.5%
                                        </small>
                                        123,234 Sold
                                    </td>
                                    <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                </tr>
                                <tr>
                                    <td> <img src="../resources/dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                        Amazing Product
                                    </td>
                                    <td>$1,230 USD</td>
                                    <td> <small class="text-danger me-1"> <i class="bi bi-arrow-down"></i>
                                            3%
                                        </small>
                                        198 Sold
                                    </td>
                                    <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                </tr>
                                <tr>
                                    <td> <img src="../resources/dist/assets/img/default-150x150.png" alt="Product 1" class="rounded-circle img-size-32 me-2">
                                        Perfect Item
                                        <span class="badge text-bg-danger">NEW</span>
                                    </td>
                                    <td>$199 USD</td>
                                    <td> <small class="text-success me-1"> <i class="bi bi-arrow-up"></i>
                                            63%
                                        </small>
                                        87 Sold
                                    </td>
                                    <td> <a href="#" class="text-secondary"> <i class="bi bi-search"></i> </a> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>


            
        </div>
    </div>
</div>


<!-- CREATE TABLE `reportes_asistencia` (
  `idReporte` int(11) NOT NULL AUTO_INCREMENT,
  `empleadoId` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `estado` enum('presente', 'ausente', 'falta', 'permiso', 'exonerado', 'tardanza') NOT NULL,
  `horaEntrada` time DEFAULT NULL,
  `horaSalida` time DEFAULT NULL,
  `minutosTardanza` int(11) DEFAULT 0,
  `minutosAnticipados` int(11) DEFAULT 0,
  `tipoRegistro` enum('automatica', 'manual') DEFAULT 'automatica',
  PRIMARY KEY (`idReporte`),
  FOREIGN KEY (`empleadoId`) REFERENCES `empleados`(`idEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4; -->
