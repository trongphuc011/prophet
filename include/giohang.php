

<?php


 if(isset($_POST['themgiohang'])){
 	$tensanpham = $_POST['tensanpham'];
 	$sanpham_id = $_POST['sanpham_id'];
 	$hinhanh = $_POST['hinhanh'];
 	$gia = $_POST['giasanpham'];
 	$soluong = $_POST['soluong'];	
 	$sql_select_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 	$count = mysqli_num_rows($sql_select_giohang);
 	if($count>0){
 		$row_sanpham = mysqli_fetch_array($sql_select_giohang);
 		$soluong = $row_sanpham['soluong'] + 1;
 		$sql_giohang = "UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'";
 	}else{
 		$soluong = $soluong;
 		$sql_giohang = "INSERT INTO tbl_giohang(tensanpham,sanpham_id,giasanpham,hinhanh,soluong) values ('$tensanpham','$sanpham_id','$gia','$hinhanh','$soluong')";

 	}
 	$insert_row = mysqli_query($con,$sql_giohang);
 	// if($insert_row==0){
 	// 	header('Location:index.php?quanly=chitietsp&id='.$sanpham_id);	
 	// }đsvds

 }elseif(isset($_POST['capnhatsoluong'])){
	if (isset($_POST['product_id']) && is_array($_POST['product_id'])) {
 	for($i=0;$i<count($_POST['product_id']);$i++){
 		$sanpham_id = $_POST['product_id'][$i];
 		$soluong = $_POST['soluong'][$i];
 		if($soluong<=0){
 			$sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 		}else{
 			$sql_update = mysqli_query($con,"UPDATE tbl_giohang SET soluong='$soluong' WHERE sanpham_id='$sanpham_id'");
 		}
 	}
}

 }elseif(isset($_GET['xoa'])){
 	$id = $_GET['xoa'];
 	$sql_delete = mysqli_query($con,"DELETE FROM tbl_giohang WHERE giohang_id='$id'");

 }elseif(isset($_GET['dangxuat'])){
 	$id = $_GET['dangxuat'];
 	if($id==1){
 		unset($_SESSION['dangnhap_home']);
 	}

 
 }elseif(isset($_POST['thanhtoan'])){
 	$name = $_POST['name'];
 	$phone = $_POST['phone'];
 	$email = $_POST['email'];

 	$address = $_POST['address'];
 	$giaohang = $_POST['giaohang'];
 
 	$sql_khachhang = mysqli_query($con,"INSERT INTO tbl_khachhang(name,phone,email,address,giaohang) values ('$name','$phone','$email','$address','$giaohang')");
 	if($sql_khachhang){
 		$sql_select_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang ORDER BY khachhang_id DESC LIMIT 1");
 		$mahang = rand(0,9999);
 		$row_khachhang = mysqli_fetch_array($sql_select_khachhang);
 		$khachhang_id = $row_khachhang['khachhang_id'];
 		$_SESSION['dangnhap_home'] = $row_khachhang['name'];
 		$_SESSION['khachhang_id'] = $khachhang_id;
 		for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
	 		$sanpham_id = $_POST['thanhtoan_product_id'][$i];
	 		$soluong = $_POST['thanhtoan_soluong'][$i];
	 		$sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
	 		$sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
	 		$sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 		}

 	}
 }elseif(isset($_POST['thanhtoandangnhap'])){

 	$khachhang_id = $_SESSION['khachhang_id'];
 	$mahang = rand(0,9999);	
 	for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
	 		$sanpham_id = $_POST['thanhtoan_product_id'][$i];
	 		$soluong = $_POST['thanhtoan_soluong'][$i];
	 		$sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
	 		$sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
	 		$sql_delete_thanhtoan = mysqli_query($con,"DELETE FROM tbl_giohang WHERE sanpham_id='$sanpham_id'");
 		}

 	
 }
?>

