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
$results=mysql_query("SELECT * FROM users where id=".$_POST['q1']);
$data_array=mysql_fetch_row($results);
$Global_id=$_POST['q1'];
}
else
{
$results=mysql_query("SELECT * FROM users where id=".$_GET['q1']);
$data_array=mysql_fetch_row($results);
$Global_id=$_GET['q1'];
}
?>

<div align="center" style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bolder;">
Update &nbsp;&nbsp;&nbsp;<span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> &nbsp;&nbsp;&nbsp;User Details
</div>



<form action="editmodal.php" method="post">
<input type="hidden" name="q1" value="<?php print $Global_id;?>">


<table align="center" style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
<tr>
<td align="right">New User Name :</td><td><input type="text" name="uname" placeholder="New User Name" class="form-control" value="<?php print $data_array[3];?>"></td>
</tr>
<tr>
<td align="right">User Designation :</td><td><input type="text" name="designa" placeholder="User Designation" class="form-control" value="<?php print $data_array[8];?>"></td>
</tr>
<tr>
<td align="right">Email ID :</td><td><input type="text" name="uemail" placeholder="User Email ID" class="form-control" value="<?php print $data_array[4];?>"></td>
</tr>
<tr>
<td align="right">Phone Number :</td><td><input type="text" name="uphone" placeholder="01XXXXXXXXX" class="form-control" value="<?php print $data_array[11];?>"></td>
</tr>
<tr>
<td align="right">User ID :</td><td><input type="text" name="uid" placeholder="User ID" class="form-control" value="<?php print $data_array[1];?>"></td>
</tr>
<tr>
<td align="right">User Password :</td><td><input type="text" name="upass" placeholder="User Password" class="form-control" value="<?php print $data_array[2];?>"></td>
</tr>
<!-- <tr>
<td align="right">Superiors :</td><td><input type="text" name="superi" placeholder="Superiors" class="form-control" value="<?php print $data_array[7];?>"></td>
</tr> -->

<tr>
<td align="right">Department :</td>
<td align="center">
<select name="gi" id="edit_gi" class="userdapa form-control" required>
<?php
include '../db.php';

	$group = mysql_query("SELECT * FROM `user_group`");
	while($group_array=mysql_fetch_row($group)){ ?>
		  <option value="<?php echo $group_array[0];?>" <?php if($group_array[0] == $data_array[5]){echo "selected";} ?> ><?php echo $group_array[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>


<tr>
<td align="right">Service :</td>
<td>
<select name="concern" id="edit_concern" class="form-control">
<?php
include '../db.php';
$service = mysql_query("SELECT * FROM `ticket_type`");

  while($service_array=mysql_fetch_row($service)) { ?>
		<option value="<?php echo $service_array[0]; ?>" <?php if($service_array[0] == $data_array[12]){echo "selected";} ?> ><?php echo $service_array[1]; ?></option>
<?php } ?>
</select>
</td>
</tr>


<tr>
<td align="right">User Privileges :</td>
<td align="center">
<select name="prev" class="form-control" >
<option value="0" <?php if($data_array[6] == 0){echo "selected";} ?> >Administrator</option>
<option value="2" <?php if($data_array[6] == 2){echo "selected";} ?> >Group Admin</option>
<option value="3" <?php if($data_array[6] == 3){echo "selected";} ?> >Report Update</option>
</select>
</td>
</tr>
</table>





<div align="center"><input type="submit" name="NP" id="NP" value="UPDATE" style="border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;"></div>

</form>

                









<!--<div class="close"><a href="#" class="simplemodal-close">x</a></div>-->
<!--<p><button class="simplemodal-close">Close</button> <span>(or press ESC or click the overlay)</span></p>-->


<?php
if(isset($_POST['NP']))
{
$results=mysql_query("UPDATE `ticket_dev`.`users` SET `user_id` = '".$_POST['uid']."', `user_pass` = '".$_POST['upass']."', `user_name` = '".$_POST['uname']."', `user_email` = '".$_POST['uemail']."', `user_group_id` = '".$_POST['gi']."', `previlege` = '".$_POST['prev']."', `superior_id` = '".$_POST['superi']."', `designation` = '".$_POST['designa']."', `phone` = '".$_POST['uphone']."', `concern` = '".$_POST['concern']."' WHERE `users`.`id` = ".$Global_id." LIMIT 1");

print "<div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#003300\">User Updated Successfully.</font></div>";
}
?>

<script type="text/javascript">
	$('#edit_gi').change(function(e){
		var gi = $("#edit_gi").val();
	   
		$.ajax({
			data: "gi="+gi,
			url: "../kullu/changeTicketTypeByGroup.php",
			type: "GET",
			success: function(data){
				document.getElementById("edit_concern").innerHTML = data;
			}
		});
	});
</script>