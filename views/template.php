<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Membership Admin</title>
  <link rel="icon" href="views/dist/img/logo.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="views/plugins/fontawesome-free/css/all.min.css">
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="views/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/adminlte.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="views/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

   <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="views/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="views/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="views/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- DataTables -->
  <link rel="stylesheet" href="views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.js"></script>

  <!-- DataTables  & Plugins -->
  <script src="views/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="views/plugins/jszip/jszip.min.js"></script>
  <script src="views/plugins/pdfmake/pdfmake.min.js"></script>
  <script src="views/plugins/pdfmake/vfs_fonts.js"></script>
  <script src="views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <!--SweetAlert2-->
  <script src="views/plugins/sweetalert2/sweetalert2.min.js"></script>

  
  <!-- PAGE PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="views/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="views/plugins/raphael/raphael.min.js"></script>
  <script src="views/plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="views/plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="views/plugins/chart.js/Chart.min.js"></script>
  
  <!-- AdminLTE for demo purposes 
  <script src="views/dist/js/demo.js"></script>-->
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="views/dist/js/pages/dashboard2.js"></script> -->

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php
    if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
      echo'<div class="wrapper">';
        include 'modules/navbar.php';
        include 'modules/sidebar.php';
        if(isset($_GET["ruta"])){

          if($_GET["ruta"] == "dashboard" ||
            $_GET["ruta"] == "user"||
            $_GET["ruta"] == "product"||
            $_GET["ruta"] == "logOut"){
            include "modules/".$_GET["ruta"].".php";
          }else{
            include "modules/404.php";
          }
        }else{
          include "modules/dashboard.php";
        }
      
        include 'modules/footer.php';
      echo'</div>';
    }else{
      include "modules/login.php";
    }
    ?>
  </div>
  <!-- ./wrapper -->  
  

  
 
<script src="views/js/template.js"></script>
<script src="views/js/user.js"></script>
</body>
</html>