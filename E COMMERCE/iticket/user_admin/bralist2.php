<?php
include '../db.php';

$results=mysql_query("SELECT `id`,`user_name`, (select group_name from user_group where user_group.id=users.user_group_id),previlege,superior_id,designation FROM `users` ");


  while($data_array=mysql_fetch_row($results))
       {
	   if($data_array[3]==0) {$pre="Administrator";}
	   if($data_array[3]==1) {$pre="Limited";}	
	   if($data_array[3]==2) {$pre="Only Report";}	   
           print "<tr><td align=\"center\">".$data_array[0]."</td><td>".$data_array[1]."</td><td style=\"font-size:10px;\">".$data_array[5]."</td><td style=\"font-size:10px;\">".$data_array[2]."</td><td style=\"font-size:10px;\">".$pre."</td>\"<td align=\"center\" style=\"font-size:10px;color:#0066CC;\">"."<a onclick=\"smcollege('".$data_array[0]."');\">Edit</a>"."</td><td align=\"center\"><a href=\"delete.bra2.php?id=".$data_array[0]."\" onclick=\"return confirm('Are you really want to delete ".$data_array[1]."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer; width:10px; height:10px;\"></a></td></tr>";
       }

?>