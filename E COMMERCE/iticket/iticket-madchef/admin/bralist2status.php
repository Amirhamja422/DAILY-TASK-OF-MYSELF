<?php include'session.php'; ?>
<?php
include '../db.php';

$results=mysql_query("SELECT * FROM ticket_status ");


  while($data_array=mysql_fetch_row($results))
       {
           print "<tr><td align=\"center\">".$data_array[0]."</td><td class=\"pt-3-half\" contenteditable=\"true\" service_id=\"".$data_array[0]."\" id=\"service".$data_array[0]."\" onkeyup=\"update_service(this);\">".$data_array[1]."</td><td align=\"center\"><a href=\"delete.bra2status.php?id=".$data_array[0]."\" onclick=\"return confirm('Are you really want to delete ".$data_array[1]."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer;\"></a></td></tr>";

           // print "<tr><td align=\"center\">".$data_array[0]."</td><td>".$data_array[1]."</td><td align=\"center\" style=\"font-size:10px;color:#0066CC; cursor:pointer;\">"."<a onclick=\"editStatus('".$data_array[0]."');\">Edit</a>"."</td><td align=\"center\"><a href=\"delete.bra2status.php?id=".$data_array[0]."\" onclick=\"return confirm('Are you really want to delete ".$data_array[1]."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer;\"></a></td></tr>";
       }

?>