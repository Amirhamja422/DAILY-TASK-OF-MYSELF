<?php
include '../db.php';

$id = $_GET['id'];
$service = trim($_GET['service']);
$hour_time = $_GET['hour_time'];
$dept_id = $_GET['dept_id'];

if ((!empty($id)) && (!empty($service))) {

	$check = mysql_num_rows(mysql_query("SELECT * FROM `ticket_dev`.`ticket_type` WHERE `type_name`='".$service."' AND `group_id`='".$dept_id."'"));


	if ($check == 0) {
		
		$update = mysql_query("UPDATE `ticket_dev`.`ticket_type` SET `type_name`='".$service."' WHERE `id`='".$id."'");

		if ($update) {
			echo "Update Successfully!!";
		}

	} else {

		echo "Data Alreday In Database!!";

	}
	

} else if((!empty($id)) && (!empty($hour_time))){

	$update = mysql_query("UPDATE `ticket_dev`.`sub_group` SET `hour_time`='".($hour_time*3600)."' WHERE `id`='".$id."'");

	if ($update) {
		echo "Update Successfully!!";
	}
} else {

	echo "Field Can Not Blank!!";
}
