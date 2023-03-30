<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="post" action="">
  <input name="input" type="text" id="input" />
  <input type="submit" name="Submit" value="Submit" />
</form>
<p>&nbsp;</p>
<p>
  <?php
$get=$_POST["input"];  
  
	if(isset($_POST['Submit']))
{
include 'db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$in=$_POST['status'];

$results1=mysql_query("SELECT * FROM ticket where id=$get' ");

     echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
     <tr>
	  <th align='center'>ID</th>
	  <th align='center'>Opening date</th>
	 <th align='center'>Status</th>
	 <th align='center'>Type</th>
	 <th align='center'>Check</th>



     </tr>";


while($row = mysql_fetch_array($results1))
	{
								
  echo "<tr>";
  echo "<td >" . $row['id'] . "</td>";
  echo "<td >" . $row['date'] . "</td>";  
  echo "<td >" . $row['status'] . "</td>"; 
  echo "<td >" . $row['ticket_type'] . "</td>"; 
  //echo "<td >"<a href=followup.php?id='9900'>Check </a>"</td>"; 
   // echo "<td >"<a href='followup.php' >".$row['id']. Check</a>"</td>";
echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
//echo '<td ><<a href=followup.php?id='. $row['id'] .'>Check </a></td>';
     }
   echo "</table>";
   
}
?>
</p>
<p>&nbsp;</p>
<p>&nbsp; </p>
</body>
</html>
