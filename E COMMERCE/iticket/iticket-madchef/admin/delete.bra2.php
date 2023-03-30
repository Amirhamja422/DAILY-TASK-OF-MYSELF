<?php
include '../db.php';
$results=mysql_query("DELETE FROM `ticket_dev`.`users` WHERE `users`.`id` = ".$_GET['id']." LIMIT 1");
print "<meta http-equiv=\"refresh\" content=\"0; url=index.php\" />";
//header( 'Location: about.php' ) ;
?>