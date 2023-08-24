<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PICTD SUPPORT</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>public/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />
  <link rel="stylesheet" href="<?= base_url() ?>public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" />
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <h1 class="animation__shake">PICTD SUPPORT</h1>
      <!-- <img class="animation__shake" src="<?= base_url() ?>public/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60"> -->
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="/" class="nav-link">Home</a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= site_url("logout") ?>" class="nav-link">Logout</a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?= base_url() ?>dashboard" class="brand-link">
        <!-- <img src="<?= base_url() ?>public/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text font-weight-light">PICTD SUPPORT</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <!-- <div class="image">
          <img src="<?= base_url() ?>public/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
          <div class="info">
            <a href="#" class="d-block"><?= auth()->user()->username ?? "GUEST" ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php if (auth()->user()->inGroup('superadmin')) : ?>
              <li class="nav-item">
                <a href="<?= base_url() ?>dashboard" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
            <?php endif; ?>
            <li class="nav-item">
              <a href="<?= base_url() ?>supportticket" class="nav-link">
                <i class="nav-icon fas fa-headset"></i>
                <p>
                  Support Tickets
                </p>
              </a>
            </li>
            <?php if (auth()->user()->inGroup('superadmin')) : ?>
              <li class="nav-header">MASTER FILE</li>
              <li class="nav-item">
                <a href="<?= base_url() ?>office" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Offices
                  </p>
                </a>
              </li>
              <li class="nav-header">ADMIN</li>
              <li class="nav-item">
                <a href="<?= base_url() ?>user" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    User Management
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url() ?>user" class="nav-link">
                  <i class="nav-icon fas fa-key"></i>
                  <p>
                    Role Management
                  </p>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?= $this->renderSection('content') ?>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Project by: RUFINO JOHN AGUILAR</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url() ?>public/plugins/jquery/jquery.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
  <!-- jQuery UI 1.11.4 -->
  <script src="<?= base_url() ?>public/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->

  <!-- ChartJS -->
  <script src="<?= base_url() ?>public/plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="<?= base_url() ?>public/plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="<?= base_url() ?>public/plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?= base_url() ?>public/plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="<?= base_url() ?>public/plugins/moment/moment.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="<?= base_url() ?>public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="<?= base_url() ?>public/plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="<?= base_url() ?>public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>public/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <!-- <script src="<?= base_url() ?>public/dist/js/demo.js"></script> -->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="<?= base_url() ?>public/dist/js/pages/dashboard.js"></script> -->
  <!-- datatables js -->
  <script src="<?= base_url() ?>public/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url() ?>public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url() ?>public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


  <?= $this->renderSection('script') ?>
</body>

</html>