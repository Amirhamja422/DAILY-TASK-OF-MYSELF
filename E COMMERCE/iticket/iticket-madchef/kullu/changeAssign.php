<?php
include 'db.php';
session_start();
$id = $_GET['id'];

$change_assign = $_GET['change_assign'];
echo $change_status = $_GET['change_status'];

$data = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket` WHERE `id`='".$id."'"));

if ((!empty($id)) && ((!empty($change_assign)) || (!empty($change_status)))) {

    $update = mysql_query("UPDATE `ticket` SET `assignd`='".$_GET['change_assign']."', `status`='".$change_status."', `update_at` = NOW() WHERE `id`='".$id."'");

	$results=mysql_query("INSERT INTO `history` (`id`,`status`,`from`, `details`,`date`) VALUES ('$id','".$change_status."', '".$_SESSION['usr01937417227']."','".$data['details']."',NOW() )");

	if ($update) {
		echo "Update Successfull!!";
	}
}
