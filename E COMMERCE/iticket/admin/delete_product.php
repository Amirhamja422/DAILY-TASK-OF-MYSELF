<?php include'session.php'; ?>
<?php
include '../db.php';
$results=mysql_query("DELETE FROM product WHERE id = ".$_GET['id']." LIMIT 1");
print "<meta http-equiv=\"refresh\" content=\"0; url=add_product.php\" />";
//header( 'Location: about.php' ) ;
?>