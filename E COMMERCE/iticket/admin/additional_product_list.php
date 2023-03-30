<?php include'session.php'; ?>
<?php
include '../db.php';
$sl=0;

$results=mysql_query("SELECT * FROM add_ons ");
while($data_array=mysql_fetch_assoc($results))
{
	print "<tr><td align=\"center\">".++$sl."</td><td>".$data_array['product_name']."</td> <td>".$data_array['product_price']."</td><td>".$data_array['vat']."</td><td>".$data_array['sd']."</td><td>".$data_array['product_size']."</td><td>".$data_array['brand']."</td><td>".$data_array['branch']."</td><td align=\"center\"><a href=\"delete_additional_product.php?id=".$data_array['id']."\" onclick=\"return confirm('Are you really want to delete ".$data_array['product_name']."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer;\"></a></td><td align=\"center\" style=\"font-size:10px;color:#00FFF7;\">"."<a onclick=\"smcollege('".$data_array['id']."');\">Edit</a>"."</td></tr>";
}

?>
