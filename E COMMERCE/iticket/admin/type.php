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
color:#FFFFFF;
}
.userdapa{
border-radius:5px;
}
.userdapa1 {border-radius:5px;
}
</style>
<script src="dipu.js"></script>

<div align="center" class="TitleStyle">Manage Brand &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>


<form action="type.php" method="post">
  <table align="center" style="color:#000000;">

    <tr> </tr>


    <tr>
      <td align="right">Add Brand :</td>
      <td align="center"><input name="type" type="text" id="type" /></td>
      <td><input type="submit" name="addtype" id="addtype" value="Add" style="border-radius:5px;" /></td>
    </tr>
  </table>
</form>





<?php
if(isset($_POST['addtype']))
{
include '../db.php';
$results=mysql_query("INSERT INTO ticket_type (`type_name`) VALUES ('".$_POST['type']."')");

print "<font face=\"Times New Roman, Times, serif\" color=\"#99FF33\">Type Inserted Successfully.</font>";
}
?>
<br>



<div align="center">
<br><br>
<table style="border-radius:20px; border:1px; border:solid; width:75%; cursor:pointer; color:#999999;" align="center" class="anlepore">
<tr style="background-color:#0099CC; color:#FFFFFF;">
<td align="center">No.</td><td align="center">Type</td><td title="Delete" align="center"><img src="idebnath/delete.png" style="cursor:pointer;"></td>

</tr>

<?php include 'bralist2type.php'; ?>

</table>

</div>
