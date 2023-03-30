<?php

$username = "root";
$password = "iHelpBD@2017";
$hostname = "localhost";

$con = mysql_connect($hostname, $username, $password) 
or die("Unable to connect to MySQL");
mysql_select_db("ticket",$con);



if(!$con){
  die('Could not connect to database! Server ip - '.$hostname.' <br/>');
}

if (isset($_POST['get_option'])) {
	$brand = $_POST['get_option'];

$sql=mysql_query("SELECT branch_name FROM user_group WHERE brand_name LIKE '%$brand%'");

while($row=mysql_fetch_array($sql))
{
	?>
	<select name="new_select" id="new_select" class="form-control"  style="padding: 0px;" >
		<option value="<?php echo $row['branch_name']; ?>"><?php echo $row['branch_name']; ?></option>
	</select>
	<?php
}
}

