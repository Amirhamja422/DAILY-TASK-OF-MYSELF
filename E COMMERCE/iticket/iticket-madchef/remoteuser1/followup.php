<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="ck/ckeditor.js"></script>
<style> 
div.container {
width: 70%;
height: 580px;
    -moz-box-shadow: 1px 3px 26px 9px #888888;
-webkit-box-shadow: 1px 3px 26px 9px #888888;
box-shadow: 1px 3px 26px 9px #888888;
}
</style>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>. : : i Ticket : : .</title>
<style type="text/css">
<!--
body {
	//background-image: url(r2.jpg);
	//background-repeat: repeat;
}
-->
</style></head>
<body background="../admin/<?php include '../bg.php';?>">
<p>&nbsp;</p>
<div class="container" style="background:#CCCCCC; border-radius:15px; overflow-y:auto;">
  <p>&nbsp;</p>
  <table width="100%" height="98" border="0" align="center">
  <tr>
    <td width="550" valign="top"><?php include'menu.php';?>&nbsp;
	<?php 
	$rcv= $_GET["id"] ;
     	$who= $_GET["i"] ;
	//include 'db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$results2=mysql_query("SELECT *  FROM ticket WHERE id='$rcv'");
while($row1 = mysql_fetch_array($results2))
	{
     $id=   $row1['id']  ; 
	 $from1=   $row1['from']  ; 
	 $to=   $row1['assignd']  ; 
	 $group=   $row1['group']  ; 
	 $type=   $row1['ticket_type']  ; 
	 $date=   $row1['date']  ; 
	 $status=   $row1['status']  ; 
	 $details=   $row1['details']  ; 
	 $cus_name=   $row1['cus_name']  ; 
	 $cus_phone=   $row1['cus_contact']  ; 
	 $cus_id=   $row1['cus_ac']  ; 
	 $product=   $row1['cus_product']  ; 
     $amount=   $row1['cus_amount']  ; 
/////////////////////////////////////////////////////////////////////////
$results3=mysql_query("SELECT * FROM users WHERE id='$to'");
while($row2 = mysql_fetch_array($results3))
	{
	$to1=   $row2['user_name']  ;
	//echo $to1;
	}
////////////////////////////////////////////////////////////////////
 $results61=mysql_query("SELECT * FROM users WHERE id='$who'");
while($row61 = mysql_fetch_array($results61))
	{
	$from=   $row61['user_name']  ;
	//echo $to1;
	}
 ///////////////////////////////////////////////////////////////////
 $results4=mysql_query("SELECT * FROM user_group WHERE id='$group'");
$group1="";
 while($row4 = mysql_fetch_array($results4))
	{
	$group1=   $row4['group_name']  ;
	//echo $to1;
	}
 
 ////////////////////////////////////////////////////////////////////
    }
	?>	</td>
  </tr>
  <tr>
    <td valign="top"><table width="100%" border="0">
      <tr>
        <td width="82" valign="top">Ticket ID </td>
        <td width="157" valign="top"><?php echo $id; ?>&nbsp;</td>
        <td width="106" valign="top">Customer name </td>
        <td width="185" valign="top"><?php echo $cus_name; ?></td>
      </tr>
      <tr>
        <td valign="top">From</td>
        <td valign="top"><?php echo $from1; ?></td>
        <td valign="top">Customer phone </td>
        <td valign="top"><?php echo $cus_phone; ?></td>
      </tr>
      <tr>
        <td valign="top">To</td>
        <td valign="top"><?php echo $to1; ?></td>
        <td valign="top">Customer ID </td>
        <td valign="top"><?php echo $cus_id; ?></td>
      </tr>
      <tr>
        <td valign="top">Group</td>
        <td valign="top"><?php echo $group1; ?></td>
        <td valign="top">Product ID </td>
        <td valign="top"><?php echo $product; ?></td>
      </tr>
      <tr>
        <td valign="top">Status</td>
        <td valign="top"><?php echo $status; ?></td>
        <td valign="top">Address</td>
        <td valign="top"><?php echo $amount; ?></td>
      </tr>
      <tr>
        <td valign="top">Date</td>
        <td valign="top"><?php echo $date; ?></td>
        <td valign="top">Details</td>
        <td valign="top" ><?php echo $details; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><strong><br>Ticket Cycle/History </strong></td>
  </tr>
  <tr>
    <td valign="top" style="font-size:10px !important;">
	
	<?php 	 //include('db.php');  
	mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 

  
	 
	 $result = mysql_query("SELECT * FROM history where id='$rcv' ORDER BY date ASC ");
	 
     echo "<table  align='center'  class='table table-hover' cellpadding=\"1\" >
     <tr>
	 
	

	  <th align='center'>Date</th>
	  <th align='center'>Status</th>
	  <th align='center'>From</th>
	  <th align='center'>Details</th>
 
	 
     </tr>";


