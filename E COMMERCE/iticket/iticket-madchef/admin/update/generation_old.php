
<?php
include '../../db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 



$q1 = $_GET['q1'];
$q2 = $_GET['q2'];
$q3 = $_GET['q3'];
$q4 = $_GET['q4'];



$results=mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', `assignd` as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name',  `cus_product` as 'Product Details',   `date` as 'Create Date', `hour_time` as 'SLA', `status` AS 'Status', `stat` AS 'STAT', `assignd` AS 'ASS_ID'  FROM `ticket_dev`.`ticket` WHERE ".$q3." like '%".$q4."%' AND date >='".$q1." 00:00:00'  AND date <='".$q2." 23:59:59' ORDER BY `ticket`.`id` DESC");

$num_rows = mysql_num_rows($results);
?>



<?php
print "<div align=\"center\" class=\"datagrid\" style=\"width:99%; height:auto; overflow:auto;\">";
print "<table class=\"anlepore\">";
print "<thead align=\"center\"><tr><th>ID</th><th>TYPE</th><th>Raised</th><th>Assigned</th><th>Contact</th><th>Name</th><th>Create Date</th><th>Status</th><th>SLA (Hours)</th><th title=\"UPDATE\"><img src=\"update/update.png\" width=\"20\" height=\"20\"></th></tr></thead>";

$agent = mysql_query("SELECT * FROM `ticket_dev`.`users`");


$i=0;
$opt = ' ';
$assignd = '';
print "<tbody align=\"center\">";
while($data_array=mysql_fetch_row($results))
{   // loop Start
  
  $assignd = $data_array[3];
  $history_last = mysql_fetch_assoc(mysql_query("SELECT * FROM `history` WHERE `id`='".$data_array[0]."' ORDER BY `date` DESC LIMIT 1"));
  $history_first = mysql_fetch_assoc(mysql_query("SELECT * FROM `history` WHERE `id`='".$data_array[0]."' ORDER BY `date` ASC LIMIT 1"));
  $history_count = mysql_num_rows(mysql_query("SELECT * FROM `history` WHERE `id`='".$data_array[0]."'"));
  
  
  $create = strtotime($data_array[7]);
  $today = strtotime(date('Y-m-d H:i:s'));
  $calculation = $today - $create;
  $exit = $data_array[8];
  $tat = number_format((($calculation/60)/60), 2, '.', '');
  
  if (($calculation > $exit) && ($data_array[9] != 'Solved')) { 
    $res = "Time Over Not Solve"; 
    $tr  = "<tr style=\"background-color: #EC981F;\">";
    $tr2  = "<tr class=\"altav\" style=\"background-color: #EC981F;\">";
  } else if(($calculation > $exit) && ($data_array[9] == 'Solved')) {
    $res = "Time Over And Solve"; 
    $tr  = "<tr style=\"background-color: #789CFA;\">";
    $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
  } else if($data_array[9] == 'Solved'){
    $res = "Solve On Time"; 
    $tr  = "<tr style=\"background-color: #789CFA;\">";
    $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
  }
  else { 
    $res = "On Process"; 
    $tr  = "<tr>";
    $tr2  = "<tr class=\"altav\">";
  }
  

    while ($agent_row = mysql_fetch_assoc($agent)) {
        
        $select = '';
        if($agent_row['id'] == $data_array[3]){ $select = "selected";}
        $opt .= "<option value=".$agent_row['id'].">".$agent_row['user_name']."-".$assignd."</option>";
        
    }
    

  

    $opt2 = $data_array[3];
  
 $type=mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$data_array[1]."'"));
  if($i==0)
  {
     print $tr;
print "<td>".$data_array[0]."</td>
<td>".$type[1]."</td>
<td>".$data_array[2]."</td>
<td>
    <select class=\"form-control\" id=\"sby\" name=\"src_type\">
    ".$opt."
    </select>".$opt2."
</td>
<td>".$data_array[4]."</td>
<td>".$data_array[5]."</td>
<td>".$data_array[9]."</td>
<td>".$tat."</td>
<td>".$res."</td>
<td><a onclick=\"smcollege('".$data_array[0]."');\"><img src=\"update/edit.png\" width=\"15\" height=\"15\" style=\"cursor:pointer;\" title=\"Update Ticket $data_array[0]\"></a></td>";
print "</tr>";
  $i=1;
  }
    else 
  {
     print $tr2;
print "<td>".$data_array[0]."</td>
<td>".$type[1]."</td>
<td>".$data_array[2]."</td>
<td>
  <select class=\"form-control\" id=\"sby\" name=\"src_type\">
    ".$opt."
  </select>".$opt2."
</td>
<td>".$data_array[4]."</td>
<td>".$data_array[5]."</td>
<td>".$data_array[9]."</td>
<td>".$tat."</td>
<td>".$res."</td><td><a onclick=\"smcollege('".$data_array[0]."');\"><img src=\"update/edit.png\" width=\"15\" height=\"15\" style=\"cursor:pointer;\" title=\"Update Ticket $data_array[0]\"></a></td>";
print "</tr>";
  }

}   // loop End
unset($assignd);
print "</tbody>";

?>