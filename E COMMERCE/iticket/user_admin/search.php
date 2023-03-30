<?php include'session.php'; ?>
    <!-- Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
<style> 
div.container {
width: 700px;

    -moz-box-shadow: 1px 3px 26px 9px #888888;
-webkit-box-shadow: 1px 3px 26px 9px #888888;
box-shadow: 1px 3px 26px 9px #888888;
}
body {
	//background-image: url(../r2.jpg);
	background-color:rgba(0, 0, 0, 0) !important;
}
</style>



  <table width="519" height="440" border="0" align="center" class="">
  <tr>
    <td valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="66" valign="top"><table width="561" border="0" align="center">
      <tr>
        <td width="662" valign="top"><form id="form1" name="form1" method="post" action="">
          <table width="555" border="0">
            <tr>
              <td>Status</td>
              <td><select name="status" class="form-control" id="status" >
                <option value="">-Select Status-</option>
                <? include '../db.php';
					$result1 = mysql_query("select *FROM ticket_status ");
while($row=mysql_fetch_array($result1)) { ?>
                <option value="<?=$row['status_name']?>">
                <?=$row['status_name']?>
                </option>
                <? } ?>
              </select></td>
              <td><input type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm"/>
                <input name="all" type="submit" class="btn btn-success btn-sm" id="all" value="All"/></td>
              <td>Type</td>
              <td><select name="type" class="form-control" id="type" >
                <option value="">-Select Status-</option>
                <? 
					$result11 = mysql_query("select *FROM ticket_type ");
while($row=mysql_fetch_array($result11)) { ?>
                <option value="<?=$row['type_name']?>">
                <?=$row['type_name']?>
                </option>
                <? } ?>
              </select></td>
              <td><input type="submit" name="Submit3" value="Submit" class="btn btn-primary btn-sm"/></td>
            </tr>
            <tr>
              <td width="48">Search</td>
              <td width="119"><select name="search" class="form-control" id="search">
                  <option>--Select--</option>
                  <option value="id">Ticket ID</option>
                  <option value="cus_contact">Phone</option>
                  <option value="cus_ac">Customer ID</option>
                    </select></td>
              <td width="111">&nbsp;</td>
              <td width="51">Value</td>
              <td width="144"><input name="value" type="text" class="form-control" id="value"/></td>
              <td width="56"><input type="submit" name="Submit2" value="Submit" class="btn btn-primary btn-sm"/></td>
            </tr>
          </table>
        </form>        </td>
      </tr>
      
    </table></td>
  </tr>
  <tr>
    <td height="345" valign="top">&nbsp;
      <div style="overflow:auto;  height: 330px; "  >
        <?php
	
	if(isset($_POST['Submit']))
{
//include 'db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$in=$_POST['status'];

$results1=mysql_query("SELECT * FROM ticket where status='$in' ");

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
echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='. $_GET['i'] .' ">Check</div></td>'; 
//echo '<td ><<a href=followup.php?id='. $row['id'] .'>Check </a></td>';
     }
   echo "</table>";
   
}

/////////////////////////////////
	if(isset($_POST['Submit3']))
{
//include 'db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$in=$_POST['type'];

$results1=mysql_query("SELECT * FROM ticket where ticket_type='$in' ");

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
  echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='. $_GET['i'] .' ">Check</div></td>'; 

     }
   echo "</table>";
   
}
/////////////////////////////

if(isset($_POST['Submit2']))
{
//include 'db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$in2=$_POST['search'];
$value=$_POST['value'];
//echo $in2;
//echo $value;

$results1=mysql_query("SELECT * FROM ticket where $in2='$value' ");

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
  echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='. $_GET['i'] .' ">Check</div></td>'; 

     }
   echo "</table>";
   
}
//////////////////////////////////

if(isset($_POST['all']))
{
//include 'db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$in=$_POST['type'];

$results1=mysql_query("SELECT * FROM ticket  ");

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
  echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='. $_GET['i'] .' ">Check</div></td>'; 

     }
   echo "</table>";
   
}

////////////////////////

?>
</div></td>
  </tr>
</table>



