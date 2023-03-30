<?php include'session.php'; ?>
<?php
include '../db.php';
$results=mysql_query("DELETE FROM ticket_type WHERE id = ".$_GET['id']." LIMIT 1");
print "<meta http-equiv=\"refresh\" content=\"0; url=type.php\" />";
//header( 'Location: about.php' ) ;
?>