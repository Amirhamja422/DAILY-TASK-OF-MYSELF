<?php     
$username = "root"; 
$password = "iHelpBD@2017";
$hostname = "localhost";	
$connect = mysql_connect($hostname, $username, $password) 
	or die("Unable to connect to MySQL");
$select = mysql_select_db("ticket_dev",$connect)
//mysql_close($dbh);

?>