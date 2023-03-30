<?php include'session.php'; ?>
<style type="text/css">
.TitleStyle {
	color: #666666;
	font-weight: bold;
	font-size:24px;
}
.dropdown{
border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-left-radius:5px;
border-bottom-right-radius:5px;
}
.anlepore tr:hover{
background-color:#999999;
}
.anlepore tr{
background-color:rgba(49, 94, 64, 0.6);
color:#000000;
}
.userdapa{
border-radius:5px;
}
</style>
<script src="dipu.js"></script>

<div align="center" class="TitleStyle">Manage User Groups&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>


<form action="ug.php" method="post">
<table align="center" style="color:#000000;">
<tr>
<td align="right">New User Group Name :</td>
<td><input type="text" name="uname" placeholder="New User Group" class="userdapa"></td>
</tr>




<tr>
<td align="right">&nbsp;</td>
<td align="left"><input type="submit" name="usub" id="usub" value="Add" style="border-radius:5px;">
</td>
<td>&nbsp;</td>
</tr>
</table>
</form>


























<?php
if(isset($_POST['usub']))
{
include '../db.php';
$results=mysql_query("INSERT INTO `ticket`.`user_group` (`id`, `group_name`) VALUES (NULL, '".$_POST['uname']."')");

print "<font face=\"Times New Roman, Times, serif\" color=\"#99FF33\">User Group Inserted Successfully.</font>";
}
?>
<br>



<div align="center">
<br><br>
<table style="border-radius:20px; border:1px; border:solid; width:75%; cursor:pointer; color:#999999;" align="center" class="anlepore">
<tr style="background-color:#0099CC; color:#FFFFFF;">
<td align="center">No.</td><td align="center">User Group</td><td title="Delete" align="center"><img src="idebnath/delete.png" style="cursor:pointer;"></td>

</tr>

<?php include 'uglist.php'; ?>

</table>

</div>