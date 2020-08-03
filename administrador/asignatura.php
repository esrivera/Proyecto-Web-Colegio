<?php
      include '../service/asignService.php';
      
      session_start();
      if(!isset($_SESSION['user'])){
          header('Location: ../login.php');
      }else{
        $accion="Agregar";
        $asignaturas ="";
        $asignService = new AsignService();

        $codAsignatura = "";
        $nombre = "";
        $creditos = "";
        $tipo = "";
        $codNivelEducativo = "";

        $nivelAsignatura=$asignService->getNivelEducativo();
        
        if(isset($_POST["codNivelAsignatura"])){
          $asignaturas = $asignService->getAsignaturas($_POST["codNivelAsignatura"]);
        }
        if(isset($_POST["accion"]) && $_POST["accion"] == "Agregar"){
          $asignService->insert($_POST["nivelEducativo"],$_POST["codigoAsignatura"],
                                $_POST["nombre"],$_POST["creditos"],$_POST["tipoAsignatura"]);
          $asignaturas = $asignService->getAsignaturas($_POST["nivelEducativo"]);

        }elseif(isset($_GET['actualizar'])){
         $datosAsignatura = $asignService->findByPk($_GET['actualizar']);
          if($datosAsignatura!=null){
              $codAsignatura = $datosAsignatura["COD_ASIGNATURA"];
              $nombre = $datosAsignatura["NOMBRE"];
              $creditos = $datosAsignatura["CREDITOS"];
              $tipo = $datosAsignatura["TIPO"];
              $codNivelEducativo = $datosAsignatura["COD_NIVEL_EDUCATIVO"];
          }

          $accion="Modificar";
        }elseif(isset($_POST["accion"]) && $_POST["accion"] == "Modificar"){

          $asignService->update($_POST["nivelEducativo"],$_POST["codigoAsignatura"], $_POST["nombre"],$_POST["creditos"],$_POST["tipoAsignatura"]);
          $asignaturas = $asignService->getAsignaturas($_POST["codNivelAsignatura"]);
        }elseif(isset($_POST["codigoElimAsignatura"])){
          
          $asignService->delete($_POST["codigoElimAsignatura"]);
          $asignaturas = $asignService->getAsignaturas($_POST["codNivelAsignatura"]);
        }

      }

  
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Asignatura</title>
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
            <form action="./asignatura.php" method="POST" id="formAsignatura" class="formAsignatura">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6 mx-auto">
                            <div class="card-primary card card-header">
                                <label for="codNivelAsignatura" class="card-title">Seleccione El Nivel Educativo</label>
                            </div>
                            <div class="form-group">
                                <div class="row">
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
                                    <div class="">
                                        <input type="button" name="Buscar" class="btn btn-block btn-primary float-right"
                                            style="padding-bottom: 4px; width:75px;" value="Buscar"
                                            onclick="buscarAsignaturas();">
                                    </div>
                                </div>
                            </div>

                            <div class="card-body table-responsive p-0" style="height: 300px;">
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
                                            <td><a href="./asignatura.php?actualizar=<?php echo $row["COD_ASIGNATURA"]?>">
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
                            <div class="form-group card-header">
                                <input type="button" name="eliminar" class="btn btn-block btn-primary float-right"
                                    style="padding-bottom: 4px; width:75px;" value="Eliminar" onclick="eliminarAsignatura();">
                            </div>


                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Datos de la Asignatura</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->

                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="codigo">Código</label>
                                        <input type="text" class="form-control" id="codigo" name="codigoAsignatura" 
                                          value="<?php echo $codAsignatura;?>" placeholder="Ingrese el código">
                                    </div>

                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                        value="<?php echo $nombre;?>" placeholder="Ingrese el nombre de la asignatura">
                                    </div>

                                    <div class="form-group">
                                        <label for="creditos">Créditos</label>
                                        <input type="number" class="form-control" id="creditos" name="creditos" min=1
                                        value="<?php echo $creditos;?>"  placeholder="Ingrese el número de créditos">
                                    </div>

                                    <div class="form-group">
                                        <label for="tipoAsignatura">Tipo</label>
                                        <select class="form-control" id="tipoAsignatura" name="tipoAsignatura"
                                            form="formAsignatura" value="<?php echo $tipo;?>">
                                            <option value='MIN'>Ministerio</option>

                                            <option value='PRO'>Propia</option>

                                            <option value='OTR'>Otra</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="nivelEducativo">Nivel Educativo</label>
                                        <select class="form-control" id="nivelEducativo" name="nivelEducativo"
                                            form="formAsignatura">
                                            <option value='BAC01'>PRIMERO DE BACHILLERATO</option>
                                            <option value='BAC02'>SEGUNDO DE BACHILLERATO</option>
                                            <option value='BAS01'>OCTAVO CURSO</option>
                                            <option value='BAS02'>NOVENO CURSO</option>
                                        </select>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                      <input type="submit" class="btn btn-primary btn-block" name="accion" value="<?php echo $accion;?>">
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

</html>