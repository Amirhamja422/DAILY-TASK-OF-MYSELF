<?php include'session.php'; ?>
<?php

include '../db.php';

$results=mysql_query("SELECT * FROM `user_group` ");


  while($data_array=mysql_fetch_row($results))
       {
           print "<tr><td align=\"center\">".$data_array[0]."</td><td contenteditable=\"true\" dept_id=\"".$data_array[0]."\" id=\"dept_id".$data_array[0]."\" onkeyup=\"update_dept(".$data_array[0].");\">".$data_array[1]."</td><td align=\"center\" style=\"font-size:10px;color:#0066CC;\">"."<a href=\"delete.uglist.php?id=".$data_array[0]."\" onclick=\"return confirm('Are you really want to delete ".$data_array[1]."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer; width:10px; height:10px;\"></a>"."</td></tr>";
       }

?>
