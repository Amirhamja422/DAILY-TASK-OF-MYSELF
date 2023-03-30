<?php
// include'../session.php';
include'db.php';
$current_time = date("Y-m-d H:i:s" );
echo $current_time;
$endTime = strtotime("+15 minutes", strtotime($current_time));
echo date($endTime)

$sql ="SELECT * FROM `ticket` WHERE `status` LIKE 'New'  ORDER BY `id` DESC";

echo $sql;

// echo 
//  while ($row=mysql_fetch_assoc($sql)) 
//  {
//  	// $order_time=$row['date'];

//  	// echo $order_time;
//  	// $diff=date_diff($order_time,$current_time);
//  }

?>


  
