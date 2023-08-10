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

<?php
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    if (empty($name)) {
        $errors["name"] = "Vui lòng nhập tên";
    } elseif (preg_match('/[0-9]/', $name)) {
        $errors["name"] = "Tên không được chứa số";
    }

    if (empty($phone)) {
        $errors["phone"] = "Vui lòng nhập số điện thoại";
    } elseif (!preg_match('/^\d{10}$/', $phone)) {
        $errors["phone"] = "Số điện thoại phải gồm 10 số, không điền chữ cái và kí tự đặc biệt";
    }

    if (empty($address)) {
        $errors["address"] = "Vui lòng nhập địa chỉ";
    }

    if (empty($errors)) {
        echo '<div class="alert alert-success">Cập nhật thông tin thành công</div>';
    }
}
?>
<div class="container" style="display:flex">
<div style="display:flex;width:30%; margin-right:20px; margin-top:10px;flex-direction: column;" >
<div style="display:flex">
<a><img src="./images/user.avif" width="50"></a>
<h4 style="padding-left:20px;padding-top:5px"><?php echo $row_khachhang['name']?></h4>
</div>
<div style="margin-top:30px"><h5><a href="index.php?quanly=thongtin">Thông tin tài khoản</a></h5>
<br>
<h5><a style="" href="index.php?quanly=xemdonhang">Xem đơn hàng </a></h5>
</div>
</div>

<div style="width:60%; box-shadow: 0px 0px 10px 10px #e4e4e4; margin-top:30px">
<h2 style="margin-top:50px; margin-left:20px">Hồ sơ của tôi</h2>
<div style="margin:20px auto">
<form action="" method="post" class="m-4" enctype="multipart/form-data" id="updateForm">
    <div class="row">
        <div class="col-6">
            <label for="">Tên</label>
            <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $row_khachhang['name']; ?>">
            <?php if (isset($errors["name"])) { ?>
                <p class="text-danger"><?php echo $errors["name"]; ?></p>
            <?php } ?>
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" value="<?php echo $row_khachhang['email']; ?>" readonly>
            <label for="">Số điện thoại</label>
            <input type="text" class="form-control" name="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $row_khachhang['phone']; ?>">
            <?php if (isset($errors["phone"])) { ?>
                <p class="text-danger"><?php echo $errors["phone"]; ?></p>
            <?php } ?>
            <label for="">Địa chỉ</label>
            <input type="text" class="form-control" name="address" value="<?php echo isset($_POST['address']) ? $_POST['address'] : $row_khachhang['address']; ?>">
            <?php if (isset($errors["address"])) { ?>
                <p class="text-danger"><?php echo $errors["address"]; ?></p>
            <?php } ?>
        </div>
    </div>
    <br>
    <input type="submit" class="btn btn-warning" name="editProduct" value="Cập nhật hồ sơ">
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
