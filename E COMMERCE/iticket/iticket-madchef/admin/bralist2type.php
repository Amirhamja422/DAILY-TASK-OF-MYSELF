<?php include'session.php'; ?>
<?php
include '../db.php';

$results=mysql_query("SELECT * FROM ticket_type");
// function secondsToTime($seconds) {
//     $dtF = new \DateTime('@0');
//     $dtT = new \DateTime("@$seconds");
    // return $dtF->diff($dtT)->format('%a days %h:%i:%s');
//     return $dtF->diff($dtT)->format('%i:%s');
// }

  while($data_array=mysql_fetch_row($results))
       {
       		$group = mysql_fetch_row(mysql_query("SELECT * FROM `user_group` WHERE `id`='".$data_array[3]."'"));
			$name = mysql_fetch_row(mysql_query("SELECT * FROM `users` WHERE `user_group_id`='".$data_array[3]."' AND `concern`='".$data_array[0]."'"));

           print "<tr>
           <td align=\"center\">".$data_array[0]."</td>
           <td>".$group[1]."</td><td class=\"pt-3-half\" contenteditable=\"true\" dept_id=\"".$data_array[3]."\" service_id=\"".$data_array[0]."\" id=\"service".$data_array[0]."\" onkeyup=\"update_service(this);\">".$data_array[1]."</td><td align=\"center\"><a href=\"delete.bra2type.php?id=".$data_array[0]."\" onclick=\"return confirm('Are you really want to delete ".$data_array[1]."');\"><img src=\"idebnath/remove.png\" style=\"cursor:pointer;\"></a></td></tr>";
       }

?>