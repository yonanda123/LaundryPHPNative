<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/plugins/images/admin-logo.png">
    <title>Aplikasi Penglolaan Laundry</title>
    
    <link href="assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
   
    <link href="assets/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
   
    <link href="assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    
    <link href="assets/plugins/bower_components/chartist-js/dist/chartist.min.css" rel="stylesheet">
    <link href="assets/plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css" rel="stylesheet">
    
    <link href="assets/css/animate.css" rel="stylesheet">
    
    <link href="assets/css/style.css" rel="stylesheet">
    
    <link href="assets/css/colors/default.css" id="theme" rel="stylesheet">
   
    <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
    <link rel="stylesheet" href="plugins/select2/select2.min.css">

    <link href="assets/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="assets/sweetalert2/dist/sweetalert2.min.js"></script>

    <script src="assets/js/jquery-3.4.1.min.js"></script>

    <style>
        .image-preview{
            width: 150px; 
            min-height: 150px;
            border: 2px solid #dddddd;
            margin-top: 15px;

            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #cccccc;
        }

        .image-preview__image{
            display: none;
            width: 100%;
        }
    </style>

</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <?php if ($title == 'dashboard') { ?>
        <div class="preloader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
            </svg>
        </div>
    <?php } ?>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                <div class="top-left-part">
                    <!-- Logo -->
                    <a class="logo" href="index.php">
                        <!-- Logo icon image, you can use font-icon also -->
                        <b style="color:black">
                            LAUNDRY
                        </b>
                        <!-- Logo text image you can use text also -->
                        <span class="hidden-xs text-dark">
                            APP
                        </span>
                    </a>
                </div>
                <!-- /Logo -->
                <ul class="nav navbar-top-links navbar-right pull-right">
                    <li>
                        <a class="nav-toggler open-close waves-effect waves-light hidden-md hidden-lg" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    </li>
                    <?php
                    include "koneksi2.php";

                    session_start();

                    if ($_SESSION['admin']) {
                        $user = $_SESSION['admin'];
                    } elseif ($_SESSION['kasir']) {
                        $user = $_SESSION['kasir'];
                    } elseif ($_SESSION['owner']) {
                        $user = $_SESSION['owner'];
                    }

                    $sql_user = $conn->query("select * from tb_user where id='$user'");
                    $data_user = $sql_user->fetch_assoc();

                    $nama = $data_user['nama_user'];
                    $level = $data_user['level'];
                    $id_user = $data_user['id'];
                    ?>
                    <li>
                        <a class="profile-pic" href="#"> <img src="images/<?php echo $data_user['foto'] ?>" alt="user-img" width="36" class="img-circle"><b class="hidden-xs">Hai, <?php echo $nama; ?></b></a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-close ti-menu"></i></span> <span class="hide-menu">Navigation</span></h3>
                </div>
                <ul class="nav" id="side-menu">
                    <li style="padding: 70px 0 0;">
                        <a href="dashboard.php" class="waves-effect <?php if ($title == 'dashboard') {
                                                                        echo 'active';
                                                                    } ?>"><i class="fa fa-tachometer fa-fw" aria-hidden="true"></i>Dashboard</a>
                    </li>
                    <li>
                        <a href="outlet.php" class="waves-effect <?php if ($title == 'outlet') {
                                                                        echo 'active';
                                                                    } ?>"><i class="fa fa-suitcase fa-fw" aria-hidden="true"></i> Outlet</a>
                    </li>
                    <li>
                        <a href="paket.php" class="waves-effect <?php if ($title == 'paket') {
                                                                    echo 'active';
                                                                } ?>"><i class="fa fa-archive fa-fw" aria-hidden="true"></i> Paket</a>
                    </li>
                    <li>
                        <a href="pengguna.php" class="waves-effect <?php if ($title == 'pengguna') {
                                                                        echo 'active';
                                                                    } ?>"><i class="fa fa-user fa-fw" aria-hidden="true"></i> Pengguna</a>
                    </li>
                    <li>
                        <a href="pelanggan.php" class="waves-effect <?php if ($title == 'pelanggan') {
                                                                        echo 'active';
                                                                    } ?>"><i class="fa fa-users fa-fw" aria-hidden="true"></i> Pelanggan</a>
                    </li>
                    <li>
                        <a href="transaksi.php" class="waves-effect <?php if ($title == 'transaksi') {
                                                                        echo 'active';
                                                                    } ?>"><i class="fa fa-shopping-cart fa-fw" aria-hidden="true"></i> Transaksi</a>
                    </li>
                    <li>
                        <a href="laporan.php" class="waves-effect <?php if ($title == 'laporan') {
                                                                        echo 'active';
                                                                    } ?>"><i class="fa fa-file-text fa-fw" aria-hidden="true"></i> Laporan</a>
                    </li>
                </ul>
                <div class="center p-20">
                    <a href="logout.php" class="btn btn-danger btn-block waves-effect waves-light">Logout</a>
                </div>
            </div>

        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">