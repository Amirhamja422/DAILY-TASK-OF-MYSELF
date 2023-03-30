<?php
include '../../db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 

function timeEllapsedFrom($from) {
  $time = time() - $from;
  $diff = abs($time);
  $tokens = array (
    'year' => 31536000,
    'month' => 2592000,
    'week' => 604800,
    'day' => 86400,
    'hour' => 3600,
    'minute' => 60,
    'second' => 1
  );
  $result = array();
  foreach ($tokens as $id => $length) {
    $value = floor($diff/$length);
    if ($value) $result[] = "$value $id" . ($value > 1 ? 's' : '');
    $diff -= $length*$value;
  }
  if (!count($result)) return 'just now';
  return join(', ', $result) . ($time < 0 ? ' later' : ' ago');
}


$q1 = $_GET['q1'];
$q2 = $_GET['q2'];
$q3 = $_GET['q3'];
$q4 = $_GET['q4'];

  if ($q3 == 'cus_amount') {
    $q3_query = "SUBSTRING(".$q3.", -4 ) = ".$q4." AND";
  } else {
    $q3_query = "".$q3." like '%".$q4."%' AND";
  }

$results=mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', (select user_name from users where id = `ticket`.`assignd`) as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name', `cus_ac` as 'Account ID', `cus_product` as 'Product Details', `cus_amount` as 'Address', `status` as 'Last Status', `date` as 'Create Date', `priority` as 'Priority', `sub_group` AS 'SUB Group' , `nature` AS 'Nature' FROM `ticket` WHERE ".$q3_query." date >='".$q1." 00:00:00'  AND date <='".$q2." 23:59:59'");
$num_rows = mysql_num_rows($results);
?>


<a href="reports/phpexcel/report-download.php?q1=<?php print $q1; ?>&q2=<?php print $q2; ?>&q3=<?php print $q3; ?>&q4=<?php print $q4; ?>&q5="><button class="btn btn-outline-primary btn-sm float-right" style="margin-top: -12px; margin-right: 7px;">Export Excel</button></a>
<div align="center" class="datagrid" style="width:99%; height:auto; overflow:auto; "> 
  <table class="anlepore table table-bordered" style="font-size: 12px; margin-top: 5px;">
  <thead align="center">
    <tr>
      <th>ID</th>
      <th>COMPLAIN NATURE</th>
      <th>COMPLAIN TYPE</th>
      <th>Initiator</th>
      <th>Assigned To</th>
      <th>Customer Phone Number</th>
      <th>Customer Name</th>
      <th>Account Number</th>
      <th>Card/CIF</th>
      <th>Duration</th>
      <th>Last Status</th>
      <th>Carete Date</th>
      <th>Priority</th>
    </tr>
  </thead>

<?php
$i=0;
print "<tbody align=\"center\">";
while($data_array=mysql_fetch_row($results))
{ 

  $duration = strtotime(date('y-m-d H:i:s')) - strtotime($data_array[10]); 
  $tat = number_format((($duration/60)/60), 2, '.', '');

  if ($data_array[11] == 1) {
      $priority = "General";
  } elseif ($data_array[11] == 2) {
      $priority = "Sensitive";
  } elseif ($data_array[11] == 3) {
      $priority = "Highly Sensitive";
  }

  $issue = mysql_fetch_row(mysql_query("SELECT * FROM `sub_group` WHERE `id`='".$data_array[12]."'"));
  if($i==0)
  {
     print "<tr>";
print "<td>".$data_array[0]."</td><td>".$data_array[13]."</td><td>".$issue[3]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[8]."</td><td>".$tat."</td><td>".$data_array[9]."</td><td>".$data_array[10]."</td><td>".$priority."</td>";
print "</tr>";
  
  $i=1;
  }
    else 
  {
     print "<tr class=\"altav\">";
print "<td>".$data_array[0]."</td><td>".$data_array[13]."</td><td>".$issue[3]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[8]."</td><td>".$tat."</td><td>".$data_array[9]."</td><td>".$data_array[10]."</td><td>".$priority."</td>";
print "</tr>";
  
  $i=0;
  }

} 

?>
</tbody>
</table></div>











