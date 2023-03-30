<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="ck/ckeditor.js"></script>
<style> 
div.container {
width: 700px;

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
<title>iDialer</title>
<style type="text/css">
<!--
body {
	//background-image: url(r2.jpg);
	//background-repeat: repeat;
}
-->
</style></head>
<body background="admin/<?php include 'bg.php';?>">
<p>&nbsp;</p>
<div class="container" style="background:#FFFFFF; border-radius:15px; width:700px;  overflow-y:auto;">
  <p>&nbsp;</p>
  <table width="556" height="98" border="0" align="center">
  <tr>
    <td width="550" valign="top"><?php include'menu.php';?>&nbsp;
	<?php 
	$rcv= $_GET["id"] ;
     	$who= $_GET["i"] ;
	include 'db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$results2=mysql_query("SELECT *  FROM ticket WHERE id='$rcv'");
while($row1 = mysql_fetch_array($results2))
	{
     $id=   $row1['id']  ; 
	 $from=   $row1['from']  ; 
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
    <td valign="top"><table width="548" border="0">
      <tr>
        <td width="82" valign="top">Ticket ID </td>
        <td width="157" valign="top"><?php echo $id; ?>&nbsp;</td>
        <td width="106" valign="top">Customer name </td>
        <td width="185" valign="top"><?php echo $cus_name; ?></td>
      </tr>
      <tr>
        <td valign="top">From</td>
        <td valign="top"><?php echo $from; ?></td>
        <td valign="top">Customer phone </td>
        <td valign="top"><?php echo $cus_phone; ?></td>
      </tr>
      <tr>
        <td valign="top">To</td>
        <td valign="top"><?php echo $to1; ?></td>
        <td valign="top">Customer ID </td>
        <td valign="top"><?php echo $id; ?></td>
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
        <td valign="top">Amount</td>
        <td valign="top"><?php echo $amount; ?></td>
      </tr>
      <tr>
        <td valign="top">Date</td>
        <td valign="top"><?php echo $date; ?></td>
        <td valign="top">Details</td>
        <td valign="top"><?php echo $details; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top"><strong>Ticket Cycle </strong></td>
  </tr>
  <tr>
    <td valign="top">
	
	<?php 	 include('db.php');  mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 

  
	 
	 $result = mysql_query("SELECT * FROM history where id='$rcv' ORDER BY date ASC ");
	 
     echo "<table  align='center'  class='table table-hover' >
     <tr>
	 
	

	  <th align='center'>Date</th>
	  <th align='center'>Status</th>
	  <th align='center'>From</th>
	  <th align='center'>Details</th>
 
	 
     </tr>";


while($row = mysql_fetch_array($result))
	{
								
  echo "<tr>";

  echo "<td >" . $row['date'] . "</td>";
  echo "<td >" . $row['status'] . "</td>";
  echo "<td >" . $row['from'] . "</td>";
  echo "<td >" . $row['details'] . "</td>";
 }
   echo "</table>";
   ?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><form id="form1" name="form1" method="post" action="">
        <table width="542" border="0" align="center">
          <tr>
            <td width="523" valign="top">New Status              
              <select name="status" class="form-control" id="status" required >
                <option value="">-Select Status-</option>
                <? include 'db.php';
					$result1 = mysql_query("select *FROM ticket_status where status_name NOT LIKE '%New%'  ");
while($row=mysql_fetch_array($result1)) { ?>
                <option value="<?=$row['status_name']?>">
                <?=$row['status_name']?>
                </option>
                <? } ?>
              </select></td>
          </tr>
          <tr>
            <td height="150" valign="top"><p>
              <textarea class="form-control" id="editor1" name="editor1" rows="4" required>
			</textarea>
              </p>
              <p>
                <input name="follow" type="submit" class="btn btn-primary btn-sm" id="follow" value="Submit"/>
                </p>
              <p>&nbsp; </p></td>
          </tr>
        </table>
      </form>      </td>
  </tr>
  <tr>
    <td valign="top"><script>
				CKEDITOR.replace( 'editor1');
				CKEDITOR.config.height = 90;
			</script>
	&nbsp;</td>
  </tr>
  <tr>
  <?php
  $rcv1= $_GET["id"] ;
 
  if(isset($_POST['follow']))
{

include 'db.php';  mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$date = date("d-m-Y");
//$rcv1= $_GET["id"] ;
$results=mysql_query("INSERT INTO `history` (`id`,`status`,`from`, `details`,`date`) VALUES ('$rcv1','".$_POST['status']."', '$from','".$_POST['editor1']."',NOW() )");

$results5=mysql_query("UPDATE `ticket` SET  status= '".$_POST['status']."' where id= '$rcv1' ");
}
?>

    <td valign="top">&nbsp;</td>
  </tr>
</table>
</div>
</body>
</html>
