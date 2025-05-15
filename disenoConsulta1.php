<?php
    require_once 'sistema/BLL/consulta.php';
    $listaConsulta = obtenerConsulta(3);
    //$data = getConsulta();
    //print_r($datos);
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SB Admin 2 - Filtro de Reporte</title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .button-container {
            display: flex;
            justify-content: space-between;
        }
        .button-container button {
            margin-right: 10px;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">

        <?php
            require_once 'menu.php';
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Consultar por:</h1>
                    <p class="mb-4">Selecciona los datos más importantes para generar tu reporte.</p>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Reporte</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="form-container">
                                    <h1>Filtro de reporte</h1>
                                    <form id="formulario-reporte" action="diseñoListaMostrar.php" method="POST">
                                        <div class="form-group row">
                                            <label for="producto" class="col-sm-2 col-form-label">Producto:</label>
                                            <div class="col-sm-10">
                                                <select id="producto" name="producto" class="form-control" required>
                                                    <option value="Disponible">Disponible</option>
                                                    <option value="Inutilizable">Inutilizable</option>
                                                    <option value="Mantención">Mantención</option>
                                                    <option value="No Disponible">No Disponible</option>
                                                    <option value="Prestamo">Préstamo</option>
                                                    <option value="Todos">Todos</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="tipo_herramienta" class="col-sm-2 col-form-label">Tipo de herramienta:</label>
                                            <div class="col-sm-10">
                                                <select id="tipher" name="tipo_herramienta" class="form-control" required>
                                                    <option value="tipo_herramienta">Tipo de herramienta</option>
                                                    <option value="man">Herramientas Manuales</option>
                                                    <option value="ina">Herramientas Inalámbricas</option>
                                                    <option value="ele">Herramientas Eléctricas</option>
                                                    <option value="hid">Herramientas hidráulicas</option>
                                                    <option value="otr">Otras Herramientas</option>
                                                    <option value="Todas">Todas las Herramientas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="doc" class="col-sm-2 col-form-label">Tipo de Reporte:</label>
                                            <div class="col-sm-10">
                                                <select id="doc" name="tipo_reporte" class="form-control" required>
                                                    <option value="tiprep">Tipo de Reporte</option>
                                                    <option value="Excel">Excel .xlsx (no es parte del servicio)</option>
                                                    <option value="Word">Word .docx (no es parte del servicio)</option>
                                                    <option value="PDF">PDF .pdf</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="fecha_desde" class="col-sm-2 col-form-label">Desde:</label>
                                            <div class="col-sm-10">
                                                <input type="date" id="fecha_desde" name="fecha_desde" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="fecha_hasta" class="col-sm-2 col-form-label">Hasta:</label>
                                            <div class="col-sm-10">
                                                <input type="date" id="fecha_hasta" name="fecha_hasta" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="button-container">
                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                            <button type="button" id="limpiar" class="btn btn-secondary" onclick="limpiarDatos()">Limpiar Datos</button>
                                        </div>

                                        <div class='row'>
                                            <div class='col-sm-12 mt-5'>
 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Tipo Herr.</th>
                                            <th>Desde</th>
                                            <th>Hasta</th>
                                            <th>Fecha Movimiento</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            // en este punto se muestran los datos del inventario
                                            // invocando a la listaInventario decodificando la respuesta json 
                                            //es posible recorrer la lista de objetos y mostrar los datos
                                            foreach(json_decode($listaConsulta) as $datos){
                                                $htmlFilaTabla= "
                                                    <tr>                                                        
                                                        <td>".$datos->nombre_herramienta."</td>
                                                        <td>".$datos->tipo_herramienta."</td>
                                                        <td></td>
                                                        <td>".""."</td>
                                                        <td >".$datos->fecha_movimiento."</td>
                                                    </tr>
                                                ";
                                                echo $htmlFilaTabla;
                                            }
                                        ?>

                                    </tbody>
                                </table>
                                            </div>
                                        </div>

                                    </form>
                                    <div id="resultados">
                                        <!-- Aquí se mostrarán los resultados -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
        document.getElementById('fecha_desde').addEventListener('change', cargarProductos);
        document.getElementById('fecha_hasta').addEventListener('change', cargarProductos);

        function cargarProductos() {
            const fecha_desde = document.getElementById('fecha_desde').value;
            const fecha_hasta = document.getElementById('fecha_hasta').value;

            if (fecha_desde && fecha_hasta) {
                fetch(`cargarProductos.php?fecha_desde=${fecha_desde}&fecha_hasta=${fecha_hasta}&fecha_movimiento=${fecha_movimiento}`)
                    .then(response => response.json())
                    .then(data => {
                        const selectProducto = document.getElementById('producto');
                        selectProducto.innerHTML = ''; // Limpiar opciones anteriores
                        data.forEach(producto => {
                            const option = document.createElement('option');
                            option.value = producto.inventario_corr;
                            option.text = producto.descripcion;
                            selectProducto.add(option);
                        });
                    })
                    .catch(error => console.error('Error al cargar los productos:', error));
            }
        }

        function limpiarDatos() {
            document.getElementById("formulario-reporte").reset(); // Resetea solo ese formulario
            document.getElementById("resultados").innerHTML = "";  // Limpia los resultados mostrados
        }
    </script>
</body>

</html>