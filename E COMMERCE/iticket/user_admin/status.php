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
.userdapa1 {border-radius:5px;
}
</style>
<script src="dipu.js"></script>

<div align="center" class="TitleStyle">Manage Ticket status &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>


<form action="status.php" method="post">
  <table align="center" style="color:#000000;">
    
    <tr> </tr>
    
    
    <tr>
      <td align="right">Add new ticket status :</td>
      <td align="center"><input name="name" type="text" id="name" /></td>
      <td><input type="submit" name="addname" id="addname" value="Add" style="border-radius:5px;" /></td>
    </tr>
  </table>
</form>


























<?php
if(isset($_POST['addname']))
{
include '../db.php';
$results=mysql_query("INSERT INTO ticket_status (status_name) VALUES ('".$_POST['name']."')");

print "<font face=\"Times New Roman, Times, serif\" color=\"#99FF33\">Status Inserted Successfully.</font>";
}
?>
<br>



<div align="center">
<br><br>
<table style="border-radius:20px; border:1px; border:solid; width:75%; cursor:pointer; color:#999999;" align="center" class="anlepore">
<tr style="background-color:#0099CC; color:#FFFFFF;">
<td align="center">No.</td><td align="center">Type</td><td title="Delete" align="center"><img src="idebnath/delete.png" style="cursor:pointer;"></td>

</tr>

<?php include 'bralist2status.php'; ?>

</table>

</div>