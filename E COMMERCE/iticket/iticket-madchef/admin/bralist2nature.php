<?php include'session.php'; ?>
<?php
include '../db.php';

$results=mysql_query("SELECT * FROM nature_complaint");

  while($data_array=mysql_fetch_row($results))
       {
          $type = mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$data_array[2]."'"));

           print "<tr>
           <td align=\"center\">".$data_array[0]."</td>
           <td>".$type[1]."</td><td class=\"pt-3-half\" contenteditable=\"true\" dept_id=\"".$data_array[3]."\" service_id=\"".$data_array[0]."\" id=\"service".$data_array[0]."\" onkeyup=\"update_service(this);\">".$data_array[1]."</td>   

           <td align=\"center\"><a href=\"delete.bra2nature.php?id=".$data_array[0]."\" onclick=\"return confirm('Are you really want to delete ".$data_array[1]."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer;\"></a></td></tr>";
       }

?>