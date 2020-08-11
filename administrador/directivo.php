<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Directivos</title>
  <?php include '../partials/head.php';?>
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
        <img src="../public/intranet/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
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
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Gestión Directivos</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- /.col-md-6 -->
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-3">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="card-title m-0">Agregar Directivo</h5>
                  </div>
                  <div class="card-body">
                    <a href="agregar_directivo.php" class="btn btn-primary">Ingresar&nbsp&nbsp&nbsp<i
                        class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
              <!-- /.col-md-6 -->
              <div class="col-lg-3">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="card-title m-0">Listar Directivos</h5>
                  </div>
                  <div class="card-body">
                    <a href="listar_directivo.php" class="btn btn-primary">Ingresar&nbsp&nbsp&nbsp<i
                        class="fas fa-arrow-circle-right"></i></a>
                  </div>
                </div>
              </div>
              <!-- /.col-md-6 -->
            </div>

            <!-- /.row -->

          </div><!-- /.container-fluid -->

          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

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