<?php
      include '../service/asignacionService.php';
      
      session_start();
      if(!isset($_SESSION['user'])){
          header('Location: ../login.php');
      }else{
        $accion="Agregar";
        $asignaturas ="";
        $asignacionService = new AsignacionService();

        $codAsignatura = "";
        $nombre = "";
        $creditos = "";
        $tipo = "";
        $codNivelEducativo = "";

        $codigoPeriodo="P12020";
        
        $periodo=$asignacionService->getPeriodo($codigoPeriodo);
        $nivelAsignatura=$asignacionService->getNivelEducativo();
        $paraleo=$asignacionService->getParalelo();
        $docente=$asignacionService->getDocente();
        $aula=$asignacionService->getAula();
        
        if(isset($_POST["codNivelAsignatura"])){
          $asignaturas = $asignacionService->getAsignaturas($_POST["codNivelAsignatura"]);
          
        }
        if(isset($_POST["accion"]) && $_POST["accion"] == "Agregar" && isset($_POST["codAsigantura"])){
          $asignacionService->insert($_POST["codNivelAsignatura"],$_POST["codAsigantura"],
                                $_POST["codPeriodoLectivo"],$_POST["codParalelo"],$_POST["codPersona"],$_POST["codAula"]);
        
        }

      }

  
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Asignar Docentes</title>
    <!-- CALL HEAD STYLES -->
    <?php include '../partials/head.php';?>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="./docente.html" class="nav-link">Inicio</a>
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
            <a href="./docente.html" class="brand-link">
                <img src="../public/intranet/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Administrador</span>
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
                        <a href="#"
                            class="d-block"><?php echo $datosUsuario['APELLIDO']; echo " ";echo $datosUsuario['NOMBRE'] ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu CALL MENU ADMIN-->

                <?php include '../partials/menuAdm.php'; ?>
                <!-- /.sidebar-menu -->
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
                            <h1>Gestión Asignatura</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <!-- Main content -->
            <form action="./asignacion.php" method="POST" id="formAsignacion" class="formAsignacion">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-6 mx-auto">
                                <div class="card-primary card card-header">
                                    <label for="codPeriodoLectivo" class="card-title">Asignación de docentes</label>
                                </div>
                                <div class="form-group">


                                    
                                </div>


                                


                                    <!-- general form elements -->
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Asignacion Docentes</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <!-- form start -->
                                        <div class="card-body">
                                            <div class="row">
                                                <select class="form-control" id="codPeriodoLectivo"
                                                    name="codPeriodoLectivo" form="formAsignacion">
                                                    <?php   if ($periodo->num_rows > 0) { 
                                                while($nivel = $periodo->fetch_assoc()) {
                                                      ?><option <?php  
                                                      
                                                    
                                                    ?> value=<?php echo $nivel["COD_PERIODO_LECTIVO"]?>>
                                                        <?php             echo $nivel["COD_PERIODO_LECTIVO"]?>

                                                    </option>
                                                    <?php         }
                                                 }
                                                ?>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <select class="form-control" id="codNivelAsignatura" name="codNivelAsignatura" form="formAsignacion">
                                                    <?php   if ($nivelAsignatura->num_rows > 0) { 
                                                     while($nivel = $nivelAsignatura->fetch_assoc()) {
                                                      ?><option <?php  
                                                      if(isset($_POST["codNivelAsignatura"])){
                                                        if($_POST["codNivelAsignatura"] == $nivel["COD_NIVEL_EDUCATIVO"]){
                                                          ?> selected <?php
                                                        }
                                                      
                                                      }
                                                    
                                                        ?> value=<?php echo $nivel["COD_NIVEL_EDUCATIVO"]?>>
                                                    <?php             echo $nivel["NOMBRE"]?>

                                                    </option>
                                                        <?php         }
                                                     }
                                                    ?>
                                                </select>
                                                <div class="">
                                                <input type="button" name="Buscar"
                                                class="btn btn-block btn-primary float-right"
                                                style="padding-bottom: 4px; width:75px;" value="Buscar"
                                                onclick="buscarAsignaturas();">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <select class="form-control" id="codAsigantura" name="codAsigantura" form="formAsignacion">
                                                    <?php
                                                        if($asignaturas!=""){
                                                            echo 'eeeeeeeeeeeoooooooooas';
                                                        if ($asignaturas->num_rows > 0) {
                                                        // output data of each row
                                                        while($nivel = $asignaturas->fetch_assoc()) {
                                                            ?><option value=<?php echo $nivel["COD_ASIGNATURA"]?>>
                                                        <?php             echo $nivel["NOMBRE"]?>

                                                    </option>
                                                    <?php         }
                                                        ?>

                                                    <?php 
                                                        }
                                                    }else{
                                                        echo 'ola';
                                                    }

                                                ?>
                                                </select>
                                            </div>

                                            <div class="row">
                                                <select class="form-control" id="codParalelo" name="codParalelo" form="formAsignacion">
                                                    <?php
                                                        if($paraleo!=""){
                                                            echo 'eeeeeeeeeeeoooooooooas';
                                                        if ($paraleo->num_rows > 0) {
                                                        // output data of each row
                                                        while($datParalelo = $paraleo->fetch_assoc()) {
                                                            ?><option value=<?php echo $datParalelo["COD_PARALELO"]?>>
                                                        <?php             echo $datParalelo["NOMBRE"]?>

                                                    </option>
                                                    <?php         }
                                                        ?>

                                                    <?php 
                                                        }
                                                    }else{
                                                        echo 'ola';
                                                    }

                                                ?>
                                                </select>
                                            </div>


                                            <div class="row">
                                                <select class="form-control" id="codPersona" name="codPersona" form="formAsignacion">
                                                    <?php
                                                        if($docente!=""){
                                                            echo 'eeeeeeeeeeeoooooooooas';
                                                        if ($docente->num_rows > 0) {
                                                        // output data of each row
                                                        while($datPersona = $docente->fetch_assoc()) {
                                                            

                                                            ?><option value=<?php echo $datPersona["COD_PERSONA"]?>>
                                                        <?php             echo $datPersona["NOMBRE"]; echo " "; echo $datPersona["APELLIDO"];?>

                                                    </option>
                                                    <?php         }
                                                        ?>

                                                    <?php 
                                                        }
                                                    }else{
                                                        echo 'ola';
                                                    }

                                                ?>
                                                </select>
                                            </div>
                                            <div class="row">
                                                <select class="form-control" id="codAula" name="codAula" form="formAsignacion">
                                                    <?php
                                                        if($aula!=""){
                                                            echo 'eeeeeeeeeeeoooooooooas';
                                                        if ($aula->num_rows > 0) {
                                                        // output data of each row
                                                        while($datAulas = $aula->fetch_assoc()) {
                                                            

                                                            ?><option value=<?php echo $datAulas["COD_AULA"]?>>
                                                        <?php             echo $datAulas["NOMBRE"];?>

                                                    </option>
                                                    <?php         }
                                                        ?>

                                                    <?php 
                                                        }
                                                    }else{
                                                        echo 'ola';
                                                    }

                                                ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <input type="submit" class="btn btn-primary btn-block" name="accion"
                                                value="<?php echo $accion;?>">
                                        </div>

                                    </div>
                                    <!-- /.card -->
                            </div>
                        </div>
                    </div>

                </section>
            </form>
            <!-- /.content -->
        </div>

        <?php include '../partials/footer.php'; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Page specific script -->
    <script>
    function buscarAsignaturas() {
        document.getElementById("formAsignacion").submit();
    }
    </script>
</body>

</html>