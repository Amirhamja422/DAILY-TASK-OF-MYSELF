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

if (isset($_POST['branch_name'])) 
{
	 $branch_name = $_POST['branch_name'];
     $result1 = mysql_query("SELECT `id`,`product_name`, `product_price`,`product_size`,`product_image`,`status` FROM `ticket`.`add_ons` WHERE `branch`='$branch_name' ORDER BY id");
     echo "<option value=\"option_header\">Select Extra Product</option>";
     while ($row1 = mysql_fetch_array($result1)) {?>
         <option <?php if($row1['status'] == 0) {  echo "style='color:red'";} ?> value="<?php echo $row1['id']; ?>"><?php echo  $row1['product_name']."-".$row1['product_size']." TK - ".$row1['product_price'];?><?php } ?></option>
<?php
}
?>