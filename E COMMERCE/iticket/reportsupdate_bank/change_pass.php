<?php
include '../db.php';
session_start();
if(isset($_POST['changepass'])){
	$pad_user = $_SESSION['id'];
	$oldpass = $_POST['oldpass'];
	$newpass = $_POST['newpass'];
	
	$count = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `id`='".$pad_user."' AND `user_pass`='".$oldpass."'"));
	
	if($count==1){
		
		$update = mysql_query("UPDATE `users` SET `user_pass` = '".$newpass."' WHERE `id`='".$pad_user."'");
		
		if($update){
			$_SESSION['msg'] = "Password Update Successful.";
			echo "<script>window.location.replace('index.php')</script>";
		}
		
	} else {
		
		$_SESSION['err'] = "Old Password Not Match!";
		echo "<script> window.location.replace('index.php')
                          </script>";
		
	}	
}
?>