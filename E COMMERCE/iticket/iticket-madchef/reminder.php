<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script src="ck/ckeditor.js"></script>
<style> 
div.container {
width: 100%;
height: 445px;
//-moz-box-shadow: 1px 3px 26px 9px #888888;
//-webkit-box-shadow: 1px 3px 26px 9px #888888;
//box-shadow: 1px 3px 26px 9px #888888;
}
</style>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>. : : i Tracker : : .</title>
<script type="text/javascript">
function showSend(to,msg)
{
document.getElementById("suc_res").innerHTML = "<div align=\"center\"><img src=\"loading.gif\" width=\"100\" height=\"100\"></div>";
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("suc_res").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","mail/send_dipu.php?to="+to+"&msg="+msg,true);
xmlhttp.send();
}
</script>
</head>






<?php
$to 	   = "";
$tid	   = "";
$cname	   = "";
$cproduct  = "";
$address   = "";
$sms_body  = "";

if(isset($_GET['to']))        $to  	 	= "88".$_GET['to'];
if(isset($_GET['tid']))       $tid 	 	= $_GET['tid'];
if(isset($_GET['cname']))     $cname 	= $_GET['cname']; 
if(isset($_GET['cproduct']))  $cproduct = $_GET['cproduct']; 
if(isset($_GET['address']))   $address  = $_GET['address'];



if(isset($_GET['tid']))
{
include 'db.php';
$res = mysql_query("select (SELECT phone FROM `users` where id = ( select assignd  from ticket where id = $tid)), `details` from ticket where id = $tid");
$DataAr = mysql_fetch_array($res);

$assignd_no = ";88".$DataAr[0];
$ti_detail = strip_tags($DataAr[1]);
}
else
{
$assignd_no = "";
$ti_detail = "";
}





if(isset($_GET['tid']))
{
	$result = mysql_query("SELECT * FROM ticket where `id`= '$tid'");
	$send_row = mysql_fetch_row($result);
	$cname=$send_row[6];
	$address=$send_row[5];
	$cproduct=$send_row[8];
	//$to=mysql_result($result,0);
	$ti_detail=$send_row[11];
//$sms_body = "T-ID:$tid, $cname, $address, $cproduct, $to, $ti_detail - PRAN-RFL CRD";
$sms_body = "<font color=\"red\"><strong>Dear Concern,</strong></font><br>
<font color=\"red\">Please see the complain :</font>
<p align=\"justify\">T-ID:$tid, $cname, $address, $cproduct, $to, $ti_detail</p>
<font color=\"red\"><strong>Customer Relation Department</strong></font><br>
<font color=\"red\"><strong>OBHAI</strong></font>";
}
?>







<body background="admin/<?php include 'bg.php';?>">

<div class="container" style="background:#CCCCCC; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
  
  <table width="519" height="98" border="0" align="center">
  <tr>
    <td valign="top"><?php include'menu.php';?>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top"><table width="385"  border="0">
      <tr>
        <td valign="top">To</td>
        <td valign="top"><select name="select_to" id="select_to" class="form-control">
          <option>--Select Reciver--</option>
                <? include 'db.php';
					$result1 = mysql_query("select user_name,user_email FROM users ");
while($row=mysql_fetch_array($result1)) { ?>
                <option value="<?=$row['user_email']?>">
                <?=$row['user_name']?>
				[ <?=$row['user_email']?> ]
                </option>
                <? } ?>
        </select></td>
      </tr>
      <tr>
        <td valign="top">Massage</td>
        <td valign="top">    <textarea name="details" id="details" placeholder="Conversation Deatils" class="form-control" style="height:95px; width:100% !important; font-size:10px;"><?php print $sms_body;?></textarea><script>CKEDITOR.replace( 'details',{uiColor:'#CCCCCC'});CKEDITOR.config.height = 150;CKEDITOR.config.width = 600;</script></td>
      </tr>
      <tr>
        <td valign="top">&nbsp;</td>
        <td valign="top"><input type="submit" name="Submit" value="Send Mail" class="btn btn-primary btn-sm" onclick="showSend(document.getElementById('select_to').value,document.getElementById('details').value);"/></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top">
	
	<div align="center" id="suc_res">
	
	</div>
	
	</td>
  </tr>
</table>
</div>
</body>
</html>
