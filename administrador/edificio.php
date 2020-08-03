<?php
      include '../service/edificioService.php';

      session_start();
      if(!isset($_SESSION['user'])){
          header('Location: ../login.php');
      }else{
        $accion="Agregar";
       
      }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edificio</title>
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
            <form action="./asignatura.php" method="POST" id="formAsignatura" class="formAsignatura">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="container-fluid">
                                <div class="col mb-1">
                                    <h1 style="text-align: center;">Gestión de Edificios</h1>
                                </div>
                            </div>
                            <div class="col-sm-5 mx-auto">

                                <div class="form-group row mb-2">
                                    <div class="col-sm-5">
                                        <select class="form-control" id="codNivelAsignatura" name="codNivelAsignatura"
                                            form="formAsignatura">
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
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" name="Buscar" class="btn btn-block btn-primary float-right"
                                            style="padding-bottom: 4px; width:75px;" value="Buscar"
                                            onclick="buscarAsignaturas();">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" name="eliminar"
                                            class="btn btn-block btn-primary float-right"
                                            style="padding-bottom: 4px; width:75px;" value="Eliminar"
                                            onclick="eliminarAsignatura();">
                                    </div>

                                </div>
                                <div class="card-body table-responsive p-0" style="height: 500px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>CÓDIGO</th>
                                                <th>NOMBRE</th>
                                                <th>CREDITOS</th>
                                                <th>TIPO</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        if($asignaturas!=""){
                                        if ($asignaturas->num_rows > 0) {
                                        // output data of each row
                                        while($row = $asignaturas->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><a
                                                        href="./asignatura.php?actualizar=<?php echo $row["COD_ASIGNATURA"]?>">
                                                        <?php echo $row["COD_ASIGNATURA"]?> </a></td>
                                                <td><?php echo $row["NOMBRE"]?></td>
                                                <td><?php echo $row["CREDITOS"]?></td>
                                                <td><?php echo $row["TIPO"]?></td>
                                                <td><input type="radio" name="codigoElimAsignatura"
                                                        value="<?php echo $row["COD_ASIGNATURA"]?>"></td>
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
                                        <h3 class="card-title">Datos de Edificio</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <!-- form start -->

                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="codigoEficio">Código de Edificio</label>
                                            <input type="text" class="form-control" id="codigoEficio" name="codigoEdificio"
                                                value="<?php echo $codEdificio;?>" placeholder="Ingrese el código" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="codigoSede">Código de Sede</label>
                                            <input type="text" class="form-control" id="codigoSede" name="codigoSede"
                                                value="<?php echo $codSede;?>" placeholder="SED01" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                value="<?php echo $nombre;?>"
                                                placeholder="Ingrese el nombre de la asignatura" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="creditos">Cantidad de Pisos</label>
                                            <input type="number" class="form-control" id="pisos" name="pisos"
                                                min=1 value="<?php echo $cantidad_pisos;?>"
                                                placeholder="Ingrese el número de pisos" required>
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
        document.getElementById("formAsignatura").submit();
    }

    function eliminarAsignatura() {
        document.getElementById("formAsignatura").submit();
    }
    </script>
</body>