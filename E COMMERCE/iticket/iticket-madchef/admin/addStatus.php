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

<div align="center" style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bolder;">
Add &nbsp;&nbsp;&nbsp;<span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> &nbsp;&nbsp;&nbsp;Status
</div>

<form action="addStatus.php" method="post">

<table align="center" style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
<tr>
<td align="right">New Status :</td><td><input type="text" name="name" placeholder="New Status" class="form-control"></td>
</tr>


</table>


<div align="center"><input type="submit" name="addname" id="addname" value="SAVE" style="border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;"></div>

</form>

<?php
if(isset($_POST['addname']))
{
include '../db.php';
$results=mysql_query("INSERT INTO `ticket_dev`.`ticket_status` (status_name) VALUES ('".$_POST['name']."')");

print "<center><font face=\"Times New Roman, Times, serif\" color=\"#99FF33\">Status Inserted Successfully.</font></center>";
}
?>
