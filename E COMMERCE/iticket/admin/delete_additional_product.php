<?php include'session.php'; ?>
<?php
include '../db.php';
$results=mysql_query("DELETE FROM add_ons WHERE id = ".$_GET['id']." LIMIT 1");
print "<meta http-equiv=\"refresh\" content=\"0; url=additional_product.php\" />";
//header( 'Location: about.php' ) ;
?>