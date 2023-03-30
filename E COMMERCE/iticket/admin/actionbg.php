<?php include'session.php'; ?>
<?php
include '../db.php';

$results=mysql_query("UPDATE `ticket`.`theme` SET `url` = '".$_GET['q']."' WHERE `theme`.`id` = 1");

print "Theme Updated Successfully.";
  

?>