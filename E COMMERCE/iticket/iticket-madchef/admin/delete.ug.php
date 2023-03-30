<?php include'session.php'; ?>
<?php
include '../db.php';
$results=mysql_query("DELETE FROM `ticket`.`user_group` WHERE `user_group`.`id` = ".$_GET['id']." LIMIT 1");
print "<meta http-equiv=\"refresh\" content=\"0; url=ug.php\" />";
//header( 'Location: about.php' ) ;
?>