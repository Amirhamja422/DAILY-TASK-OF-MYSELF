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
$results=mysql_query("SELECT * FROM sub_group where id=".$_POST['q1']);
$data_array=mysql_fetch_row($results);
$Global_id=$_POST['q1'];
}
else
{
$results=mysql_query("SELECT * FROM sub_group where id=".$_GET['q1']);
$data_array=mysql_fetch_row($results);
$Global_id=$_GET['q1'];
}
?>

<div align="center" style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bolder;">
Update &nbsp;&nbsp;&nbsp;<span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> &nbsp;&nbsp;&nbsp;User Details
</div>



<form action="editmodal_isu.php" method="post">
<input type="hidden" name="q1" value="<?php print $Global_id;?>">


<table align="center" style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
<!-- <tr>
<td align="right">No :</td><td><input type="text" name="user_id" id="user_id" placeholder="Serial No." class="form-control" value="<?php //print $data_array[0];?>"></td>
</tr> -->
<!-- <tr>
<td align="right">Group :</td><td><input type="text" name="group_id" id="group_id" placeholder="Group" class="form-control" value="<?php //print $data_array[3];?>"></td>
</tr> -->
<tr>
<td align="right">Issue :</td><td><input type="text" name="sub_group_name" id="sub_group_name" placeholder="Issue" class="form-control" value="<?php print $data_array[3];?>"></td>
</tr>

</table>





<div align="center"><input type="submit" name="NP" id="NP" value="UPDATE" style="border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;"></div>

</form>



<?php
if(isset($_POST['NP']))
{
$results=mysql_query("UPDATE `ticket_dev`.`sub_group` SET `sub_group_name` = '".$_POST['sub_group_name']."'  WHERE `sub_group`.`id` = ".$Global_id." LIMIT 1");

print "<div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#003300\">User Updated Successfully.</font></div>";
}
?>