<?php
include '../service/usuarioServices.php';
include "../service/mcript.php";
$user = new UsuarioService();

$codP = 0;
$cedula = "";
$nombre = "";
$apellido = "";
$direccion = "";
$telefono = "";
$fecNac = "";
$genero = "";
$correo = "";
$correop = "";
$username = "";
$clave = "";
$estado = "";
$codTP = "";
$codRU = "";
$fecIni = "";
$codRol = "";
$codUser = 0;
$ultFec = "";
$intentos = 0;
$res = "";
$row = "";
$temp = "";
$accion = "Agregar";
$i = 1;

$codP = $_GET["update"];
if (isset($_GET["update"])) {
    $usuario = $user->findPersona($_GET["update"]);
    $nombre = $usuario['NOMBRE'];
    $cedula = $usuario['CEDULA'];
    $apellido = $usuario['APELLIDO'];
    $direccion = $usuario['DIRECCION'];
    $telefono = $usuario['TELEFONO'];
    $fecNac = $usuario['FECHA_NACIMIENTO'];
    $genero = $usuario['GENERO'];
    $correop = $usuario['CORREO_PERSONAL'];
}
if (isset($_POST['accion']) && ($_POST['accion'] == 'Modificar')) {
    $username = $user->username($_POST['nombre'], $_POST['apellido']);
    while ($user->findUNCod($username, $codP) != null) {
        $username = $user->username($_POST['nombre'], $_POST['apellido']);
        $username .= "$i";
        $i++;
    }
    $correo = $username;
    $correo .= "@vrp.edu.ec";
    $user->updatePersona($codP, $_POST['nombre'], $_POST['apellido'], $_POST['ci'], $_POST['fecNac'], $correo, $_POST['direccion'], $_POST['telefono'], $_POST['genero'], $_POST['email']);
    $res = $user->findByPkP($_POST['ci']);
    $codP = $res['COD_PERSONA'];
    $estado = 'ACT';
    $ultFec = date("Y-m-d");
    $clave = new DateTime($_POST['fecNac']);
    $clave = $clave->format('dmy');
    $clave = $encriptar($clave);
    $user->updateUsuario($codP, $username, $clave, $estado, $ultFec, $intentos);
    $row = $user->findUN($username);
    header('Location: listar_docente.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Docentes</title>
    <?php include '../partials/head.php'; ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <a href="./docente.html" class="brand-link">
                <img src="../public/intranet/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Administrador</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="../public/intranet/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Santiago Vivas</a>
                    </div>
                </div>
                <!-- Sidebar Menu -->
                <?php include '../partials/menuAdm.php'; ?>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Editar Docente</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-6 mx-auto">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Datos del Docente</h3>
                                </div>
                                <!-- /.card-header -->
                                <!-- form start -->
                                <form role="form" action="editar_docente.php" method="POST">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nombres</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre ?>" placeholder="Ingresar Nombre" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Apellidos</label>
                                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $apellido ?>" placeholder="Ingresar Apellido" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Cedula</label>
                                                    <input type="text" class="form-control" id="ci" name="ci" value="<?php echo $cedula ?>" placeholder="Ingresar Cedula" required>
                                                </div>
                                            </div>
                                            <div class="div-sm-6">
                                                <div class="form-group">
                                                    <label>Fecha de Nacimiento</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="fecNac" name="fecNac" value="<?php echo $fecNac ?>" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" placeholder="dd/mm/yyyy" data-mask required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $correop ?>" placeholder="Ingresar email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $direccion ?>" placeholder="Ingresar Dirección Domiciliaria" required>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="exampleInputPassword1">Teléfono</label>
                                                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono ?>" placeholder="Ingresar Teléfono" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <label>Genero</label>
                                                <select class="form-control" name="genero" value="<?php echo $genero ?>" id="genero">
                                                    <option value="MAS">MASCULINO</option>
                                                    <option value="FEM">FEMENINO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" value="Modificar" name="accion" class="btn btn-primary btn-block">Modificar</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->

            <?php include '../partials/footer.php'; ?>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

</body>

</html>