<?php include'session.php'; ?>
<?php
include '../db.php';

$results=mysql_query("SELECT * FROM sub_group ORDER BY id DESC");

  while($data_array=mysql_fetch_row($results))
       {
       		$group = mysql_fetch_row(mysql_query("SELECT * FROM `user_group` WHERE `id`='".$data_array[1]."'"));
       		$ticket = mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$data_array[2]."'"));
           	print "<tr><td align=\"center\">".$data_array[0]."</td><td>".$group[1]."</td><td>".$ticket[1]."</td><td class=\"pt-3-half\" contenteditable=\"true\" service_id=\"".$data_array[0]."\" id=\"service".$data_array[0]."\" onkeyup=\"update_service(this);\">".$data_array[3]."</td><td class=\"pt-3-half\" contenteditable=\"true\" id=\"hour_time".$data_array[0]."\" onkeyup=\"update_hour_time('".$data_array[0]."');\">".($data_array[4]/3600)
           ."</td><td align=\"center\"><a href=\"delete.bra2sub.php?id=".$data_array[0]."\" onclick=\"return confirm('Are you really want to delete ".$data_array[1]."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer;\"></a></td></tr>";
       }

?>