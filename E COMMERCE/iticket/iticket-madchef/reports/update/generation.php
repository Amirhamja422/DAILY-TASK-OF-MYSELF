<style type="text/css">
.anlepore{
font-family:Verdana, Arial, Helvetica, sans-serif;
}
.anlepore tr:hover{
//background-color:#CCFF99;
background: rgb(184,225,252);
background: -moz-linear-gradient(top, rgba(184,225,252,1) 0%, rgba(169,210,243,1) 10%, rgba(144,186,228,1) 25%, rgba(144,188,234,1) 37%, rgba(144,191,240,1) 50%, rgba(107,168,229,1) 51%, rgba(162,218,245,1) 83%, rgba(189,243,253,1) 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(184,225,252,1)), color-stop(10%,rgba(169,210,243,1)), color-stop(25%,rgba(144,186,228,1)), color-stop(37%,rgba(144,188,234,1)), color-stop(50%,rgba(144,191,240,1)), color-stop(51%,rgba(107,168,229,1)), color-stop(83%,rgba(162,218,245,1)), color-stop(100%,rgba(189,243,253,1)));
background: -webkit-linear-gradient(top, rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%);
background: -o-linear-gradient(top, rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%);
background: -ms-linear-gradient(top, rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%);
background: linear-gradient(to bottom, rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b8e1fc', endColorstr='#bdf3fd',GradientType=0 );
}
.altav{
background:#DFFFDE;
}
.exbtnex{
border:1px solid #000000;
border-radius: 5px;
cursor:pointer;
color:#FFFFFF;
background-color:#009900;
}
</style>
<?php
session_start();
include '../../db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 



$q1 = $_GET['q1'];
$q2 = $_GET['q2'];
$q3 = $_GET['q3'];
$q4 = $_GET['q4'];
$pad_user = $_SESSION['id'];
$results3=mysql_query("SELECT user_name, concern, user_group_id,concern FROM users WHERE id=".$pad_user);
$row222 = mysql_fetch_array($results3);


$results=mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', (select user_name from users where id = `ticket`.`assignd`) as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name',  `cus_product` as 'Product Details',   `date` as 'Create Date', `hour_time` as 'SLA', `status` AS 'Status' FROM `ticket` WHERE ".$q3." like '%".$q4."%' AND date >='".$q1." 00:00:00'  AND date <='".$q2." 23:59:59' AND `group`='".$row222[2]."' ORDER BY `ticket`.`id` DESC");
$num_rows = mysql_num_rows($results);
?>
<br><br>
<div align="center">

<div style="float:right; color:#003366; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px;">
Total Row(s) : <span style="color:#FF3333; font-weight:bolder;"><?php print $num_rows;?> </span>
</div>



</div>
<br>


<?php
print "<div align=\"center\" class=\"datagrid\" style=\"width:99%; height:auto; overflow:auto;\">";
print "<table class=\"anlepore\">";
print "<thead align=\"center\"><tr><th>ID</th><th>TYPE</th><th>Raised</th><th>Assigned</th><th>Contact</th><th>Name</th><th>Email</th><th>Create Date</th><th>Status</th><th>Turn Around Time</th><th>SLA (Hours)</th><th title=\"UPDATE\"><img src=\"update.png\" width=\"20\" height=\"20\"></th></tr></thead>";

// class=\"firsttr\"
// class=\"porertr\"
//<th title=\"Delete\"><img src=\"delete.png\" width=\"20\" height=\"20\"></th>
$i=0;
print "<tbody align=\"center\">";
while($data_array=mysql_fetch_row($results))
{   // loop Start
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



 $type=mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$data_array[1]."'"));
  if($i==0)
  {
     print $tr;
print "<td>".$data_array[0]."</td><td>".$type[1]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[7]."</td><td>".$data_array[9]."</td><td>".$tat."</td><td>".$res."</td><td><a onclick=\"smcollege('".$data_array[0]."');\"><img src=\"edit.png\" width=\"15\" height=\"15\" style=\"cursor:pointer;\" title=\"Update Ticket $data_array[0]\"></a></td>";
print "</tr>";
  //<td><a href=\"delete.bra2.php?id=".$data_array[0]."&q1=$q1&q2=$q2&q3=$q3&q4=$q4\" onclick=\"return confirm('Are you really want to delete ".$data_array[0]."');\"><img src=\"del.png\" width=\"20\" height=\"20\" style=\"cursor:pointer;\" title=\"Delete Ticket $data_array[0]\"></a></td>
  $i=1;
  }
    else   //if($i==1)
  {
     print $tr2;
print "<td>".$data_array[0]."</td><td>".$type[1]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[7]."</td><td>".$data_array[9]."</td><td>".$tat."</td><td>".$res."</td><td><a onclick=\"smcollege('".$data_array[0]."');\"><img src=\"edit.png\" width=\"15\" height=\"15\" style=\"cursor:pointer;\" title=\"Update Ticket $data_array[0]\"></a></td>";
print "</tr>";
  //<td><a href=\"delete.bra2.php?id=".$data_array[0]."&q1=$q1&q2=$q2&q3=$q3&q4=$q4\" onclick=\"return confirm('Are you really want to delete ".$data_array[0]."');\"><img src=\"del.png\" width=\"20\" height=\"20\" style=\"cursor:pointer;\" title=\"Delete Ticket $data_array[0]\"></a></td>
  $i=0;
  }

}   // loop End
print "</tbody>";
print "</table></div>";




?>






