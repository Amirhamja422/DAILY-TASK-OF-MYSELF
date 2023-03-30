<?php
//include '../db.php';

$allData = mysql_query("SELECT * FROM `ticket` WHERE `stat`='0'");

	$create = strtotime($row['date']);
	$today = strtotime(date('Y-m-d H:i:s'));
	echo $timestamp = strtotime($today) + 3600;
	$calculation = $today - $create;

while($row = mysql_fetch_array($allData)){
	
	$create = strtotime($row['date']);
	$today = strtotime(date('Y-m-d H:i:s'));
	$timestamp = strtotime($create) + 3600;
	$calculation = $today - $create;
	
	if(($calculation >= 2700) && ($row['stat'] == '0')){
		
		mysql_query("UPDATE `ticket` SET `status`='Pending', `stat`='1' WHERE `stat`='0' AND `id`='".$row['id']."'");
		
	}
	
	
}

?>