<?php
include('../db/connect.php');
$sql_donhang = mysqli_query($con,"SELECT * FROM tbl_donhang,tbl_sanpham WHERE tinhtrang = 1 AND tbl_donhang.sanpham_id=tbl_sanpham.sanpham_id");
$tong_thang = array_fill(1, 12, 0); // Mảng để lưu tổng doanh thu của từng tháng

while ($row_donhang = mysqli_fetch_array($sql_donhang)) {
    $thang_dat = date("n", strtotime($row_donhang['ngaythang'])); // Lấy tháng từ ngày đặt hàng
    $doanh_thu_thang = $row_donhang['soluong'] * $row_donhang['sanpham_giakhuyenmai'];

    $tong_thang[$thang_dat] += $doanh_thu_thang;
}

echo '<div class="btk">';
echo '<div class="thang">';
for ($i = 1; $i <= 12; $i++) {
    echo "<div>";
    echo "<p style='margin:20px 40px'>$i</p>";
    echo "<p  style='margin:0px 40px'>" . number_format($tong_thang[$i]) . 'vnđ</p>';
    echo "</div>"; 
}
echo '</div>';
echo "<div class='tongtien'>";
$total_revenue = array_sum($tong_thang); // Tính tổng doanh thu của 12 tháng
echo "<p>Tổng doanh thu 12 tháng: " . number_format($total_revenue) . 'vnđ</p>';
echo "</div>";
echo '</div>';

?>






<style>
    .btk {
        display: flex;
        flex-direction: column;
    }
    .thang {
        display: flex;
    }
    .tongtien {
        margin-top:20px;
        margin-left: 20px;
    }
</style>





