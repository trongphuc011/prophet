<?php



function connectDB_user($sql){
          //Kết nối database
          $servername = "localhost:3307";
          $username = "root";
          $password = "";
  
          try {
            
          $conn = new PDO("mysql:host=$servername;dbname=bandienmay", $username, $password);
          // set the PDO error mode to exception
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         //  echo "Connected successfully";
          $stmt = $conn->prepare("SELECT * FROM tbl_khachhang");
          $stmt->execute();
  
          // set the resulting array to associative
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          $products=$stmt->fetchAll();
          return $products;
         } catch(PDOException $e) {
             echo "Connection failed: " . $e->getMessage();
             }
         }


	// session_destroy();
	// unset('dangnhap');
	if(isset($_POST['dangnhap_home'])) {
		$taikhoan = $_POST['email_login'];
		$matkhau = md5($_POST['password_login']);
		if($taikhoan=='' || $matkhau ==''){
			echo '<script>alert("Làm ơn không để trống")</script>';
		}else{
			$sql_select_admin = mysqli_query($con,"SELECT * FROM tbl_khachhang WHERE email='$taikhoan' AND password='$matkhau' LIMIT 1");
			$count = mysqli_num_rows($sql_select_admin);
			$role = 
			$row_dangnhap = mysqli_fetch_array($sql_select_admin);
			if($count>0){
				$_SESSION['dangnhap_home'] = $row_dangnhap['name'];
				$_SESSION['role'] = $row_dangnhap['role'];
				$_SESSION['khachhang_id'] = $row_dangnhap['khachhang_id'];
				
			}else{
				echo '<script>alert("Tài khoản mật khẩu sai")</script>';
			}
		}
	}else if(isset($_POST['dangky'])){
		$name = $_POST['name'];
	 	$phone = $_POST['phone'];
	 	$email = $_POST['email'];
	 	$password = md5($_POST['password']);
	 	$role = $_POST['role'];
	 	$address = $_POST['address'];
	 	$giaohang = $_POST['giaohang'];
 
 		$sql_khachhang = mysqli_query($con,"INSERT INTO tbl_khachhang(name,phone,email,address,note,giaohang,password) values ('$name','$phone','$email','$address','$note','$giaohang','$password')");
 		$sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
 		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
 		$_SESSION['dangnhap_home'] = $name;
		$_SESSION['khachhang_id'] = $row_khachhang['khachhang_id'];
		
 		header('Location:index.php?quanly=giohang');
	}
?> 

<!-- top-header -->
	
	<!-- modals -->
	<!-- log in -->
	<div class="modal fade" id="dangnhap" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title text-center">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post">
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="text" class="form-control" placeholder=" " name="email_login" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Mật khẩu</label>
							<input type="password" class="form-control" placeholder=" " name="password_login" required="">
						</div>
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangnhap_home" value="Đăng nhập">
						</div>
						
						<p class="text-center dont-do mt-3">Chưa có tài khoản?
							<a href="#" data-toggle="modal" data-target="#dangky">
								Đăng ký</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- register -->
	<div class="modal fade" id="dangky" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Đăng ký</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" method="post">
						<div class="form-group">
							<label class="col-form-label">Tên khách hàng</label>
							<input type="text" class="form-control" placeholder=" " name="name" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Email</label>
							<input type="email" class="form-control" placeholder=" " name="email" required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Phone</label>
							<input type="text" class="form-control" placeholder=" " name="phone"  required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Address</label>
							<input type="text" class="form-control" placeholder=" " name="address"  required="">
						</div>
						<div class="form-group">
							<label class="col-form-label">Password</label>
							<input type="password" class="form-control" placeholder=" " name="password"  required="">
							<input type="hidden" class="form-control" placeholder="" name="giaohang"  value="0">
						</div>
						
						
						<div class="right-w3l">
							<input type="submit" class="form-control" name="dangky" value="Đăng ký">
						</div>
					
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //modal -->
	<!-- //top-header -->
	
	
	<!-- header-bottom-->
	<div class="header-bot">
		<div class="container">
			<div class="row header-bot_inner_wthreeinfo_header_mid">
				<!-- logo -->
				<div class="col-md-3 logo_agile">
					<h1 class="text-center">
						<a href="index.php" class="font-weight-bold font-italic">
							<img style="width: 90px;" src="images/anhrong.jpg" alt=" " class="img-fluid">1     Prophet
						</a>
					</h1>
				</div>
				<!-- //logo -->
				<!-- header-bot -->
				<div class="col-md-9 header mt-4 mb-md-0 mb-4">
					<div class="row" style="flex-wrap:inherit !important">
						<!-- search -->
						<div class="col-10 agileits_search">
							<form class="form-inline" action="index.php?quanly=timkiem" method="POST">
								<input class="form-control mr-sm-2" name="search_product" type="search" placeholder="Tìm kiếm sản phẩm" aria-label="Search" required>
								<button class="btn my-2 my-sm-0" name="search_button" type="submit">Tìm kiếm</button>
							</form>
						</div>
						<!-- //search -->
						<!-- cart details -->
						<div class="">
							<div class="wthreecartaits wthreecartaits2 cart cart box_1" style="width:; display:flex">
							<a href="index.php?quanly=giohang"><button class="btn w3view-cart" type="submit" name="submit" value="">
										<i class="fas fa-cart-arrow-down"></i>
									</button></a>
								<form style="display:inline-block" action="#" method="post" class="last">
									<input type="hidden" name="cmd" value="_cart">
									<input type="hidden" name="display" value="1">
									
									
								  
									</button>
									<?php 
				if(isset($_SESSION['dangnhap_home'])){
					
					
					
				
				if($_SESSION['role']==1){
					echo '<div class="dn">
					
					<a><img src="./images/user.avif" width="50"></a>
					<div class="dn-child">
					<a href="#">Cập nhật thông tin</a>
					<br>
					<a href="index.php?quanly=xemdonhang">Xem đơn hàng</a>
					<br>
					<a href="./admin/index.php">Admin</a>
					<br>
					<a href="index.php?quanly=giohang&dangxuat=1">Đăng xuất</a>
					</div>
					</div>
					';
					
				} else {
					echo '<div class="dn">
					
					<a><img src="./images/user.avif" width="50"></a>
					<div class="dn-child">
					<a href="#">Cập nhật thông tin</a>
					<br>
					<a href="index.php?quanly=xemdonhang">Xem đơn hàng</a>
					<br>
					
					<a href="index.php?quanly=giohang&dangxuat=1">Đăng xuất</a>
					</div>
					</div>
					';
				}
				}else{
					echo '<button class="dn-hidden btn w3view-cart" type="submit" name="submit" value="">
					<a href="#" data-toggle="modal" data-target="#dangnhap" class="text-white">
						Đăng nhập
				  </a>';
					echo '<li class="text-center text-white">
					<a href="#" data-toggle="modal" data-target="#dangky" class="text-white">
						<i class="fas fa-sign-out-alt mr-2"></i>Đăng ký </a>
				</li>';
				}
				?>
								</form>
								
							</div>
						</div>
						<!-- //cart details -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- shop locator (popup) -->
	<!-- //header-bottom -->
	<!-- navigation -->