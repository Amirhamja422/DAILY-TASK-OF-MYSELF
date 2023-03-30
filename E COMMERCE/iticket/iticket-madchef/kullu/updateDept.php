<?php
include '../db.php';

$id = $_GET['id'];
$dept_id = $_GET['dept_id'];

if ((!empty($id)) && (!empty($dept_id))) {
	
	$update = mysql_query("UPDATE `ticket_dev`.`user_group` SET `group_name`='".$_GET['dept_id']."' WHERE `id`='".$id."'");

	if ($update) {
		echo "Update Successfully!!";
	}
} else {

	echo "Field Can Not Blank!!";
}
