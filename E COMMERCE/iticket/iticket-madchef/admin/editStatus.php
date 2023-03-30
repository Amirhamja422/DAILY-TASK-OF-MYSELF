<link href="bootstrap.min.css" rel="stylesheet">


<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>
<link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />

<style type="text/css">
.brand {
font-family: Georgia, "Times New Roman", Times, serif;
font-style: oblique; font-weight: bolder; font-size: 36px;
color:#333333;
font-weight:bolder;
//position:absolute;
//left:10px;
//bottom:30px;
//text-shadow:1px 0px 5px #000000;
}
</style>

<?php
include '../db.php';
if(isset($_POST['NP']))
{
$results=mysql_query("SELECT * FROM `ticket_dev`.`ticket_status` where id=".$_POST['q1']);
$data_array=mysql_fetch_row($results);
$Global_id=$_POST['q1'];
}
else
{
$results=mysql_query("SELECT * FROM `ticket_dev`.`ticket_status` where id=".$_GET['q1']);
$data_array=mysql_fetch_row($results);
$Global_id=$_GET['q1'];
}

?>

<div align="center" style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bolder;">
Add &nbsp;&nbsp;&nbsp;<span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> &nbsp;&nbsp;&nbsp;Status
</div>

<form action="editStatus.php" method="post">
<input type="hidden" name="q1" value="<?php print $Global_id;?>">

<table align="center" style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
<tr>
<td align="right">New Status :</td><td><input type="text" name="name" value="<?php echo $data_array[1]; ?>" placeholder="New Status" class="form-control"></td>
</tr>


</table>


<div align="center"><input type="submit" name="addname" id="addname" value="SAVE" style="border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;"></div>

</form>

<?php
if(isset($_POST['addname']))
{

	$results=mysql_query("UPDATE `ticket_dev`.`ticket_status` SET `status_name` = '".$_POST['name']."' WHERE `id` = ".$_POST['q1']." LIMIT 1");

	print "<div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#003300\">Status Updated Successfully.</font></div>";
}
?>
