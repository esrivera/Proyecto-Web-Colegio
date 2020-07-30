<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>COLEGIO VPR | Perfil</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../public/intranet/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../public/intranet/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../public/intranet/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
            <a href="#" class="dropdown-item dropdown-footer">Cerrar Sesión</a>
          </div>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="../public/intranet/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
          style="opacity: .8">
        <span class="brand-text font-weight-light">ADMINISTRADOR</span>
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
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="perfil.html" class="nav-link active">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Perfil
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>
                  Gestión Usuarios
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="alumno.html  " class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Alumnos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="docente.html" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Docentes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="Representante.html" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Representantes</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Gestión Infraestructura
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./infraestructura/sede.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Sedes</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./infraestructura/edificio.html" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Edificios</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./infraestructura/aula.html" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Aulas</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Organización Academica
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="periodo.html" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gestión Periodos</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="asignatura.html" class="nav-link ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gestión Asignaturas</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
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
              <h1>Página de Bienvenida</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">Admin</li>
                <li class="breadcrumb-item active">Inicio</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- /.col-md-6 -->
          <div class="container">

          </div><!-- /.container-fluid -->

          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.0.5
      </div>
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../public/intranet/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../public/intranet/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery UI -->
  <script src="../public/intranet/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../public/intranet/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../public/intranet/dist/js/demo.js"></script>
  <!-- fullCalendar 2.2.5 -->
  <script src="../public/intranet/plugins/moment/moment.min.js"></script>

  <!-- Page specific script -->
</body>

</html>