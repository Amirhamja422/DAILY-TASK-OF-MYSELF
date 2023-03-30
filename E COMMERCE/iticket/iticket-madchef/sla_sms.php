<?php
// include'../session.php';
include'db.php';
$current_time = date("Y-m-d H:i:s" );
echo $current_time;
$sql =mysql_query("SELECT * FROM `ticket` WHERE `status` LIKE 'New'  ORDER BY `id` DESC");
// echo $sql;


while ($row=mysql_fetch_assoc($sql)) 
{
	$order_time=$row['date'];
	echo $order_time;
    $diff=$current_time - $order_time;
    // echo $diff;


if($diff>=10)
{

 $url = "http://sms.brilliant.com.bd:6005/api/v2/SendSMS?ApiKey=TqKYEIuJQKAEVf2zCR0yvTNEWOaD2XB1WTmmrjOO8l0=&ClientId=d3b4c920-0bee-49e5-8a7c-a104f940323a&SenderId=8809638050505&Message=TestsS&MobileNumbers=+8801639199218";			

		
	}
			
else{
	echo "no";

}
}



?>