<!-- checkout page -->
	<div class="privacy py-sm-5 py-4">
		<div class="container py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				Giỏ hàng của bạn
			</h3>
				
				
			<!-- //tittle heading -->
			<div class="checkout-right">
			<?php
			$sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");

			?>

				<div class="table-responsive">
					<form action="" method="POST">
					
					<table class="timetable_sub">
						<thead>
							<tr>
								<th>Thứ tự</th>
								<th>Sản phẩm</th>
								<th>Số lượng</th>
								<th>Tên sản phẩm</th>

								<th>Giá</th>
								<th>Giá tổng</th>
								<th>Quản lý</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i = 0;
						$total = 0;
						while($row_fetch_giohang = mysqli_fetch_array($sql_lay_giohang)){ 

							$subtotal = $row_fetch_giohang['soluong'] * $row_fetch_giohang['giasanpham'];
							$total+=$subtotal;
							$i++;
						?>
							<tr class="rem1">
								<td class="invert"><?php echo $i ?></td>
								<td class="invert-image">
									<a href="single.html">
										<img src="uploads/<?php echo $row_fetch_giohang['hinhanh'] ?>" alt=" "  class="img-responsive" style="width:200px; height:300px">
									</a>
								</td>
								<td class="invert">
									<input type="hidden" name="product_id[]" value="<?php echo $row_fetch_giohang['sanpham_id'] ?>">
									<input type="number" min="1" name="soluong[]" value="<?php echo $row_fetch_giohang['soluong'] ?>">
								
									
								</td>
								<td class="invert"><?php echo $row_fetch_giohang['tensanpham'] ?></td>
								<td class="invert"><?php echo number_format($row_fetch_giohang['giasanpham']).'vnđ' ?></td>
								<td class="invert"><?php echo number_format($subtotal).'vnđ' ?></td>
								<td class="invert">
									<a href="?quanly=giohang&xoa=<?php echo $row_fetch_giohang['giohang_id'] ?>">Xóa</a>
								</td>
							</tr>
							<?php
							} 
							?>
							<tr>
								<td colspan="7">Tổng tiền : <?php echo number_format($total).'vnđ' ?></td>

							</tr>
							<tr>
								<td colspan="7"><input type="submit" class="btn btn-primary" value="Cập nhật giỏ hàng" name="capnhatsoluong">
								<?php 
								$sql_giohang_select = mysqli_query($con,"SELECT * FROM tbl_giohang");
								$count_giohang_select = mysqli_num_rows($sql_giohang_select);

								if(isset($_SESSION['dangnhap_home']) && $count_giohang_select>0){
									while($row_1 = mysqli_fetch_array($sql_giohang_select)){
								?>
								
								<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_1['sanpham_id'] ?>">
								<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_1['soluong'] ?>">
								<?php 
							}
								?>
		
								<?php
								} 
								?>
								
								</td>
							
								</tr>
							</tbody>
						</table>
						<?php 

							if(isset($_POST["editProduct"])&&($_POST["editProduct"])){


								$name=$_POST["name"];
								$email=$_POST["email"];
								$phone=$_POST["phone"];
								$address=$_POST["address"];
								$sql_upload = mysqli_query($con, "UPDATE tbl_khachhang SET name='$name', email='$email', phone = '$phone', address='$address' WHERE khachhang_id = {$_SESSION['khachhang_id']}");



							}

								$sql_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang where khachhang_id = {$_SESSION['khachhang_id']}");
								
								while($row_khachhang = mysqli_fetch_array($sql_khachhang)){ 
							?>
						<div class="colorlib-product">
							<div class="container">
								<div class="row row-pb-lg">
								</div>
								<div class="row">
									<div class="col-lg-8">
										<form method="post" class="colorlib-form">
											<h2>Thông tin  <a href="index.php?quanly=thongtin" class="text-primary">(chỉnh sửa)</a> </h2>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="companyname">Tên của bạn</label>
														<input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $row_khachhang['name']; ?>" readonly>
														<?php if (isset($errors["name"])) { ?>
															<p class="text-danger"><?php echo $errors["name"]; ?></p>
														<?php } ?>
													</div>
										</div>

										<div class="col-md-12">
													<div class="form-group">
														<label for="fname">Địa chỉ</label>
														<input type="text" class="form-control" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $row_khachhang['address']; ?>" readonly>
														<?php if (isset($errors["address"])) { ?>
															<p class="text-danger"><?php echo $errors["address"]; ?></p>
														<?php } ?>
													</div>
											
										</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="email">Địa chỉ email</label>
														<input type="text" class="form-control" name="email" value="<?php echo $row_khachhang['email']; ?>" readonly>

													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="Phone">Số điện thoại</label>
														<input type="text" class="form-control" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $row_khachhang['phone']; ?>" readonly>
														<?php if (isset($errors["phone"])) { ?>
															<p class="text-danger"><?php echo $errors["phone"]; ?></p>
														<?php } ?>
													</div>
												</div>
									</div>
									<?php }?>
									</form>
									</div>

									<div class="col-lg-4">
										<div class="row">
											<div class="col-md-12">
												<div class="cart-detail">
													<h2>Thành tiền</h2>
													<h4>
													<?php echo number_format($total).'vnđ' ?>
													</h4>
												</div>
										</div>

										<div class="w-100"></div>

										<div class="col-md-12">
												<div class="cart-detail">
													<h2>Phương thức</h2>
													<div class="form-group">
														<div class="col-md-12">
															<div class="radio">
																<label><input type="radio" name="optradio" disabled>Thanh toán Banking</label>
															</div>
														</div>
													</div>
													<div class="form-group">
														<div class="col-md-12">
															<div class="radio">
																<label><input type="radio" name="optradio" checked> Thanh toán tiền mặt</label>
															</div>
														</div>
													</div>

												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12 text-center">
											<input type="submit" class="btn btn-primary" value="Thanh toán giỏ hàng" name="thanhtoandangnhap">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div id="page">
		
	</div>
			<!-- thông báo thanh toán thành công: -->
			<?php
				if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["thanhtoandangnhap"])) {
					echo '<div class="alert alert-success">Đặt hàng thành công</div>';
				}
			?>

			<?php
			if(!isset($_SESSION['dangnhap_home'])){ 
			?>
			<div class="checkout-left">
				<div class="address_form_agile mt-sm-5 mt-4">
					<h4 class="mb-sm-4 mb-3">Thêm địa chỉ giao hàng</h4>
					<form action="" method="post" class="creditly-card-form agileinfo_form">
						<div class="creditly-wrapper wthree, w3_agileits_wrapper">
							<div class="information-wrapper">
								<div class="first-row">
									<div class="controls form-group">
										<input class="billing-address-name form-control" type="text" name="name" placeholder="Điền tên" required="">
									</div>
									<div class="w3_agileits_card_number_grids">
										<div class="w3_agileits_card_number_grid_left form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Số phone" name="phone" required="">
											</div>
										</div>
										<div class="w3_agileits_card_number_grid_right form-group">
											<div class="controls">
												<input type="text" class="form-control" placeholder="Địa chỉ" name="address" required="">
											</div>
										</div>
									</div>
									<div class="controls form-group">
										<input type="text" class="form-control" placeholder="Email" name="email" required="">
									</div>
									
									<div class="controls form-group">
										<select class="option-w3ls" name="giaohang">
											<option>Chọn hình thức giao hàng</option>
											<option value="1">Thanh toán ATM</option>
											<option value="0">Nhận tiền tại nhà</option>
											

										</select>
									</div>
								</div>
								<?php
								$sql_lay_giohang = mysqli_query($con,"SELECT * FROM tbl_giohang ORDER BY giohang_id DESC");
								while($row_thanhtoan = mysqli_fetch_array($sql_lay_giohang)){ 
								?>
									<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $row_thanhtoan['sanpham_id'] ?>">
									<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $row_thanhtoan['soluong'] ?>">
								<?php
								} 
								?>
								<input type="submit" name="thanhtoan" class="btn btn-success" style="width: 20%" value="Thanh toán">
								
							</div>
						</div>
					</form>
					
				</div>
			</div>
			<?php
			} 
			?>
		</div>
	</div>
	
	<!-- //checkout page -->