<?php
      include '../service/alumnoService.php';
      
      session_start();
      if(!isset($_SESSION['user'])){
          header('Location: ../login.php');
      }else{
        $alumnoService = new AlumnoService();
        $periodos="";
        $periodos=$alumnoService->getPeriodos();
        $calificaciones="";
        $codAsignatura="";
        $asignaturas="";
        $calificacionesQ1 = "";
        $calificacionesQ2 = "";
        $periodo = "";

            if(isset($_POST["accion"]) && $_POST["accion"] == "Buscar"){
                $calificaciones =$alumnoService->getAsignaturasCalificaciones($_POST['periodo'],$_SESSION["user"]['COD_PERSONA']);
            }elseif(isset($_POST["ver"])){
                $codAsignatura = $_POST["ver"];
                $periodo = $_POST['periodo'];
                $asignaturas = $alumnoService->getAsignaturas($_POST['periodo'],$_SESSION["user"]['COD_PERSONA']);                
                $calificacionesQ1 = $alumnoService->getCalificaciones($_POST['periodo'],$_SESSION["user"]['COD_PERSONA'],$_POST["ver"],1);
                $calificacionesQ2 = $alumnoService->getCalificaciones($_POST['periodo'],$_SESSION["user"]['COD_PERSONA'],$_POST["ver"],2);
            }elseif(isset($_POST["materia"])){
                $periodo =$_POST["periodo"];
                $codAsignatura = $_POST["materia"];
                $asignaturas = $alumnoService->getAsignaturas($_POST['periodo'],$_SESSION["user"]['COD_PERSONA']);
                $calificacionesQ1 = $alumnoService->getCalificaciones($_POST['periodo'],$_SESSION["user"]['COD_PERSONA'],$_POST["materia"],1);
                $calificacionesQ2 = $alumnoService->getCalificaciones($_POST['periodo'],$_SESSION["user"]['COD_PERSONA'],$_POST["materia"],2); 
            }
                              
      }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Calificaciones</title>
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
                    <a href="#" class="nav-link">Inicio</a>
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
                <span class="brand-text font-weight-light">Estudiante</span>
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

                <?php include '../partials/menuEst.php'; ?>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->

        <div class="content-wrapper">
            <!-- Main content -->
            <form action="./calificaciones.php" method="POST" id="formCalificaciones" class="formCalificaciones">
                <input type="hidden" name="periodo" value="<?php echo $periodo?>">
                <section class="content">
                    <div class="container-fluid">
                        <!-- /.col-md-6 -->
                        <?php 
                        if($codAsignatura==""){ ?>
                        <div class="container">
                            <div class="container-fluid">
                                <div class="col mb-1">
                                    <br>
                                    <h1 style="text-align: center;">Calificaciones</h1>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Periodo</label>
                                        <select class="form-control" form="formCalificaciones" id="periodo"
                                            name="periodo">
                                            <?php
                                                if ($periodos->num_rows > 0) { 
                                                    while($periodo = $periodos->fetch_assoc()) { ?>
                                            <option value=<?php echo $periodo['COD_PERIODO_LECTIVO']; ?>>
                                                <?php echo $periodo['COD_PERIODO_LECTIVO']; ?>
                                            </option> <?php             
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-1 col-12">
                                    <br>
                                    <div class="form-group">
                                        <input type="submit" value="Buscar" class="btn btn-block btn-primary"
                                            style="padding-bottom: 10px;" name="accion">
                                    </div>

                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Listado de Asignaturas</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" style="height: 400px;">
                                            <table class="table table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Asignatura</th>
                                                        <th>Quimestre 1</th>
                                                        <th>Quimestre 2</th>
                                                        <th>Promedio</th>
                                                        <th>Ver</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                        if($calificaciones==""){
                                                            echo "<td colspan = '5'> No hay Datos</td>";
                                                        }else{
                                                            if($calificaciones->num_rows > 0) {
                                                                while($row = $calificaciones->fetch_assoc()) {
                                                                    if ($row["COD_QUIMESTRE"]=='1'){
                                                                        $prom1= $row["NOTA15"];
                                                                    ?>
                                                    <tr>
                                                        <td><?php echo $row["NOMBRE"]?></td>
                                                        <td><?php echo $row["NOTA15"]?></td>
                                                        <?php  
                                                                    }elseif($row["COD_QUIMESTRE"]=='2'){
                                                                    ?>
                                                        <td><?php echo $row["NOTA15"]?></td>
                                                        <td> <?php echo ($row["NOTA15"] + $prom1 )/2?> </td>
                                                        <td>
                                                            <button value=<?php echo $row["COD_ASIGNATURA"]?> name="ver"
                                                                title="ver" class="btn btn-primary"
                                                                style="padding: 2px 5px;">
                                                                <i class="nav-icon fas fa-edit"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <?php

                                                                    }?>
                                                    <?php
                                                                }
                                                            }
                                                        }
                                                    ?>

                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <?php
                        
                        }else{ ?>
                        <div class="container">
                            <div class="container-fluid">
                                <div class="col mb-1">
                                    <br>
                                    <h2 style="text-align: center;">Calificaciones por Materia</h2>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-2 col-4">
                                    <!-- select -->
                                    <div class="form-group">
                                        <label>Materia</label>
                                        <select class="form-control" form="formCalificaciones" id="materia"
                                            name="materia">
                                            <?php
                                                if ($asignaturas->num_rows > 0) { 
                                                    while($materia = $asignaturas->fetch_assoc()) { ?>
                                            <option value=<?php echo $materia['COD_ASIGNATURA']; ?>
                                                <?php if($codAsignatura == $materia['COD_ASIGNATURA']){echo 'selected';} ?>>
                                                <?php echo $materia['NOMBRE']; ?>
                                            </option> <?php             
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-2 col-8">
                                    <br>
                                    <div class="form-group">
                                        <input type="button" name="accion" class="btn btn-block btn-primary"
                                            style="padding-bottom: 14px; width:90px;" value="Buscar"
                                            onclick="buscarAsignaturas();">
                                    </div>


                                </div>
                            </div>
                            <!-- /.row -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0" style="height: 500px;">
                                            <table class="table table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th colspan=2 style=" text-align: center;">QUIMESTRE 1</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Deberes</th>
                                                        <th>Nota</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                        if($calificacionesQ1==""){
                                                            echo "<td colspan = '5'> No hay Datos</td>";
                                                        }else{
                                                            if($calificacionesQ1->num_rows > 0) {
                                                                $indice = 1;
                                                                while($cal1 = $calificacionesQ1->fetch_assoc()) {?>
                                                    <tr>
                                                        <td> <?php echo $cal1["DETALLE_TAREA"]  ?></td>
                                                        <?php $nota="NOTA";    ?>
                                                        <td> <?php  echo $cal1[$nota .$indice] ?></td>
                                                    </tr>
                                                    <?php
                                                            $indice = $indice+1;    
                                                            }
                                                            }
                                                        }
                                                    ?>

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Talleres</th>
                                                        <th>Nota</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Pruebas</th>
                                                        <th>Nota</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>

                                            <table class="table table-head-fixed text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th colspan=2 style=" text-align: center;">QUIMESTRE 2</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Deberes</th>
                                                        <th>Nota</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php
                                                        if($calificacionesQ2==""){
                                                            echo "<td colspan = '5'> No hay Datos</td>";
                                                        }else{
                                                            if($calificacionesQ2->num_rows > 0) {
                                                                $indice = 1;
                                                                while($cal2 = $calificacionesQ2->fetch_assoc()) {?>
                                                    <tr>
                                                        <td> <?php echo $cal2["DETALLE_TAREA"]  ?></td>
                                                        <?php $nota="NOTA";    ?>
                                                        <td> <?php  echo $cal2[$nota.$indice] ?></td>

                                                    </tr>
                                                    <?php
                                                            $indice = $indice+1;      
                                                            }
                                                            }
                                                        }
                                                    ?>

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Talleres</th>
                                                        <th>Nota</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                                <thead>
                                                    <tr>
                                                        <th>Pruebas</th>
                                                        <th>Nota</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>
                                            </table>

                                        </div>

                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                        <!-- /.rowsss -->
                    </div><!-- /.container-fluid -->


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
    <script>
    function buscarAsignaturas() {
        document.getElementById("formCalificaciones").submit();
    }
    </script>
    <!-- Page specific script -->
</body>

</html>