<?php 
include('topbar.php');
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


    
 