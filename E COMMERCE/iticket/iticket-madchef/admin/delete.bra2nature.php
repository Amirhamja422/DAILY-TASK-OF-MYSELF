<?php include'session.php'; ?>
<?php
include '../db.php';
$results=mysql_query("DELETE FROM nature_complaint WHERE id = ".$_GET['id']." LIMIT 1");
print "<meta http-equiv=\"refresh\" content=\"0; url=nature.php\" />";
//header( 'Location: about.php' ) ;
?>