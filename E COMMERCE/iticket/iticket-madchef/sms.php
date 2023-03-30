<?php
	$customer_ph = $_REQUEST['to'];
	$customer_id = $_REQUEST['ticket_id'];
	//$sms_massage = "Dear customer, Your complain is on process. Your ticket id is : ". $_REQUEST['ticket_id'].".
	$sms_massage = "Dear customer, Your complain is on process. Your ticket id is : ". $customer_id .".
	For further query please call 16255 with your ticket id.";
	$curl = curl_init(); 
	curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, 
		CURLOPT_URL => '192.168.254.2/pushapi/dynamic/server.php?user=ificcc&pass=83C893n>&sid=ificcc&sms='.urlencode($sms_massage).'&msisdn=88'.$customer_ph.'&csmsid=123456789', 
		CURLOPT_USERAGENT => 'Sample cURL Request' )); 
	$resp = curl_exec($curl); 
	curl_close($curl);
	echo $resp;
	header("Location: search.php");	
?>
