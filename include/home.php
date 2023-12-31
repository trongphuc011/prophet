<?php
include('include/slider.php');
function connectDB($sql){
	//Kết nối database
	$servername = "localhost";
	$username = "root";
	$password = "";

	try {
	  
	$conn = new PDO("mysql:host=$servername;dbname=bandienmay", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   //  echo "Connected successfully";
	$stmt = $conn->prepare("SELECT * FROM tbl_sanpham");
	$stmt->execute();

	// set the resulting array to associative
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	$products=$stmt->fetchAll();
	return $products;
   } catch(PDOException $e) {
	   echo "Connection failed: " . $e->getMessage();
	   }
   }

// Check if the session is not started, then start it

if(!isset($_SESSION['giohang'])) $_SESSION['giohang'] = array();


// Check if the 'themgiohang' form was submitted



?>
<!-- top Products -->
<div class="ads-grid py-sm-5 py-4">
		<div class="py-xl-4 py-lg-2">
			<!-- tittle heading -->
			<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3">
				<h3 class="tittle-w3l text-center mb-lg-5 mb-sm-4 mb-3"></h3>
			<!-- //tittle heading -->
			<div class="row  m-0 p-0">
				<!-- product left -->
				<div class="agileinfo-ads-display col-lg-9">
					<div class="wrapper">
						<?php
						$sql_cate_home = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC");
						
						?>
						<!-- first section -->
						<div class="product-sec1 px-sm-4 px-3 py-sm-5  py-3 mb-4">
						<h2 style="margin-top:30px;" ><?php echo 'Tất cả sản phẩm' ?>
							<div class="row">
								<?php
								$sql_product = connectDB("SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC");
								
								foreach($sql_product as  $index=> $row_sanpham){
									
									
								?>
								
								<div class="col-md-3 product-men mt-5">
									<div class="men-pro-item simpleCart_shelfItem">
										<div class="men-thumb-item  text-center">
											<img style="width: 100%; height:400px;" src="./uploads/<?php echo $row_sanpham['sanpham_image'] ?>" alt="">
											<div class="men-cart-pro">
												<div class="inner-men-cart-pro ">
													<a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>" class="link-product-add-cart ">Xem sản phẩm</a>
												</div>
											</div>
										</div>
										<div class="item-info-product text-center border-top mt-4">
											<h4 class="pt-1">
												<a href="?quanly=chitietsp&id=<?php echo $row_sanpham['sanpham_id'] ?>" style="display: inline-block;
            width: 200px; /* Độ rộng tùy ý */
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;"><?php echo $row_sanpham['sanpham_name'] ?></a>
											</h4>
											<div class="info-product-price my-2">
												<span class="item_price"><?php echo number_format($row_sanpham['sanpham_giakhuyenmai']).'vnđ' ?></span>
												<del><?php echo number_format($row_sanpham['sanpham_gia']).'vnđ' ?></del>
											</div>
											<div class="snipcart-details top_brand_home_details item_add single-item hvr-outline-out">
												
											<form action="" method="post">
													<input type="hidden" name="tensanpham" value="<?php echo $row_sanpham['sanpham_name'] ?>" />
													<input type="hidden" name="sanpham_id" value="<?php echo $row_sanpham['sanpham_id'] ?>" />
													<input type="hidden" name="giasanpham" value="<?php echo $row_sanpham['sanpham_gia'] ?>" />
													<input type="hidden" name="hinhanh" value="<?php echo $row_sanpham['sanpham_image'] ?>" />
													<input type="hidden" name="soluong" value="1" />			
													<input type="hidden" name="index" value="<?php echo $index ?>">
    <input class="buy" type="submit" name="themgiohang" value="Thêm giỏ hàng"  />
															
													</form>	
											
											</div>
										</div>
									</div>
								</div>
								<?php
									
								} 
								?>
							</div>
						</div>
						<!-- //first section -->
						
						
					</div>
				</div>

				<?php 
				if (isset($_POST['themgiohang']) && $_POST['themgiohang']) {
					if (isset($_POST['index'])) {
						$index = $_POST['index'];
						
						
						
						
						array_push($_SESSION['giohang'], $sql_product[$index]);
					}
				}
				?>
				<!-- //product left -->

				<!-- product right -->
				<div class="col-lg-3 mt-lg-0 mt-4 p-lg-0">
					<div class="side-bar p-sm-4 p-3">
						<div class="search-hotel border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Tìm kiếm</h3>
							<form action="#" method="post">
								<input type="search" placeholder="Sản phẩm..." name="search" required="">
								<input type="submit" value=" ">
							</form>
						</div>
						<!-- price -->
						<div class="range border-bottom py-2">
							<h3 class="agileits-sear-head mb-3">Giá</h3>
							<div class="w3l-range">
								<ul>
									<li>
										<a href="#">Dưới 1 triệu</a>
									</li>
									
								</ul>
							</div>
						</div>
						<!-- //price -->
						
						<!-- reviews -->
						<div class="customer-rev border-bottom left-side py-2">
							<h3 class="agileits-sear-head mb-3">Khách hàng Review</h3>
							<ul>
								<li>
									<a href="#">
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<i class="fas fa-star"></i>
										<span>5.0</span>
									</a>
								</li>
								
							</ul>
						</div>
						<!-- //reviews -->
						<!-- electronics -->
						<div class="left-side border-bottom py-2">

							<h3 class="agileits-sear-head mb-3">Danh mục sản phẩm</h3>
							<ul>
								<?php 
									$sql_category_sidebar = mysqli_query($con,'SELECT * FROM tbl_category ORDER BY category_id DESC');
									while($row_category_sidebar = mysqli_fetch_array($sql_category_sidebar)){
								?>
								<li>
									<!-- <input type="checkbox" class="checked"> -->
									<span class="span"><a href="danhmucsanpham.php?id=<?php echo $row_category_sidebar['category_id'] ?>"><?php echo $row_category_sidebar['category_name'] ?></a></span>
								</li>
								<?php
								} 
								?>
							</ul>
						</div>
						<!-- //electronics -->
					
						
						<!-- best seller -->
						<div class="f-grid py-2">
							<h3 class="agileits-sear-head mb-3">Sản phẩm bán chạy</h3>
							<div class="box-scroll">
								<div class="scroll">
									<?php
									$sql_product_sidebar = mysqli_query($con,"SELECT * FROM tbl_sanpham WHERE sanpham_hot='0' ORDER BY sanpham_id DESC"); 
									while($row_sanpham_sidebar = mysqli_fetch_array($sql_product_sidebar)){
									?>
									<div class="row">
										<div class="col-lg-3 col-sm-2 col-3 left-mar">
											<img src="uploads/<?php echo $row_sanpham_sidebar['sanpham_image'] ?>" alt="" class="img-fluid">
										</div>
										<div class="col-lg-9 col-sm-10 col-9 w3_mvd">
											<a href=""><?php echo $row_sanpham_sidebar['sanpham_name'] ?></a>
											<a href="" class="price-mar mt-2"><?php echo number_format($row_sanpham_sidebar['sanpham_giakhuyenmai']).'vnđ' ?></a>
											<del><?php echo number_format($row_sanpham_sidebar['sanpham_gia']).'vnđ' ?></del>
										</div>
									</div>
									<?php
									} 
									?>
									
									
								</div>
							</div>
						</div>
						<!-- //best seller -->
					</div>
					<!-- //product right -->
				</div>
			</div>
		</div>
	</div>

	<?php 
		if (isset($_SESSION['giohang'])){
			
		} else {
			echo 'ko';
		}
	?>
	<!-- //top products -->