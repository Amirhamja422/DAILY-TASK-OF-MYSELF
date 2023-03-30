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
Add &nbsp;&nbsp;&nbsp;<span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> &nbsp;&nbsp;&nbsp;User
</div>

<form action="addUser.php" method="post">

<table align="center" style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
<tr>
<td align="right">New User Name :</td><td><input type="text" name="uname" placeholder="New User Name" class="form-control"></td>
</tr>
<tr>
<td align="right">User Designation :</td><td><input type="text" name="designa" placeholder="User Designation" class="form-control"></td>
</tr>
<tr>
<td align="right">Email ID :</td><td><input type="text" name="uemail" placeholder="User Email ID" class="form-control" ></td>
</tr>
<tr>
<td align="right">Phone Number :</td><td><input type="text" name="uphone" placeholder="01XXXXXXXXX" class="form-control"></td>
</tr>
<tr>
<td align="right">User ID :</td><td><input type="text" name="uid" placeholder="User ID" class="form-control"></td>
</tr>
<tr>
<td align="right">User Password :</td><td><input type="text" name="upass" placeholder="User Password" class="form-control"></td>
</tr>

<tr>
<td align="right">Department :</td>
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
<select name="concern" id="concern" class="form-control">
	<option value="">-Select A Service-</option>
</select>
</td>
</tr>


<tr>
<td align="right">User Privileges :</td>
<td align="center">
<select name="prev" class="form-control" >
<option value="0">Administrator</option>
<option value="2">Group Admin</option>
<option value="3">Report Update</option>
</select>
</td>
</tr>
</table>


<div align="center"><input type="submit" name="usub" id="usub" value="SAVE" style="border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;"></div>

</form>

<?php
if(isset($_POST['usub']))
{
include '../db.php';
$results=mysql_query("INSERT INTO `ticket_dev`.`users` (`id`,`designation`,`superior_id`, `user_id`, `user_pass`, `user_name`, `user_email`, `user_group_id`, `previlege`,`phone`,`concern`) VALUES (NULL,'".$_POST['designa']."','".$_POST['superi']."', '".$_POST['uid']."','".$_POST['upass']."','".$_POST['uname']."','".$_POST['uemail']."','".$_POST['department']."','".$_POST['prev']."','".$_POST['uphone']."','".$_POST['concern']."')");

print "<font face=\"Times New Roman, Times, serif\" color=\"red\" text-align=\"center\">User Inserted Successfully.</font>";
}
?>

<script type="text/javascript">
    $('#department').change(function(e){
        var gi = $("#department").val();
       
        $.ajax({
            data: "gi="+gi,
            url: "../kullu/changeTicketTypeByGroup.php",
            type: "GET",
            success: function(data){
                document.getElementById("concern").innerHTML = data;
            }
        });
    });
</script>
