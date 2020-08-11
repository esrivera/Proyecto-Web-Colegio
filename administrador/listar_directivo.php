<?php
include '../service/usuarioServices.php';
$user = new UsuarioService();
$codUsu = 0;
$result = "";

if (isset($_GET["accion"]) && $_GET["accion"] == 'Buscar') {
    $result = $user->findByCI($_GET['ci']);
} else if (isset($_GET['delete'])) {
    $user->deleteTP($_GET['delete']);
    $codUsu = $user->findByCodP($_GET['delete']);
    $user->deleteUR($codUsu['COD_USUARIO']);
    $user->deleteU($_GET['delete']);
    $user->deleteP($_GET['delete']);
    header('Location: listar_directivo.php');
} else{
    $result = $user->findAll('DIR');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Directivos</title>
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
                            <h1>Listado Directivos</h1>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- /.col-md-6 -->
                    <div class="container">
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <form method="get" action="listar_directivo.php">
                                            <div class="card-tools">
                                                <div class="input-group input-group-sm" style="width: 250px;">
                                                    <input type="text" name="ci" id="ci" class="form-control float-right" placeholder="Ingresar Cedula">
                                                    <div class="input-group-append">
                                                        <button type="submit" name="accion" value="Buscar" class="btn btn-default"><i class="fas fa-search"></i></button>
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a type="submit" href="listar_directivo.php" name="accion" value="Refrescar" class="btn btn-default"><i class="fas fa-list"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0" style="height: 400px;">
                                        <table class="table table-head-fixed text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-top-0 bg-gradient-gray-dark">Apellido</th>
                                                    <th class="border-top-0 bg-gradient-gray-dark">Nombre</th>
                                                    <th class="border-top-0 bg-gradient-gray-dark">Cedula</th>
                                                    <th class="border-top-0 bg-gradient-gray-dark">Dirección</th>
                                                    <th class="border-top-0 bg-gradient-gray-dark">Teléfono</th>
                                                    <th class="border-top-0 bg-gradient-gray-dark">Fec Nac</th>
                                                    <th class="border-top-0 bg-gradient-gray-dark">Genero</th>
                                                    <th class="border-top-0 bg-gradient-gray-dark">Correo</th>
                                                    <th class="border-top-0 bg-gradient-gray-dark">Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size: 13px;">
                                                <?php
                                                if ($result) {
                                                    while ($row = $result->fetch_assoc()) { ?>
                                                        <tr>
                                                            <td><?php echo $row['APELLIDO']; ?></td>
                                                            <td><?php echo $row['NOMBRE']; ?></td>
                                                            <td><?php echo $row['CEDULA']; ?></td>
                                                            <td><?php echo $row['DIRECCION']; ?></td>
                                                            <td><?php echo $row['TELEFONO']; ?></td>
                                                            <td><?php echo $row['FECHA_NACIMIENTO']; ?></td>
                                                            <td><?php echo $row['GENERO']; ?></td>
                                                            <td><?php echo $row['CORREO']; ?></td>
                                                            <td>
                                                                <a href="editar_directivo.php?update=<?php echo $row['COD_PERSONA']; ?>" title="Editar datos" name="modificar" class="btn btn-primary btn-sm"><span class="far fa-edit fa-lg" aria-hidden="true"></span></a>
                                                                <a href="listar_directivo.php?delete=<?php echo $row['COD_PERSONA']; ?>" title="Eliminar" name="eliminar" class="btn btn-danger btn-sm"><span class="far fa-trash-alt fa-lg" aria-hidden="true"></span></a>
                                                            </td>
                                                        </tr>
                                                    <?php }
                                                } else { ?>
                                                    <tr>
                                                        <td colspan="8">No hay datos</td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </section>



            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <?php include '../partials/footer.php'; ?>

</body>

</html>