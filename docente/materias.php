<?php
//include '../service/loginService.php';
include '../service/docenteService.php';

$docente = new DocenteService();
$i = 1;
$nivel = $docente->findNivel();
$nivel1 = $docente->findNivel();
$periodo = $docente->findPeriodo();
$codDocente = "";
$asignatura = "";
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../login.php');
} else {

    // $loginService = new LoginService();


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
$codDocente = $_SESSION["user"]['COD_PERSONA'];
if(isset($_GET['accion'])  && $_GET["accion"] == 'Buscar'){    
    $asignatura = $docente->findAsignatura($codDocente,$_GET['periodo'],$_GET['nivel']);
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
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-2 col-4">
                                <!-- select -->
                                <div class="form-group" name="periodo">
                                    <label>Periodo</label>
                                    <select class="form-control">
                                        <?php
                                        if ($periodo) {
                                            while ($row = $periodo->fetch_assoc()) { ?>
                                                <option><?php echo $row['COD_PERIODO_LECTIVO']; ?></option>
                                            <?php }
                                        } else { ?>
                                            <option>NA</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3 col-4">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Nivel Educativo</label>
                                    <select class="form-control" name="nivel">
                                        <?php
                                        if ($nivel) {
                                            while ($row = $nivel->fetch_assoc()) { ?>
                                                <option><?php echo $row['NOMBRE']; ?></option>
                                            <?php }
                                        } else { ?>
                                            <option>NA</option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-9">
                                <br>
                                <div class="form-group"><button type="button" class="btn btn-block btn-primary" style="padding-bottom: 10px;">
                                        Listar Asignaturas</button></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <h5 class="mb-2">Asignaturas</h5>
                    <div class="row">
                    <?php
                    if ($nivel1) {
                        while ($row = $nivel1->fetch_assoc()) { ?>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?php echo $row['NOMBRE']; ?></span>
                                    <a href="agregarNotas.php" type="submit"><span class="info-box-number">Agregar Notas</span></a>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <?php }
                        } else { ?>
                           <div class="col-md-3 col-sm-6 col-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">No se encontraron Datos</span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <?php } ?>
                        <!-- /.col -->
                    </div>
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