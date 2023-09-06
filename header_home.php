<?php
include('./base/classes/DB.class.php');
include('./base/classes/Funcoes.class.php');
$database = new DB();

?>


<?php include "includes/validar.php" ?>
<?php

?>
<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Starter</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="/admin/base/lib/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/admin/base/lib/AdminLTE-3.2.0/dist/css/adminlte.min.css">
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
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="btn btn-danger" role="button">Deslogar</a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <p class="brand-link"> AdminLTE 3</p>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block"><?php echo $_SESSION['nome']; ?></a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

            <?php
            if ($_SESSION['perfil_id'] == 1) {
            ?>
              <li class="nav-item">

              </li>
            <?php
            }
            ?>

            <?php
            $idPerfil = $_SESSION['perfil_id'];
            $sqlMenu = $database->get_results("SELECT 
                                                    a.* 
                                                    ,b.nome as menu_nome
                                                    ,b.link as menu_link
                                                    FROM perfil_menu a
                                                    LEFT JOIN menu b on b.id = a.id_menu
                                                    WHERE a.id_perfil = $idPerfil
                                                  ");

            foreach ($sqlMenu as $value) {
            ?>
              <li class="nav-item">
                <a href="<?php echo $value['menu_link']; ?>" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    <?php echo $value['menu_nome']; ?>
                  </p>
                </a>
              </li>
            <?php
            }
            ?>



          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>