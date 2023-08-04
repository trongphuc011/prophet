<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMIN</title>

    <!-- Custom fonts for this template-->
    <link href="../public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="public/text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../public/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar" style="background:#333856">

            <!-- Sidebar - Brand -->
            <div class="sidebar-brand d-flex align-items-center justify-content-center" >
                
                <div class="sidebar-brand-text mx-3">Prophet AD</div>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->

            <!-- Divider -->
            <hr class="sidebar-divider">
            
            <!-- Heading -->

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item" >
                <a class="nav-link collapsed bg-gradient-warning" href="index.php?act=xulydonhang" >
                    <span>Đơn hàng</span>
                </a>
				<a class="nav-link collapsed bg-gradient-warning" href="index.php?act=xulydanhmuc" >
                    <span>Danh mục</span>
                </a>
				<a class="nav-link collapsed bg-gradient-warning" href="index.php?act=xulydanhmucbaiviet" >
                    <span>Danh mục bài viết</span>
                </a>
				<a class="nav-link collapsed bg-gradient-warning" href="index.php?act=xulybaiviet" >
                    <span>Bài viết</span>
                </a>
				<a class="nav-link collapsed bg-gradient-warning" href="index.php?act=xulysanpham" >
                    <span>Sản phẩm</span>
                </a>
				<a class="nav-link collapsed bg-gradient-warning" href="index.php?act=xulykhachhang" >
                    <span>Khách hàng</span>
                </a>
                <a class="nav-link collapsed bg-gradient-warning" href="../index.php" >
                    <span>Về trang chủ</span>
                </a>
            </li>
        </ul>
		


        
		<div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->

                </nav>
                <!-- Topbar -->
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid p-2">
                    <div class="row">
                    <?php 
                $act = null;
                if((isset($_GET['act'])) && ($_GET['act']!="")){
                    $act =  $_GET['act'];
                }
                switch($act){
                    case 'xulybaiviet':
                        include "xulybaiviet.php";
                        break;
                    case 'xulydanhmuc':
                        include "xulydanhmuc.php";
                        break;
                    case 'xulydanhmucbaiviet':
                        include "xulydanhmucbaiviet.php";
                        break;
                    case 'xulydonhang':
                        include "xulydonhang.php";
                        break;
                    case 'xulykhachhang':
                        include "xulykhachhang.php";		
                        break;
                        case 'xulysanpham':
                            include "xulysanpham.php";		
                            break;
                    default:
                        
                        break;
                        
                }
            ?>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <!-- End of Footer -->
			
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Prophet 2023</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
	
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    
    <!-- Logout Modal-->
    

    <!-- Bootstrap core JavaScript-->
    <script src="../public/vendor/jquery/jquery.min.js"></script>
    <script src="../public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../public/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../public/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../public/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../public/js/demo/chart-area-demo.js"></script>
    <script src="../public/js/demo/chart-pie-demo.js"></script>

</body>

</html>

<style>
    .sidebar-dark .nav-item .nav-link {
    background:#333856 !important;
    color:white;
    
}
</style>