<?php 

if(isset($_POST["editProduct"])&&($_POST["editProduct"])){


    $name=$_POST["name"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $address=$_POST["address"];
    $sql_upload = mysqli_query($con, "UPDATE tbl_khachhang SET name='$name', email='$email', address='$address' WHERE khachhang_id = {$_SESSION['khachhang_id']}");



}

    $sql_khachhang = mysqli_query($con,"SELECT * FROM tbl_khachhang where khachhang_id = {$_SESSION['khachhang_id']}");
    
    while($row_khachhang = mysqli_fetch_array($sql_khachhang)){ 
?>
<div class="container" style="display:flex">
<div style="display:flex;width:30%; margin-right:20px; margin-top:10px;flex-direction: column;" >
<div style="display:flex">
<a><img src="./images/user.avif" width="50"></a>
<h4 style="padding-left:20px;padding-top:5px"><?php echo $row_khachhang['name']?><p>sửa hồ sơ</p></h4>
</div>
<div style="margin-top:30px"><h5><a href="index.php?quanly=thongtin">Tài khoản của tôi</a></h5>
<br>
<h5><a style="" href="index.php?quanly=xemdonhang">đơn mua</a></h5>
</div>
</div>

<div style="width:60%; box-shadow: 0px 0px 10px 10px #e4e4e4; margin-top:30px">
<h2 style="margin-top:50px; margin-left:20px">Hồ sơ của tôi</h2>
<div style="margin:20px auto">
<form action="" method="post" class="m-4" enctype="multipart/form-data">
        <div class="row">
            <div class="col-6">
                <label for="">Tên đăng nhập</label>
                <p><?php echo $row_khachhang['email'] ?></p>
                <label for="">Tên</label>
                <input type="text" class="form-control" name="name" value="<?php echo $row_khachhang['name'] ?>">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" value="<?php echo $row_khachhang['email'] ?>">
                <label for="">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="<?php echo $row_khachhang['phone'] ?>">
                <label for="">Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="<?php echo $row_khachhang['address'] ?>">

            </div>
            
                
            </div>
            <br>
            
            <input type="submit" class="btn btn-warning" name="editProduct" value="Cập nhật hồ sơ">
        </div>
    </form>
    </div>
</div>
</div>


<?php }?>

<style>
    .form-control {
        width:200px;
    }
</style>