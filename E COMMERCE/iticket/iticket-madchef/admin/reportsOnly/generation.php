
<?php
include '../../db.php';
session_start();
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 


$key = '';
$q1 = $_GET['q1'];
$q2 = $_GET['q2'];
$q3 = $_GET['q3'];
$q4 = $_GET['q4'];
$q5 = $_GET['q5'];
$ska = $_GET['ska'];
// print_r($ska);

if ($q3 == 'assignd') { 
  $key = $ska;
} else {
  $key = $q4;
}

// print_r($_SESSION['group_id']);

$results = mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', (select user_name from users where id = `ticket`.`assignd`) as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name', `cus_ac` as 'Account ID', `cus_product` as 'Product Details', `cus_amount` as 'Address', `status` as 'Last Status', `date` as 'Create Date', `priority` as 'Priority', `sub_group` AS 'ISSUE' FROM `ticket` WHERE ".$q3." like '%".$key."%' AND date >='".$q1." 00:00:00'  AND date <='".$q2." 23:59:59' and `group` IN (".ltrim($_SESSION['group_id'], ',').")");

$num_rows = mysql_num_rows($results);
?>
<br>
<div align="center">

<div style="float:left; color:#003366; margin-top: -29px;">
Total Row(s) : <span style="color:#CCCC00; font-weight:bolder;"><?php print $num_rows;?> </span>
</div>
<div style="float:right; margin-right:15px; margin-bottom:10px; margin-top: -29px;">
<a href="../admin/reportsOnly/phpexcel/report-download.php?q1=<?php print $q1; ?>&q2=<?php print $q2; ?>&q3=<?php print $q3; ?>&q4=<?php print $q4; ?>&q5=<?php print $q5; ?>">
<input type="submit" class="exbtnex" value="Export to Excel">
</a>
</div>


</div>
<br>


<?php
print "<div align=\"center\" class=\"datagrid\" style=\"width:99%; height:auto; overflow:auto;\">";
print "<table class=\"anlepore table table-bordered\" style=\"font-size: 12px; margin-top: 1px;\">"; 
print "<thead align=\"center\"><tr><th>ID</th><th>SERVICE</th><th>COMPLAIN TYPE</th><th>Initiator</th><th>Assigned To</th><th>Customer Contact Number</th><th>Name</th><th>Account No</th><th>Card/CIF</th><th>priority</th><th>Carete Date</th></tr></thead>";

// class=\"firsttr\"
// class=\"porertr\"
$i=0;
print "<tbody align=\"center\">";
while($data_array=mysql_fetch_row($results))
{   

  if ($data_array[11] == 1) {
      $priority = "General";
  } elseif ($data_array[11] == 2) {
      $priority = "Sensitive";
  } elseif ($data_array[11] == 3) {
      $priority = "Highly Sensitive";
  }

  // loop Start
  $type=mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$data_array[1]."'"));
  $issue=mysql_fetch_row(mysql_query("SELECT * FROM `sub_group` WHERE `id`='".$data_array[12]."'"));
  if($i==0)
  {
     print "<tr>";
print "<td>".$data_array[0]."</td><td>".$type[1]."</td><td>".$issue[3]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[8]."</td><td>".$priority."</td><td>".$data_array[10]."</td>";
print "</tr>";
  
  $i=1;
  }
    else   //if($i==1)
  {
     print "<tr class=\"altav\">";
print "<td>".$data_array[0]."</td><td>".$type[1]."</td><td>".$issue[3]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[8]."</td><td>".$priority."</td><td>".$data_array[10]."</td>";
print "</tr>";
  
  $i=0;
  }

}   // loop End
print "</tbody>";
print "</table></div>";




?>






