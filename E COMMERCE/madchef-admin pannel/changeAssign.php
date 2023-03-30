<?php
include 'database.php';
session_start();
$id = $_GET['id'];
$change_status = $_GET['change_status'];
$update = mysqli_query($con,"UPDATE `order` SET  `order_status`='".$change_status."', `last_update_time` = NOW() WHERE `order_id`='".$id."'");
if ($update) {
	echo "Update Successfull!!";
}
?>