<?php
    include '../service/tareaService.php';

    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../login.php');
    }else{
      
        $accion="Crear Tarea";
        $tareas= "";
        $tareaService = new TareaService();
        $aulas="";

        $codigoPeriodo="P12020";
        $docente= $tareaService->getDocente($_SESSION["user"]['APELLIDO']);
        $nivelAsignatura=$tareaService->getNivelEducativo();

        $periodo=$tareaService->getPeriodo($codigoPeriodo);
        //print_r($periodo);
        //print_r($_SESSION["user"]['COD_PERSONA']);
        //echo date('Y');

        if(isset($_POST["codNivelAsignatura"])){
            
            $asignaturas= $tareaService->getAsignaturas($_POST["codNivelAsignatura"],$_SESSION["user"]['COD_PERSONA'],$_POST["codPeriodoLectivo"]);
            $aulas=$tareaService->getAula($_POST["codNivelAsignatura"],$_SESSION["user"]['COD_PERSONA'],$_POST["codPeriodoLectivo"]);
            $paralelos= $tareaService->getParalelo($_POST["codNivelAsignatura"],$_SESSION["user"]['COD_PERSONA'],$_POST["codPeriodoLectivo"]);
            //$tareas = $tareaservice->getAula($_POST["codEdificio"]);
            print_r($paralelos);
        }

        if(isset($_POST["accion"]) && $_POST["accion"] == "Crear Tarea"){
            $tareaService->insert($_POST["codNivelAsignatura"],$_POST["codAsignatura"],
                                  $_POST["codPeriodoLectivo"],$_POST["codParalelo"],$_SESSION["user"]['COD_PERSONA'],$_POST["codigoQuimestre"],$_POST["detalleTarea"]);
            //$infoCursos = $tareaService->getAsignaturaCurso($_POST["codPeriodoLectivo"],$_POST["codNivelAsignatura"]);
          }
          
    }
    
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear Tarea</title>
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
                <span class="brand-text font-weight-light">Docente</span>
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

                <?php include '../partials/menuDoc.php'; ?>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Main content -->
            <form action="./crearTarea.php" method="POST" id="formTarea" class="formTarea">
                <section class="content">
                    <div class="container-fluid">
                        <div class="container-fluid">
                            <div class="col mb-1">
                                <h1 style="text-align: center;">Envio de Tarea</h1>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6 mx-auto">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Crear Tarea </h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="codigoAula">Sleccione el periodo</label>
                                            <select class="form-control" id="codPeriodoLectivo" name="codPeriodoLectivo"
                                                form="formTarea">
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

                                        <div class="form-group">
                                            <label for="codNivelAsignatura">Sleccione el nivel educativo</label>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="codNivelAsignatura"
                                                        name="codNivelAsignatura" form="formTarea">
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

                                                <div class="col-sm-2">
                                                    <input type="button" name="Buscar"
                                                        class="btn btn-block btn-primary float-right"
                                                        style="padding-bottom: 4px; width:75px;" value="Buscar"
                                                        onclick="buscarAsignaturas();">
                                                </div>

                                            </div>

                                        </div>

                                        <div class="for-group">
                                            <label for="codAsignatura">Selecciona la asignatura</label>
                                            <select class="form-control" id="codAsignatura" name="codAsignatura"
                                                form="formTarea">
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
                                                            echo "<option value = 'null'> REALICE LA BUSQUEDA </option> ";
                                                        }

                                                    ?>
                                            </select>
                                        </div>
                                        <div class="for-group">
                                            <label for="codigoAula">Selecciona el Aula</label>
                                            <select class="form-control" id="codigoAula" name="codigoAula"
                                                form="formTarea">
                                                <?php
                                                        if($aulas!=""){
                                                        if ($aulas->num_rows > 0) {
                                                            // output data of each row
                                                        while($aulaDoc = $aulas->fetch_assoc()) {
                                                                ?><option value=<?php echo $aulaDoc["COD_AULA"]?>>
                                                    <?php             echo $aulaDoc["NOMBRE"]?>

                                                </option>
                                                <?php         }
                                                            ?>

                                                <?php 
                                                            }
                                                        }else{
                                                            echo "<option value = 'null'> REALICE LA BUSQUEDA </option> ";
                                                        }

                                                    ?>
                                            </select>
                                        </div>
                                        <div class="for-group">
                                            <label for="codigoParalelo">Selecciona el Paralelo</label>
                                            <select class="form-control" id="codigoParalelo" name="codParalelo"
                                                form="formTarea">
                                                <?php
                                                        if($paralelos!=""){
                                                        if ($paralelos->num_rows > 0) {
                                                            // output data of each row
                                                        while($paraleloDoc = $paralelos->fetch_assoc()) {
                                                                ?><option
                                                    value=<?php echo $paraleloDoc["COD_PARALELO"]?>>
                                                    <?php             echo $paraleloDoc["NOMBRE"]?>

                                                </option>
                                                <?php         }
                                                            ?>

                                                <?php 
                                                            }
                                                        }else{
                                                            echo "<option value = 'null'> REALICE LA BUSQUEDA </option> ";
                                                        }

                                                    ?>
                                            </select>
                                        </div>

                                        <div class="for-group">
                                            <label for="codigoQuimestre">Selecciona el Quimestre</label>
                                            <select class="form-control" id="codigoQuimestre" name="codigoQuimestre"
                                                form="formTarea">
                                                <option value='1'
                                                    <?php if($tipo!="" && $tipo=='1'){echo 'selected'; }?>>
                                                    PRIMERO</option>

                                                <option value='2'
                                                    <?php if($tipo!="" && $tipo=='2'){echo 'selected'; }?>>
                                                    SEGUNDO</option>


                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="detalleTarea">Descripción Tarea</label>
                                            <textarea class="form-control" id="detalleTarea"name="detalleTarea"
                                                rows="3"></textarea>
                                        </div>
                                        


                                    </div>

                                    <div class="card-footer">
                                        <input type="submit" class="btn btn-primary btn-block" name="accion"
                                            value="<?php echo $accion;?>">
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
        document.getElementById("formTarea").submit();
    }
    </script>
</body>

</html>