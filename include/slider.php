<div id="slider">
                <div class="slides">
                    <input type="radio" name="radio-btn" id="radio1">
                    <input type="radio" name="radio-btn" id="radio2">
                    <input type="radio" name="radio-btn" id="radio3">
                    <input type="radio" name="radio-btn" id="radio4">

<?php 
$sql_slider =  mysqli_query($con,"SELECT * FROM tbl_slider Where slider_active='1' ORDER BY slider_id");
	foreach($sql_slider as  $index=>  $slider){
		echo '<div class="slide-items first"><img src='.$slider['slider_image'].' alt="" " ></div>';

	}
?>

                    




                </div>
                <div class="navigation-manual">
                    <label for="radio1" class="manual-btn"></label>
                    <label for="radio2" class="manual-btn"></label>
                    <label for="radio3" class="manual-btn"></label>
                    <label for="radio4" class="manual-btn"></label>
                </div>

               
            </div>