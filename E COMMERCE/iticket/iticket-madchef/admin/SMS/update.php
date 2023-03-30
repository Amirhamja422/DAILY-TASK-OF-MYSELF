<?php
include '../../db.php';
$pass_res = mysql_query("SELECT * FROM `sms_api`");
$SMS_PASS = mysql_fetch_array($pass_res);
?>





<?php
$error_message = "";
if(isset($_POST['submarine']))
{
    if($_POST['old'] == $SMS_PASS[1] && $_POST['cap'] == $_POST['caph'] && $_POST['new'] == $_POST['newa'])
	{
	mysql_query("UPDATE `ticket`.`sms_api` SET `password` = '".$_POST['new']."' WHERE `sms_api`.`id` = 1");
	$error_message = "API Password Updated Successfully";
	}
	else
	{
	if ($_POST['old'] != $SMS_PASS[1])   $error_message = "Given Existing Password Incorrect !!!";
	if ($_POST['cap'] != $_POST['caph']) $error_message = "Given Security Text Incorrect !!!";
	if ($_POST['new'] != $_POST['newa']) $error_message = "New Password Mismatch !!!";	
	}


}



?>


<style type="text/css">
.form-consex{
width:190px !important;
height:30px;
border:1px solid #999999;
border-radius:3px;
padding-left:5px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
font-weight:bolder;
}
.form-consex:focus{
box-shadow: 0px 0px 8px #04124D;
}
.form-conarea{
width:100% !important;
border:1px solid #999999;
border-radius:3px;
padding-left:5px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
font-weight:bolder;
}
.form-conarea:focus{
box-shadow: 0px 0px 8px #04124D;
}
.TitleStyle {
	color: #333333;
	font-weight: bold;
	font-size:24px;
}
.TDiff{
font-weight:bolder;
color:#990000;
}
.su_btn{
border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;
}
.su_btn:hover{
background-color:#6666FF;
}
</style>





<?php
include '../../db.php';
$pass_res = mysql_query("SELECT * FROM `sms_api`");
$SMS_PASS = mysql_fetch_array($pass_res);
?>



<?php
date_default_timezone_set("Asia/Dhaka");
$start_date = new DateTime($SMS_PASS[2]);
$since_start = $start_date->diff(new DateTime('now'));
?>



<div align="center" class="TitleStyle">Update SMS API</div>
<br><br><br>
<div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:14px;">SMS API Password Last Updated <span class="TDiff"><?php print $since_start->days.' Days '.$since_start->h.' Hours '.$since_start->i.' Minutes '.$since_start->s.' Seconds';?></span> Ago on <span style="font-weight:bolder; color:#006600;"><?php print $SMS_PASS[2];?> </span></div>







<br><br>
<form action="" method="post" >

<?php
    $characters = 'KK123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz';
    $random = '';
    for ($i = 0; $i < 5; $i++)
        $random .= $characters[mt_rand(0, 61)];
?>

<table align="center" border="0" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
<tr>
<td>Give The Existing Password</td>
<td>:</td>
<td><input type="text" name="old" id="old" class="form-consex" placeholder="Old Password" required></td>
</tr>

<tr>
<td>Give The New Password</td>
<td>:</td>
<td><input type="text" name="new" id="new" class="form-consex" placeholder="New API Password" required></td>
</tr>

<tr>
<td>Give The New Password Again</td>
<td>:</td>
<td><input type="text" name="newa" id="newa" class="form-consex" placeholder="New Password" required></td>
</tr>

<tr>
<td colspan="3" align="right"><img src="chapca.php?k=<?php print $random;?>" ></td>
</tr>


<tr>
<td>Prove you're not a robot</td>
<td>:</td>
<td><input type="text" name="cap" id="cap" class="form-consex" placeholder="Type The Displayed Image" required></td>
</tr>

<tr>
<td colspan="3" align="right">
<input type="hidden" name="caph" value="<?php print $random;?>">
<input type="submit" class="su_btn" name="submarine" id="submarine" value="UPDATE">

</td>
</tr>

<tr>
<td colspan="3" align="center"><?php print $error_message;?></td>
</tr>
</table>
</form>