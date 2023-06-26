<?php if( ! defined( 'ACCESS' ) ) die( 'DIRECT ACCESS NOT ALLOWED' ); ?>
<?php include 'init.php';?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MISO | Monitoring</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/dist/css/adminlte.css">

    <!-- DataTable -->
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- dropzonejs -->
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/dropzone/min/dropzone.min.css">

    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/summernote/summernote-bs4.min.css">

    <!-- Logo for demo purposes -->
    <link rel="shortcut icon" type="" href="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/img/mislogoNoBG.png">

    <style type="text/css">
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
            background-color: #337ab7 !important ;
            color: white;
        }
        .nav-header{
            color: gray !important;
        }
        .select2-selection,
        .form-control1 {
            height: 38px !important;
        }
        .btn-app1 {
            border-radius: 3px !important;
            background-color: #93979b !important;
            border: 1px solid #04401f !important;
            color: #fff !important;
            font-size: 10px !important;
            height: 38px !important;
            margin: 0 0 10px 10px !important;
            min-width: 80px !important;
            padding: 8px 5px !important;
            position: relative !important;
            text-align: center !important;
        }
        .btn-app1:hover {
            border-radius: 3px !important;
            background-color: #4c8968 !important;
            border: 1px solid #fff000 !important;
        }
        /*[class*=sidebar-dark] .nav-legacy.nav-sidebar>.nav-item>.nav-link.active {
            color: #fff;
        }
        .sidebar-dark-primary .nav-sidebar.nav-legacy>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar.nav-legacy>.nav-item>.nav-link.active {
            border-color: #007bff;
            border-color: #1f5036 !important;
        }*/
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed text-sm">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-success navbar-light" style="background-color: #337ab7;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars" style="color: #ffffff;"></i>
                    </a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt" style="color: #ffffff;"></i>
                    </a>
                </li>

                <li class="nav-item">
                    <!-- <?php
                        $results = $DB->query("SELECT * FROM users WHERE id=".$_SESSION[AUTH_ID]);
                        $users = mysqli_fetch_all($results, MYSQLI_ASSOC);
                    ?>
                    <?php foreach ($users as $row): ?> -->
                        <a class="nav-link" title="Sign Out" href="./?action=logout" role="button" style="color: #ffffff;">

                            <i class="fas fa-power-off"></i> Sign Out
                        </a>
                    <!-- <?php endforeach?> -->
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand" style="background-color: #222d32;">
            <a href="./dashboard" class="brand-link" style="background-color: #337ab7;">
                <img src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/img/mislogoNoBG.png" alt="Logo" class="brand-image img-square">
                <span class="brand-text font-weight-light" style="color:#fff; margin-left:"></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                   <?php include 'elements/side_bar-avatar.php'; ?>
                </div>

                <!-- SidebarSearch Form -->
                
                <!-- Sidebar Menu -->
                <?php include 'elements/side-bar.php';?>
                <!-- /.sidebar-menu -->
            </div>
             <!-- /.sidebar -->
        </aside>

            <!-- Control Sidebar -->
        <!-- <aside class="control-sidebar control-sidebar-dark"></aside>
</div> -->
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="assets/dist/js/demo.js"></script> -->

<!-- DataTables  & Plugins -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- jquery-validation -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/jquery-validation/additional-methods.min.js"></script>

<!-- dropzonejs -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/dropzone/min/dropzone.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/sweetalert2/sweetalert2.min.js"></script>

<!-- Summernote -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/summernote/summernote-bs4.min.js"></script>

<!-- bs-custom-file-input -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- FLOT CHARTS -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/flot/plugins/jquery.flot.resize.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/adminLTE-3/plugins/flot/plugins/jquery.flot.pie.js"></script>
<!-- ChartJS -->
<script src="<?php echo dirname($_SERVER['PHP_SELF']); ?>/assets/js/canvasjs.min.js"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true, 
            "autoWidth": false,
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

         $("#example3").DataTable({
            "responsive": true,
            "lengthChange": true, 
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]

            }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');
        
        // $('#example2').DataTable({
        //     "paging": true,
        //     "lengthChange": false,
        //     "searching": false,
        //     "ordering": true,
        //     "info": true,
        //     "autoWidth": false,
        //     "responsive": true,
        //     });
        });
</script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>

<script>
    $(function () {
    //Add text editor
        $('#compose-textarea').summernote()
    })
</script>

</body>
</html>
