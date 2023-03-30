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
Add &nbsp;<span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> &nbsp;Service
</div>

<form action="addService.php" method="post">

<table align="center" style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">

<tr>
<td align="right">Select Department :</td>
<td align="center">
<select name="department" id="department" class="userdapa form-control" required>
<?php
include '../db.php';

    $group = mysql_query("SELECT * FROM `user_group`");
    while($group_array=mysql_fetch_row($group)){ ?>
          <option value="<?php echo $group_array[0];?>"><?php echo $group_array[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>


<tr>
<td align="right">Service :</td>
<td>
<input type="text" name="type" placeholder="New Service" class="form-control">
</td>
</tr>

<tr>
<td align="right">SLA Time :</td>
<td>
<input type="number" name="hour_time" placeholder="SLA Time" class="form-control">
</td>
</tr>
</table>


<div align="center"><input type="submit" name="addtype" id="addtype" value="SAVE" style="border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;"></div>

</form>

<?php
if(isset($_POST['addtype']))
{
include '../db.php';

$second = ($_POST['hour_time']*3600);
$results=mysql_query("INSERT INTO ticket_type (`group_id`,`type_name`,`hour_time`) VALUES ('".$_POST['department']."','".$_POST['type']."','".$second."')");

print "<center><font face=\"Times New Roman, Times, serif\" color=\"red\">Type Inserted Successfully.</font><center>";
}
?>
