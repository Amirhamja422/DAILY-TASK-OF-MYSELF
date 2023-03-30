<?php     
$username = "sa";
$password = "W3lc0m3";
$hostname = "172.17.4.235";	//"apollodkdb2";//
$connect = mssql_connect($hostname, $username, $password) 
	or die("Unable to connect to MSSQL");
$select = mssql_select_db("CustomerServiceManageDb",$connect);
?>

