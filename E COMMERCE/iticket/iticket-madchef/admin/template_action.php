<?php include'session.php';
include '../db.php';
if(mysql_query("DELETE FROM template WHERE id = ".$_GET['id']." LIMIT 1")){
	$success="Record deleted Successfully..";
	echo "<script>window.location.replace('http://116.193.217.4:8089/iticket-bank/admin/template1.php?success=$success')</script>";

}else{
	$failed="record Can not be delete....try Again later...";
	echo "<script>window.location.replace('http://116.193.217.4:8089/iticket-bank/admin/template1.php?failed=$failed')</script>";

}

if (isset($_GET['update'])) {
	if (mysql_query("UPDATE `template` SET `title`=[value-2],`massage`=[value-3] WHERE $_GET['updateid']")) {
		$success="Record Updated Successfully..";
		echo "<script>window.location.replace('http://116.193.217.4:8089/iticket-bank/admin/template1.php?success=$success')</script>";

	}else{
		$failed="record Can not Update....try Again later...";
		echo "<script>window.location.replace('http://116.193.217.4:8089/iticket-bank/admin/template1.php?failed=$failed')</script>";
	}
}
// print "<meta http-equiv=\"refresh\" content=\"0; url=template1.php\" />";
?>