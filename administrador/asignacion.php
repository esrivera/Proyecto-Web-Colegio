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
        $infoCursos = "";
        
        $periodo=$asignacionService->getPeriodo();
        $nivelAsignatura=$asignacionService->getNivelEducativo();
        $paraleo=$asignacionService->getParalelo();
        $docente=$asignacionService->getDocente();
        $aula=$asignacionService->getAula();
        $infoCursos = "";
        
        if(isset($_POST["codNivelAsignatura"])){
          $asignaturas = $asignacionService->getAsignaturas($_POST["codNivelAsignatura"]);
          $infoCursos = $asignacionService->getAsignaturaCurso($_POST["codPeriodoLectivo"],$_POST["codNivelAsignatura"]);
        }
        if(isset($_POST["accion"]) && $_POST["accion"] == "Agregar" && isset($_POST["codAsigantura"])){
          $asignacionService->insert($_POST["codNivelAsignatura"],$_POST["codAsigantura"],
                                $_POST["codPeriodoLectivo"],$_POST["codParalelo"],$_POST["codPersona"],$_POST["codAula"]);
          $infoCursos = $asignacionService->getAsignaturaCurso($_POST["codPeriodoLectivo"],$_POST["codNivelAsignatura"]);
        }

      }

  
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Gestión de Cursos</title>
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
                    <a href="./perfil.php" class="nav-link">Inicio</a>
                </li>
            </ul>
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
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
                            class="d-block"><?php echo $_SESSION["user"]['APELLIDO']; echo " ";echo $_SESSION["user"]['NOMBRE'] ?></a>
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
            <!-- Main content -->
            <form action="./asignacion.php" method="POST" id="formAsignacion" class="formAsignacion">
                <section class="content">
                    <div class="container-fluid">
                        <div class="container-fluid">
                            <div class="col mb-1">
                                <h1 style="text-align: center;">Generación de Cursos</h1>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Asignacion Cursos</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <h5 class="card-title">Seleccione el periodo</h5> <br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <select class="form-control" id="codPeriodoLectivo" name="codPeriodoLectivo" form="formAsignacion">
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
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-7">
                                                <h5 class="card-title">Seleccione el nivel educativo</h5> <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <select class="form-control" id="codNivelAsignatura"
                                                    name="codNivelAsignatura" form="formAsignacion">
                                                    <?php   if ($nivelAsignatura->num_rows > 0) { 
                                                    while($nivel = $nivelAsignatura->fetch_assoc()) {
                                                        ?><option <?php  
                                                        if(isset($_POST["codNivelAsignatura"])){
                                                            if($_POST["codNivelAsignatura"] == $nivel["COD_NIVEL_EDUCATIVO"]){
                                                            ?> selected <?php
                                                            }
                                                        
                                                        }elseif($codNivelEducativo!="" && $codNivelEducativo== $nivel["COD_NIVEL_EDUCATIVO"]){echo 'selected'; }
                                                        
                                                        ?> value=<?php echo $nivel["COD_NIVEL_EDUCATIVO"]?>>
                                                        <?php             echo $nivel["NOMBRE"]?>

                                                    </option>
                                                    <?php         }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="button" name="Buscar"
                                                    class="btn btn-block btn-primary float-right"
                                                    style="padding-bottom: 4px; width:75px;" value="Buscar"
                                                    onclick="buscarAsignaturas();">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-7">
                                                <h5 class="card-title">Seleccione la asignatura</h5> <br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-8">  
                                                <select class="form-control" id="codAsigantura" name="codAsigantura"  form="formAsignacion">
                                                    <?php
                                                        if($asignaturas!=""){
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
                                                            echo "<option value = 'null'> RELACICE LA BUSQUEDA </option> ";
                                                        }

                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-7">
                                                <h5 class="card-title">Seleccione el Docente</h5> <br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-8">  
                                                <select class="form-control" id="codPersona" name="codPersona"   form="formAsignacion">
                                                    <?php
                                                            if($docente!=""){
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
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-7">
                                                <h5 class="card-title">Seleccione el aula</h5> <br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-8">  
                                                <select class="form-control" id="codAula" name="codAula"
                                                    form="formAsignacion">
                                                    <?php
                                                            if($aula!=""){
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

                                        <div class="row">
                                            <div class="col-sm-7">
                                                <h5 class="card-title">Seleccione el Paralelo</h5> <br>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-8">  
                                                <select class="form-control" id="codParalelo" name="codParalelo"
                                                    form="formAsignacion">
                                                    <?php
                                                            if($paraleo!=""){
                                                            if ($paraleo->num_rows > 0) {
                                                            // output data of each row
                                                            while($datParelelo = $paraleo->fetch_assoc()) {
                                                                

                                                                ?><option value=<?php echo $datParelelo["COD_PARALELO"]?>>
                                                        <?php             echo $datParelelo["NOMBRE"];?>

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
                                        
                                        
                                    </div>

                                    <div class="card-footer">
                                        <input type="submit" class="btn btn-primary btn-block" name="accion"
                                            value="<?php echo $accion;?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-7">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Información Cursos</h3>
                                    </div>
                                    <div class="card-body table-responsive p-0" style="height: 500px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>ASIGNATURA</th>
                                                <th>DOCENTE</th>
                                                <th>AULA</th>
                                                <th>PARALELO</th>
                                                <th>ACCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        if($infoCursos!=""){
                                        if ($infoCursos->num_rows > 0) {
                                        // output data of each row
                                        while($info = $infoCursos->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $info["COD_ASIGNATURA"]?></td>
                                                <td><?php echo $info["COD_DOCENTE"]?></td>
                                                <td><?php echo $info["COD_AULA"]?></td>
                                                <td><?php echo $info["COD_PARALELO"]?></td>
                                                <td><input type="radio" name="" id=""></td>
                                            </tr>
                                            <?php 
                                        }
                                        ?>

                                            <?php 
                                        }else{
                                        ?>
                                            <tr>
                                                <td colspan="5"> No hay datos</td>
                                            </tr>
                                            <?php }}
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section>
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