<?php include'session.php'; ?>
<?php
include '../db.php';
$sl=0;

$results=mysql_query("SELECT * FROM product ORDER BY id DESC");


while($data_array=mysql_fetch_row($results))
{
	print "<tr><td align=\"center\">".++$sl."</td><td>".$data_array[1]."</td> <td>".$data_array[2]."</td><td>10%</td><td>".$data_array[10]." % </td><td>".$data_array[4]."</td><td>".$data_array[11]."</td><td>".$data_array[6]."</td><td>".$data_array[7]."</td><td align=\"center\"><a href=\"delete_product.php?id=".$data_array[0]."\" onclick=\"return confirm('Are you really want to delete ".$data_array[1]."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer;\"></a></td><td align=\"center\" style=\"font-size:10px;color:#00FFF7;\">"."<a onclick=\"smcollege('".$data_array[0]."');\">Edit</a>"."</td></tr>";
}

?>
