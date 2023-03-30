<?php include'session.php'; ?>
<?php
include '../db.php';

$results=mysql_query("SELECT * FROM ticket_type ");


  while($data_array=mysql_fetch_row($results))
       {
           print "<tr><td align=\"center\">".$data_array[0]."</td><td>".$data_array[1]."</td><td align=\"center\"><a href=\"delete.bra2type.php?id=".$data_array[0]."\" onclick=\"return confirm('Are you really want to delete ".$data_array[1]."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer;\"></a></td></tr>";
       }

?>