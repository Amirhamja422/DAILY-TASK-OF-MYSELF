<?php include'session.php'; ?>
<?php
include '../db.php';
$results=mysql_query("DELETE FROM sub_group WHERE id = ".$_GET['id']." LIMIT 1");
print "<meta http-equiv=\"refresh\" content=\"0; url=sub_type.php\" />";
//header( 'Location: about.php' ) ;
?>