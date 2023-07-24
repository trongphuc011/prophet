<?php
	$category = mysqli_query($con,"SELECT * FROM tbl_category ORDER BY category_id DESC");
	$products = mysqli_query($con,"SELECT * FROM tbl_sanpham ORDER BY sanpham_id DESC");

	echo '<div class="section-title product__discount__title">
                            
			<h2 style="margin-top:30px;">laptop</h2>


		</div>';
		echo'<div style="display:flex; flex-wrap:wrap; flex-wrap:wrap; margin-bottom:40px; width:80vw;">';
			
				foreach($products as  $index=>  $product){
					if($product['category_id']==1){
					echo 
					'<div class="ds" style=" width: 25%; margin-bottom:20px;">
				   <div style="text-align:center; margin-bottom:20px;">
				   <form action="" method="post">
				   <a href="index.php?act=chitietsp&ma_hh='.$product['sanpham_id'].'"><img src="uploads/'.$product['sanpham_image'].'" alt="" width="300px" height="400px" ></a>
					<p>'.$product['sanpham_name'].'</p>
			   
				   <p>Giá: '.$product['sanpham_gia'].' vnđ</p>
				   <input class="buy" type="submit" name="mua" id="" value="Mua ngay" >
				   <input type="hidden" name="index" value="'.$index.'">
		
					   </form>
				   </div>
					</div>';
				}
				
				

				
			
			}
			
			echo '</div>';

	

					?>

<style>
	h2{
    margin-bottom:40px;
    margin-left:30px;
    font-size:28px;
    border-bottom:solid 4px black; 
    display:inline-block;
    padding-bottom:6px;
    color:black;

}

.buy {
    background:black;
    padding: 10px 16px;
    color:white;
    cursor: pointer;
    margin-top: 4px;
}

p {
    margin:4px 0;
}
.giohang{
display: inline-block;
position: relative;
}
</style>


