<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["thanhtoandangnhap"])) {
	echo '<div class="alert alert-success">Đặt hàng thành công</div>';

	
}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["thanhtoan"])) {
	echo '<div class="alert alert-success">Đặt hàng thành công</div>';

	
}

// session_destroy();

if(isset($_GET['increase'])){
	$index = $_GET['increase'];

	if($_SESSION['giohang'][$index]['sanpham_soluong']>1){
		$_SESSION['giohang'][$index]['sanpham_soluong']-= 1;
		
		
	}
	
}
if(isset($_GET['decrease'])){
	$index = $_GET['decrease'];

	$_SESSION['giohang'][$index]['sanpham_soluong']+= 1;
	
}

if(isset($_GET['del'])){
	if($_GET['del']=='all'){
		unset($_SESSION['giohang']);
		header("location:sanpham.php");
	} else {
		$index=$_GET['del'];
		unset($_SESSION['giohang'][$index]);
	  
	}
} 
elseif(isset($_POST['capnhatsoluong'])){
	if (isset($_POST['product_id']) && is_array($_POST['product_id'])) {
 	for($i=0;$i<count($_POST['product_id']);$i++){
 		$sanpham_id = $_POST['product_id'][$i];
 		$soluong = isset($_POST['soluong'][$i]) ? $_POST['soluong'][$i] : 1;
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
 		
 		$_SESSION['khachhang_id'] = $khachhang_id;
 		if (isset($_POST['thanhtoan_product_id']) && is_array($_POST['thanhtoan_product_id'])) {
			for ($i = 0; $i < count($_POST['thanhtoan_product_id']); $i++) {
				$sanpham_id = $_POST['thanhtoan_product_id'][$i];
				$soluong = $_POST['thanhtoan_soluong'][$i];
	 		$sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
	 		$sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
	 	
 		}

 	}}
 }elseif(isset($_POST['thanhtoandangnhap'])){

 	$khachhang_id = $_SESSION['khachhang_id'];
 	$mahang = rand(0,9999);	
 	for($i=0;$i<count($_POST['thanhtoan_product_id']);$i++){
	 		$sanpham_id = $_POST['thanhtoan_product_id'][$i];
	 		$soluong = $_POST['thanhtoan_soluong'][$i];
	 		$sql_donhang = mysqli_query($con,"INSERT INTO tbl_donhang(sanpham_id,khachhang_id,soluong,mahang) values ('$sanpham_id','$khachhang_id','$soluong','$mahang')");
	 		$sql_giaodich = mysqli_query($con,"INSERT INTO tbl_giaodich(sanpham_id,soluong,magiaodich,khachhang_id) values ('$sanpham_id','$soluong','$mahang','$khachhang_id')");
	 		
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
			
							
						if(isset($_SESSION['giohang']))  foreach($_SESSION['giohang']  as $index => $item){ 
							if (isset($_SESSION['giohang'][$index]['sanpham_gia'])) {
								$gia_san_pham = $item['sanpham_gia'];
							} else {
								// Xử lý nếu key không tồn tại trong mảng
							}
								$subtotal = $item['sanpham_soluong'] * $gia_san_pham;
								$total+=$subtotal;
								$i++;
							?>
								<tr class="rem1">
									<td class="invert"><?php echo $i ?></td>
									<td class="invert-image">
										<a href="single.html">
											<img src="uploads/<?php echo $item['sanpham_image'] ?>" alt=" "  class="img-responsive" style="width:200px; height:300px">
										</a>
									</td>
									<td class="invert">
										<input type="hidden" name="product_id[]" value="<?php echo $item['sanpham_id'] ?>">
										<p style="align-center:center;"><a style="    text-decoration: none;" href ="?quanly=giohang&increase=<?php echo $index?>">-</a> <?php echo $item['sanpham_soluong']?><a style="    text-decoration: none;" href ="?quanly=giohang&decrease=<?php echo $index?>">+</a></p>
										<input type="hidden" name="thanhtoan_product_id[]" value="<?php echo $item['sanpham_id'] ?>">
									<input type="hidden" name="thanhtoan_soluong[]" value="<?php echo $item['sanpham_soluong'] ?>">
										
									</td>
									<td class="invert"><?php echo $item['sanpham_name'] ?></td>
									<td class="invert"><?php echo number_format($item['sanpham_gia']).'vnđ' ?></td>
									<td class="invert"><?php echo number_format($subtotal).'vnđ' ?></td>
									
									
										<td><a class="xoa" href="?quanly=giohang&del=<?php echo $index ?>">Xóa</a></td>
									</td>
								</tr>
								<?php
								} 
								?>
								<tr>
									<td colspan="7">Tổng tiền : <?php echo number_format($total).'vnđ' ?></td>

								</tr>
								<tr>
									<td colspan="7">
									<?php 
									$sql_giohang_select = mysqli_query($con,"SELECT * FROM tbl_giohang");
									$count_giohang_select = mysqli_num_rows($sql_giohang_select);

									

									if(isset($_SESSION['dangnhap_home']) && count($_SESSION['giohang'])>0){

										
										
									?>
									<input type="submit" class="btn btn-primary" value="Thanh toán giỏ hàng" name="thanhtoandangnhap">
									
									<?php
									} 
									?>
									
									</td>
								
								</tr>
							</tbody>
						</table>
					
					</form>
				</div>
			</div>
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
	<!-- thông báo thanh toán thành công: -->
			<?php
         
           ?>
	<!-- //checkout page -->

	