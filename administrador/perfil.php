<?php
      include '../service/loginService.php';
      
      session_start();
      if(!isset($_SESSION['user'])){
          header('Location: ../login.php');
      }else{

        $loginService = new LoginService();

        $datosUsuario=$loginService->getRol($_SESSION['user']['COD_USUARIO'],$_SESSION['user']['COD_PERSONA']);
        
        if($datosUsuario['COD_ROL']=='ADM'){
            $nombreRol= 'ADMINISTRADOR';
        }elseif($datosUsuario['COD_ROL']=='EST'){
            $nombreRol= 'ESTUDIANTE';
        }elseif($datosUsuario['COD_ROL']=='DOC'){
            $nombreRol= 'DOCENTE';
        }elseif ($datosUsuario['COD_ROL']=='REP') {
            $nombreRol= 'REPRESENTANTE';
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
    <?php include '../partials/head.php';?>

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
                    <a href="perfil.php" class="nav-link">Inicio</a>
                </li>
            </ul>
            <!-- BORRE EL SEARCH AQUI  -->
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Messages Dropdown Menu -->

                <!-- Notifications Dropdown Menu -->

                <!-- Log Out-->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-th-large"></i>
                        <span class="badge badge-warning navbar-badge"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <div class="dropdown-divider"></div>
                        <a href="../service/logout.php" class="dropdown-item dropdown-footer">Cerrar Sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="../public/intranet/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">

                <span class="brand-text font-weight-light"><?php echo $nombreRol?></span> 
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../public/intranet/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $datosUsuario['APELLIDO']; echo " ";echo $datosUsuario['NOMBRE'] ?></a>
                    </div>
                </div>
            <!-- Call Menu Rols -->
            <?php
                if($datosUsuario['COD_ROL']=='ADM'){
                    include '../partials/menuAdm.php';
                }elseif($datosUsuario['COD_ROL']=='EST'){
                    include '../partials/menuEst.php';
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
                            <h1>Página de Bienvenida</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><?php echo $nombreRol?></li>
                                <li class="breadcrumb-item active">INICIO</li>
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

                    </div><!-- /.container-fluid -->

                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- CALL FOOTER -->   
        <?php include '../partials/footer.php';?>

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