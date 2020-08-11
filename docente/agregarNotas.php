<?php
include '../service/loginService.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
} else {

    $loginService = new LoginService();


    if ($_SESSION["user"]['COD_ROL'] == 'ADM') {
        $nombreRol = 'ADMINISTRADOR';
    } elseif ($_SESSION["user"]['COD_ROL'] == 'EST') {
        $nombreRol = 'ESTUDIANTE';
    } elseif ($_SESSION["user"]['COD_ROL'] == 'DOC') {
        $nombreRol = 'DOCENTE';
    } elseif ($_SESSION["user"]['COD_ROL'] == 'REP') {
        $nombreRol = 'REPRESENTANTE';
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>COLEGIO VPR | Perfil</title>

    <!-- CALL HEAD STYLES -->
    <?php include '../partials/head.php'; ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../administrador/perfil.php" class="nav-link">Inicio</a>
                </li>
            </ul>
            <!-- BORRE EL SEARCH AQUI  -->
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <!-- Log Out-->
                <li class="nav-item dropdown">
                    <a href="../service/logout.php" class="dropdown-item dropdown-footer">
                        Cerrar Sesión
                        <span class="badge badge-warning navbar-badge"></span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../public/intranet/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">

                <span class="brand-text font-weight-light"><?php echo $nombreRol ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../public/intranet/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION["user"]['APELLIDO'];
                                                    echo " ";
                                                    echo $_SESSION["user"]['NOMBRE'] ?></a>
                    </div>
                </div>
                <!-- Call Menu Rols -->
                <?php
                if ($_SESSION["user"]['COD_ROL'] == 'ADM') {
                    include '../partials/menuAdm.php';
                } elseif ($_SESSION["user"]['COD_ROL'] == 'EST') {
                    include '../partials/menuEst.php';
                } elseif ($_SESSION["user"]['COD_ROL'] == 'DOC') {
                    include '../partials/menuDoc.php';
                } elseif ($_SESSION["user"]['COD_ROL'] == 'REP') {
                    include '../partials/menuRep.php';
                }

                ?>

                <!-- End Call Menu Rols -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Ingreso de calificaciones</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">Lengua y Literatura</li>
                                <li class="breadcrumb-item active">Ingreso Calificaciones</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- /.col-md-6 -->
                    <div class="container">

                        <div class="row">
                            <div class="col-lg-2 col-4">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Periodo</label>
                                    <select class="form-control">
                                        <option>Periodo 1</option>
                                        <option>Periodo 2</option>
                                        <option>Periodo 3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-4">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Quimestre</label>
                                    <select class="form-control">
                                        <option>Primer</option>
                                        <option>Segundo</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-4">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Curso</label>
                                    <select class="form-control">
                                        <option>Tercero A</option>
                                        <option>Tercero B</option>
                                        <option>Tercero C</option>
                                        <option>Tercero D</option>
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-2 col-4">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <select class="form-control">
                                        <option>Tarea</option>
                                        <option>Taller</option>
                                        <option>Prueba</option>
                                        <option>Examen</option>
                                        <option>Supletorio</option>
                                        <option>Remedial</option>
                                        <option>Gracia</option>
                                    </select>

                                </div>

                            </div>

                            <div class="col-lg-2 col-9">
                                <br>
                                <div class="form-group"><button type="button" class="btn btn-block btn-primary" style="padding-bottom: 10px;">
                                        Listar Alumnos</button></div>
                            </div>
                            <div class="col-lg-2 col-9">
                                <br>
                                <div class="form-group"><button type="button" class="btn btn-block btn-primary" style="padding-bottom: 10px;">
                                        Guardar</button></div>
                            </div>
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Ingreso de calificaciones</h3>

                                        <div class="card-tools">
                                            <div class="input-group input-group-sm" style="width: 150px;">
                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 300px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nombre</th>
                                                    <th>Calificacion</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>ID001</td>
                                                    <td>John Doe</td>
                                                    <td>
                                                        <input class="form-control" type="number" max="10" min="0" style="width: 125px;">
                                                    </td>

                                                </tr>
                                                <tr>
                                                    <td>ID002</td>
                                                    <td>Alexander Pierce</td>
                                                    <td>
                                                        <input class="form-control" type="number" max="10" min="0" style="width: 125px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>ID003</td>
                                                    <td>Bob Doe</td>
                                                    <td>
                                                        <input class="form-control" type="number" max="10" min="0" style="width: 125px;">
                                                    </td>
                                                <tr>
                                                    <td>ID004</td>
                                                    <td>Bob Doe</td>
                                                    <td>
                                                        <input class="form-control" type="number" max="10" min="0" style="width: 125px;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>ID005</td>
                                                    <td>Bob Doe</td>
                                                    <td>
                                                        <input class="form-control" type="number" max="10" min="0" style="width: 125px;">
                                                    </td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <!-- /.row -->

                    </div><!-- /.container-fluid -->

                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content-wrapper -->

        <!-- CALL FOOTER -->
        <?php include '../partials/footer.php'; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->



    <!-- Page specific script -->
</body>

</html>