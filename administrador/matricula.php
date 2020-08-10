<?php

    include '../service/matriculaService.php';
    session_start();
    if(!isset($_SESSION['user'])){
         header('Location: ../login.php');
    }else{

        $matriculaService= new MatriculaService();

        $codigoPeriodo="P12020";

        $periodo=$matriculaService->getPeriodo($codigoPeriodo);
        $nivelAsignatura= $matriculaService->getNivelEducativo();
        $alumnos= $matriculaService->getAlumnos();
    }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Matrícula</title>
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
            <a href="./perfil.php" class="brand-link">
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

        <div class="content-wrapper">
            <!-- Main content -->
            <form action="./matricula.php" method="POST" id="formMatricula" class="formMatricula">
                <section class="content">
                    <div class="conatiner-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="container-fluid">
                                <div class="col mb-1">
                                    <h1 style="text-align: center;">Gestión Matricula</h1>
                                </div>
                            </div>

                            <div class="col-sm-6 mx-auto">
                                <div class="form-group row mb-2">
                                    <div class="col-sm-3">
                                        <select class="form-control" id="periodo" name="codigoPeriodo"
                                            form="formMatricula" required>
                                            <?php if ($periodo->num_rows > 0) { 
                                                        while($resultPeriodo = $periodo->fetch_assoc()) { ?>
                                            <option
                                                <?php if($codPeriodo!="" && $codPeriodo== $resultPeriodo["COD_PERIODO_LECTIVO"]){echo 'selected'; } ?>
                                                value=<?php echo $resultPeriodo["COD_PERIODO_LECTIVO"]?>>
                                                <?php             echo $resultPeriodo["COD_PERIODO_LECTIVO"]?>

                                            </option>
                                            <?php 
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-5.5">
                                        <select class="form-control" id="codNivelAsignatura" name="codNivelAsignatura"
                                            form="formAsignacion">
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

                                    <div class="col-sm-4">
                                        <input type="button" name="Buscar" class="btn btn-block btn-primary float-right"
                                            style="padding-bottom: 4px; width:140px;" value="Asignar matricula"
                                            onclick="buscarAula();">
                                    </div>

                                </div>
                                <div class="card-body table-responsive p-0" style="height: 500px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>CÓDIGO</th>
                                                <th>CEDULA</th>
                                                <th>APELLIDO</th>
                                                <th>NOMBRE</th>
                                                <th>ACCIÓN</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        if($alumnos!=""){
                                        if ($alumnos->num_rows > 0) {
                                        // output data of each row
                                        while($row = $alumnos->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row["COD_PERSONA"]?></td>
                                                <td><?php echo $row["CEDULA"]?></td>
                                                <td><?php echo $row["APELLIDO"]?></td>
                                                <td><?php echo $row["NOMBRE"]?></td>
                                               
                                                <td><input type="checkbox" class="form-check-input-center" name="codigoAlumno"
                                                        value="<?php echo $row["COD_PERSONA"]?>"></<td>
                                                <!-- <td><a href="./matricula.php?delete=<?php echo $row['COD_AULA'];?>"
                                                        class="btn btn-danger btn-sm"><span
                                                            class="glyphicon glyphicon-trash"></span> Eliminar</a> -->
                                                </td>
                                            </tr>
                                            <?php 
                                        }
                                        ?>

                                            <?php 
                                        }else{
                                        ?>
                                            <tr>
                                                <td colspan="4"> No hay datos</td>
                                            </tr>
                                            <?php }}
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-sm-5 mx-auto">

                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Datos de Matricula</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="codigoAula">Código de Aula</label>
                                            <input type="text" class="form-control" id="codigoAula" name="codigoAula"
                                                <?php if(isset($_GET['actualizar'])) echo 'readonly'?>
                                                value="<?php echo $codAula;?>" placeholder="Ingrese el código"
                                                maxlength="5" required>
                                        </div>
                                        <?php $periodo= $matriculaService->getPeriodo();?>
                                        <div class="form-group">
                                            <label for="periodo">Periódo Lectivo</label>
                                            <select class="form-control" id="periodo" name="codigoPeriodo"
                                                form="formMatricula" required>
                                                <?php if ($periodo->num_rows > 0) { 
                                                        while($resultPeriodo = $periodo->fetch_assoc()) { ?>
                                                <option
                                                    <?php if($codPeriodo!="" && $codPeriodo== $resultPeriodo["COD_PERIODO_LECTIVO"]){echo 'selected'; } ?>
                                                    value=<?php echo $resultPeriodo["COD_PERIODO_LECTIVO"]?>>
                                                    <?php             echo $resultPeriodo["COD_PERIODO_LECTIVO"]?>

                                                </option>
                                                <?php 
                                                    }
                                                }
                                            ?>
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                value="<?php echo $nombre;?>"
                                                placeholder="Ingrese el nombre de la asignatura" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="capacidad">Capacidad</label>
                                            <input type="number" class="form-control" id="capacidad" name="capacidad"
                                                min=1 max=50 value="<?php echo $capacidad;?>"
                                                placeholder="Ingrese la capacidad del aula" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipoAula">Tipo</label>
                                            <select class="form-control" id="tipoAula" name="tipoAula" form="formAula"
                                                value="<?php echo $tipo;?>">
                                                <option value='GEN'
                                                    <?php if($tipo!="" && $tipo=='GEN'){echo 'selected'; }?>>
                                                    GENERAL</option>

                                                <option value='LAB'
                                                    <?php if($tipo!="" && $tipo=='LAB'){echo 'selected'; }?>>
                                                    LABORATORIO</option>

                                                <option value='AUD'
                                                    <?php if($tipo!="" && $tipo=='AUD'){echo 'selected'; }?>>
                                                    AUDIOVISUAL</option>
                                            </select>

                                        </div>
                                        <div class="form-group">
                                            <label for="piso">Piso</label>
                                            <input type="number" class="form-control" id="piso" name="piso" min=1 max=10
                                                value="<?php echo $piso;?>" placeholder="Ingrese el piso del aula"
                                                required>
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

        </div>
    <!-- ./wrapper -->
</body>

</html>