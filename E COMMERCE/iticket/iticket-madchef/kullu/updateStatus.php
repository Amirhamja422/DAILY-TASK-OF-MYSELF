<?php
include '../db.php';

$id = $_GET['id'];
$service = $_GET['service'];

if ((!empty($id)) && (!empty($service))) {
	
	$update = mysql_query("UPDATE `ticket_dev`.`ticket_status` SET `status_name`='".$_GET['service']."' WHERE `id`='".$id."'");

	if ($update) {
		echo "Update Successfully!!";
	}
} else {

	echo "Field Can Not Blank!!";
}
