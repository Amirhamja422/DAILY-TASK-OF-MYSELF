<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="jq/jquery-ui.css">
	
    <link href="css/dipu.css" rel="stylesheet">
<script src="jq/jquery-1.9.1.js"></script>
<script src="jq/jquery-ui.js"></script>
<script type="text/javascript">
function dataPass(str,str2,str3)
{
document.getElementById("pmal").value=str;  
document.getElementById("amal").value=str3;  
document.getElementById("imal").value=str2;
}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>. : :  i Ticket : : .</title>
<style> 
div.ui-datepicker {    font-size: 12px;  }
div.container {
width: 70%;
height: 580px;
    -moz-box-shadow: 1px 3px 26px 9px #888888;
-webkit-box-shadow: 1px 3px 26px 9px #888888;
box-shadow: 1px 3px 26px 9px #888888;
}
body {
	//background-image: url(r2.jpg);
}
.beauty{
    -webkit-border-radius: 5px; 
    -moz-border-radius: 5px; 
    border-radius: 5px; 
    border: 1px solid #0000CC; 
    outline:0; 
    height:25px; 
    width: 180px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
}
.beautyE{
    -webkit-border-radius: 5px; 
    -moz-border-radius: 5px; 
    border-radius: 5px; 
    border: 1px solid #0000CC; 
    outline:0; 
    height:25px; 
    width: 180px;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	background-color:#CC0000;
	color:#FFFFFF;
}
</style>
</head>

<body background="../admin/<?php include '../bg.php';?>">
<?php include'session.php'; ?>
<p>&nbsp;</p>
<div class="container" style="background:#CCCCCC; border-radius:15px;">
  <p>&nbsp;</p>
  <table width="100%" height="440" border="0" align="center" class="">
  <tr>
    <td valign="top"><?php include'menu.php';?>&nbsp;</td>
  </tr>
  <tr>
    <td >
      
	  
	  
	  </td>
  </tr>
  <tr>
    <td height="345" valign="top">
	<div align="left" style="font-size:24px; font-weight:bolder;">Notice Board </div>
      <div style="overflow:auto;  height: 330px; border:1px solid; border-radius:5px;"  >
	  
	  <div align="justify" style="padding:30px;">
        <?php
$rcv= $_GET["i"] ; 

mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 

$results1=mysql_query("SELECT notice FROM users where `id`=".$rcv);

$row = mysql_fetch_array($results1);


print $row[0];

?>
</div>
</div></td>
  </tr>
</table>
  
 
  
  
</div>











    <div class="modal fade" id="smallModal" tabindex="-1" role="dialog" aria-labelledby="smallModal" aria-hidden="true">
      <div class="modal-dialog modal-lg"> <!--  modal-dialog modal-sm  -->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Edit Malformated Numbers</h4>
          </div>
          <div class="modal-body" align="center">
            <form action="" method="post">
			<table>
			<tr>
			<input type="hidden" name="imal" id="imal" value="">
			<td>Malformated</td> <td>:</td> <td><input type="text" class="beautyE" id="pmal" name="pmal" readonly> </td>
			</tr>
			<tr><td>&nbsp;</td></tr>
			<tr>
			<td>Correct</td> <td>:</td><td><input type="text" placeholder="Enter Correct Format" class="beauty" id="amal" name="amal"></td>
			</tr>
			</table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="formatok" id="formatok">Save changes</button>
          </div>
		  </form>
        </div>
      </div>
    </div>
<script src="js/bootstrap.min.js"></script>
















<?php include '../footer.php';?>
</body>
</html>
