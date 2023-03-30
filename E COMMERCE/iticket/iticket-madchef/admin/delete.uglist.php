<?php include'session.php'; ?>
<?php
include '../db.php';
$results=mysql_query("DELETE FROM `ticket_dev`.`user_group` WHERE `id` = ".$_GET['id']." LIMIT 1");
print "<meta http-equiv=\"refresh\" content=\"0; url=ug.php\" />";
?>