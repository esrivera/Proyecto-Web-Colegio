<?php
    include '../service/edificioService.php';

    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: ../login.php');
    }else{
        $accion="Agregar";
        $edificio= "";
        $edificioService = new EdificioService();

        $codEdificio= "";
        $nombre ="";
        $cantidad_pisos="";
        $codSede="";

        $sede= $edificioService->getSedes();
        //print_r($sede);

        if(isset($_POST["codSede"])){
            $edificio = $edificioService->getEdificios($_POST["codSede"]);
        }
        if(isset($_POST["accion"]) && $_POST["accion"] == "Agregar"){
            $edificioService->insert($_POST["codigoEdificio"],$_POST["codigoSede"],
                $_POST["nombre"],$_POST["pisos"]);
            $edificio = $edificioService->getEdificios($_POST["codigoSede"]);

        }elseif(isset($_GET['actualizar'])){
            $datosEdificio = $edificioService->findByPk($_GET['actualizar']);
            if($datosEdificio!=null){
                $codEdificio = $datosEdificio["COD_EDIFICIO"];
                $nombre = $datosEdificio["NOMBRE"];
                $cantidad_pisos = $datosEdificio["CANTIDAD_PISOS"];
                    
                $codSede = $datosEdificio["COD_SEDE"];
                $edificio = $edificioService->getEdificios($codSede);

            }
            $accion="Modificar";
        }elseif(isset($_POST["accion"]) && $_POST["accion"] == "Modificar"){
        
            $edificioService->update($_POST["codigoEdificio"],$_POST["codigoSede"],
            $_POST["nombre"],$_POST["pisos"]);
            
            $edificio = $edificioService->getEdificios($_POST["codigoSede"]);
        }elseif(isset($_POST["codigoElimEdificio"])){
          
            $edificioService->delete($_POST["codigoElimEdificio"]);

            $edificio = $edificioService->getEdificios($_POST["codigoSede"]);
          }
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
            <form action="./edificio.php" method="POST" id="formEdificio" class="formEdificio">
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

                                        <select class="form-control" id="codSede" name="codSede" form="formEdificio">
                                            <?php   if ($sede->num_rows > 0) { 
                                                while($resultSede = $sede->fetch_assoc()) {
                                            ?><option <?php  
                                                    if(isset($_POST["codSede"])){
                                                        if($_POST["codSede"] == $resultSede["COD_SEDE"]){
                                                        ?> selected <?php
                                                        }
                                                    }elseif($codSede!="" && $codSede== $resultSede["COD_SEDE"]){echo 'selected'; }
                                                    
                                                    ?> value=<?php echo $resultSede["COD_SEDE"]?>>
                                                <?php             echo $resultSede["NOMBRE"]?>

                                            </option>
                                            <?php
                                            }
                                            }
                                        ?>
                                        </select>
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" name="Buscar" class="btn btn-block btn-primary float-right"
                                            style="padding-bottom: 4px; width:75px;" value="Buscar"
                                            onclick="buscarEdificios();">
                                    </div>

                                    <div class="col-sm-2">
                                        <input type="button" name="eliminar"
                                            class="btn btn-block btn-primary float-right"
                                            style="padding-bottom: 4px; width:75px;" value="Eliminar"
                                            onclick="eliminarEdificio();">
                                    </div>

                                </div>
                                <div class="card-body table-responsive p-0" style="height: 500px;">
                                    <table class="table table-head-fixed text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>CÓDIGO</th>
                                                <th>NOMBRE</th>
                                                <th>CANTIDAD DE PISOS</th>
                                                <th>ACCIÓN</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                        if($edificio!=""){
                                        if ($edificio->num_rows > 0) {
                                        // output data of each row
                                        while($row = $edificio->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><a
                                                        href="./edificio.php?actualizar=<?php echo $row["COD_EDIFICIO"]?>">
                                                        <?php echo $row["COD_EDIFICIO"]?> </a></td>
                                                <td><?php echo $row["NOMBRE"]?></td>
                                                <td><?php echo $row["CANTIDAD_PISOS"]?></td>
                                                <td><input type="radio"  class="form-check-input" name="codigoElimEdificio"
                                                        value="<?php echo $row["COD_EDIFICIO"]?>"></td>
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
                                            <label for="codigoEdificio">Código de Edificio</label>
                                            <input type="text" class="form-control" id="codigoEdificio"
                                            <?php if(isset($_GET['actualizar'])) echo 'readonly'?>
                                                name="codigoEdificio" value="<?php echo $codEdificio;?>"
                                                placeholder="Ingrese el código" maxlength="5" required>
                                        </div>
                                        <?php $sede=$edificioService->getSedes(); ?>
                                        <div class="form-group">
                                            <label for="sede">Sede</label>
                                            <select class="form-control" id="sede" name="codigoSede" form="formEdificio"
                                                required>
                                                <?php if ($sede->num_rows > 0) { 
                                                        while($resultSede = $sede->fetch_assoc()) { ?>
                                                <option
                                                    <?php if($codSede!="" && $codSede== $resultSede["COD_SEDE"]){echo 'selected'; } ?>
                                                    value=<?php echo $resultSede["COD_SEDE"]?>>
                                                    <?php             echo $resultSede["NOMBRE"]?>

                                                </option>
                                                <?php        }
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
                                            <label for="creditos">Cantidad de Pisos</label>
                                            <input type="number" class="form-control" id="pisos" name="pisos" min=1
                                                max=10 value="<?php echo $cantidad_pisos;?>"
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
    function buscarEdificios() {
        document.getElementById("formEdificio").submit();
    }

    function eliminarEdificio() {
        document.getElementById("formEdificio").submit();
    }
    </script>
</body>

</html>