<?php
include '../db.php';
//for notice



if (isset($_REQUEST['quiz_deactivate_id'])) {
	$user_deactivate_id = $_REQUEST['quiz_deactivate_id'];
	$sql = "UPDATE `product` SET status = '0' WHERE `id` = ". $user_deactivate_id;
	$result_del_uer =  mysql_query($sql);
	if($result_del_uer){
		echo "Deactivate Successfully";
	}else{
		echo "Not Deactivate";
	}
}

if (isset($_REQUEST['quiz_activate_id'])) {
	$user_activate_id = $_REQUEST['quiz_activate_id'];
	$sql = "UPDATE `product` SET status = '1' WHERE `id` = ". $user_activate_id;
	$result_del_uer =  mysql_query($sql);
	if($result_del_uer){
		echo "Activate Successfully";
	}else{
		echo "Not Activate";
	}
}





?>