while($row = mysql_fetch_array($result))
	{
								
  echo "<tr style=\"height:10px !important;\">";

  echo "<td >" . $row['date'] . "</td>";
  echo "<td >" . $row['status'] . "</td>";
  echo "<td >" . $row['from'] . "</td>";
  echo "<td >" . $row['details'] . "</td></tr>";
 }
   echo "</table>";
   ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><form id="form1" name="form1" method="post" action="">
        <table width="100%" border="0" align="center">
          <tr>
            <td width="523" valign="top"><strong>New Status</strong>             
              <select name="status" class="form-control" id="status" required >
                <?php
$res = mysql_query("select status_name FROM ticket_status");
while($row=mysql_fetch_array($res)) {
print "<option value = \"$row[0]\">$row[0]</option>";
}
?>
				
				<!--<option value="">-Select Status-</option>
                
                <option value="Answered">
                Answered
                </option> -->
                
              </select></td>
          </tr>
          <tr>
            <td height="112" valign="top"><p>
              <textarea class="form-control" id="editor1" name="editor1" rows="4" required></textarea>
            </p>
              <p>
                <input name="follow" type="submit" class="btn btn-primary btn-sm" id="follow" value="Update Ticket"/>
              </p>
              </td>
          </tr>
        </table>
      </form>    
	  <br>  
      <table width="100%" border="0" align="center">
        <tr>
          <th align="left" valign="top" scope="col">
		  
		  
		  
		  
		  <div align="left" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:normal;">
		  <form action="followup.php?id=<?php print $_GET['id'];?>&i=<?php print $_GET['i'];?>" method="post">
		  <div><strong>Forward Ticket to :</strong> 
		    <select name="forward_to" id="forward_to" class="form-control" required="required">
              <option value="">-Select Reciever-</option>
              <?php include 'to_list.php';?>
            </select> 
		  <input name="forward_new" type="submit" class="btn btn-primary btn-sm" id="forward_new" value="Forward"/>
		  </div>
		  </form>
		  </div>
		  
		  </th>
        </tr>
      </table>      </td>
  </tr>
  <tr>
    <td valign="top"><script>
				CKEDITOR.replace( 'editor1');
				CKEDITOR.config.height = 90;
			</script></td>
  </tr>
  <tr>
  <?php
  $rcv1= $_GET["id"] ;
 
  if(isset($_POST['follow']))
{

include '../db.php';  mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$date = date("d-m-Y");
//$rcv1= $_GET["id"] ;
$results=mysql_query("INSERT INTO `history` (`id`,`status`,`from`, `details`,`date`) VALUES ('$rcv1','".$_POST['status']."', '$from','".$_POST['editor1']."',NOW() )");

$results5=mysql_query("UPDATE `ticket` SET  status= '".$_POST['status']."' where id= '$rcv1' ");
}
?>

    <td valign="top">
	
	
	
	
	</td>
  </tr>
  
  
  
  
  
</table>

<?php
if(isset($_POST['forward_new']))
{

include '../db.php';
//forward_to
$tof=$_POST['forward_to'];
$results=mysql_query("UPDATE `ticket`.`ticket` SET `superiors` = CONCAT( superiors, ',".$_POST['forward_to']."' ) WHERE `ticket`.`id` = ".$_GET['id']." LIMIT 1;");
$resultsF=mysql_query("INSERT INTO `ticket`.`history` (`id`, `date`, `status`, `from`, `details`) VALUES (".$_GET['id'].", NOW(), 'Forward', '$from', (select CONCAT( 'Forwarded to - ',user_name) from users where id=$tof))");
print "<font face=\"Times New Roman, Times, serif\" color=\"#006600\" >Ticket Forwarded Successfully.</font>";

}
?>

<br><br>




</div>

<?php include '../footer.php';?>
</body>
</html>
