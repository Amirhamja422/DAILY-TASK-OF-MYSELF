<?php
$q1 = $_GET['q1'];
$q2 = $_GET['q2'];
$q3 = $_GET['q3'];
$q4 = $_GET['q4'];


include '../../db.php';
$results=mysql_query("DELETE FROM `ticket_dev`.`ticket` WHERE `ticket`.`id` = ".$_GET['id']." LIMIT 1");
print "<meta http-equiv=\"refresh\" content=\"0; url=update.php?q1=$q1&q2=$q2&q3=$q3&q4=$q4\" />";
//header( 'Location: about.php' ) ;
?>