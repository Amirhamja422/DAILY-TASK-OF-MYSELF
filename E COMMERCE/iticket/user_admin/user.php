<?php include'session.php'; ?>


<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>
<link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />



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
border-radius:3px;
width:380px;
height:25px;
border:none;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
}
</style>
<script src="dipu.js"></script>

<!-- <div align="center" class="TitleStyle">Manage Users</div><br>
 -->

<!-- <form action="user.php" method="post">
<table align="center" style="color:#000000; ">
<tr>
<td align="right">New User Name :</td><td><input type="text" name="uname" placeholder="New User Name" class="userdapa"></td>
</tr>
<tr>
<td align="right">User Designation :</td><td><input type="text" name="designa" placeholder="User Designation" class="userdapa"></td>
</tr>
<tr>
<tr>
<td align="right">Email ID :</td><td><input type="text" name="uemail" placeholder="User Email ID" class="userdapa"></td>
</tr>
<tr>
<td align="right">Phone Number :</td><td><input type="text" name="uphone" placeholder="01XXXXXXXXX" class="userdapa"></td> <td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000;"> Numeric (11 Digit with zero recommanded)</td>
</tr>
<tr>
<td align="right" style="color:#0000FF; font-weight:bolder;">User ID :</td><td><input type="text" name="uid" placeholder="User ID" class="userdapa"></td>
</tr>
<tr>
<td align="right" style="color:#0000FF; font-weight:bolder;">User Password :</td><td><input type="password" name="upass" placeholder="User Password" class="userdapa"></td>
</tr>
<tr>
<td align="right">Superiors :</td><td><input type="text" name="superi" placeholder="Nemeric Value's only (Superiors ID) Multiple comma separated" class="userdapa"></td> -->
</tr>
<!-- 
<tr>
<td align="right">Service:</td>
<td>
<select name="concern" class="userdapa">
<?php
include '../db.php';
$results=mysql_query("SELECT * FROM `ticket_type`");

  while($data_array=mysql_fetch_row($results))
       {
		print "<option value=\"".$data_array[1]."\">".$data_array[1]."</option>";
       }
?>
</select>
</td>
</tr>

<tr>
<td align="right">Department:</td>
<td align="center">
<select name="gi" class="userdapa">
<?php include 'bralist2group.php';?>
</select>
</td>

</tr>
<tr>
<td align="right">User Privileges :</td>
<td align="center">
<select name="prev" class="userdapa">
<option value="0">Administrator</option>
<option value="1">admin</option> -->
<!-- <option value="2">Only Report</option>
 --></select>
<!-- </td>
<td><input type="submit" name="usub" id="usub" value="Add" style="border-radius:5px;"></td>
</tr>
</table>
</form> -->

 -->
























<?php
if(isset($_POST['usub']))
{
include '../db.php';
$results=mysql_query("INSERT INTO `ticket`.`users` (`id`,`designation`,`superior_id`, `user_id`, `user_pass`, `user_name`, `user_email`, `user_group_id`, `previlege`,`phone`,`concern`) VALUES (NULL,'".$_POST['designa']."','".$_POST['superi']."', '".$_POST['uid']."','".$_POST['upass']."','".$_POST['uname']."','".$_POST['uemail']."','".$_POST['gi']."','".$_POST['prev']."','".$_POST['uphone']."','".$_POST['concern']."')");

print "<font face=\"Times New Roman, Times, serif\" color=\"#99FF33\">User Inserted Successfully.</font>";
}
?>




<div align="center">
<br>
<!-- <table style="border-radius:20px; border:1px; border:solid; width:75%; cursor:pointer; color:#999999;" align="center" class="anlepore">
<tr style="background-color:#0099CC; color:#FFFFFF;">
<td align="center">No.</td><td align="center">User</td><td align="center">Designation</td><td align="center">User Group</td><td align="center">Previlege</td><td title="Edit" align="center" style="border-top-right-radius:10px;"><img width="20" height="20" src="idebnath/100px-Gartoon-Gedit-icon.png" style="cursor:pointer;"></td><td title="Delete" align="center"><img src="idebnath/delete.png" style="cursor:pointer;"></td>

</tr>

<?php include 'bralist2.php'; ?>

</table>
 -->
</div>




















<script>
// Display an external page using an iframe
function smcollege(kuti)
{
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
var Y=50;
var src = "editmodal.php?q1="+kuti;
$.modal('<iframe src="' + src + '" height="480" width="830" style="border:0">', {
	closeHTML:"",
	appendTo: $(window.parent.document).find('body'),
	opacity:70,
	overlayCss: {backgroundColor:"#000"},
	containerCss:{
		backgroundColor:"#fff", 
		borderColor:"#000",
		borderRadius:15,
		height:510, 
		padding:0, 
		width:830
	},
	overlayClose:true,
	position: [Y,X],
	onOpen: function (dialog) {
	dialog.overlay.fadeIn('slow', function () {
		dialog.data.hide();
		dialog.container.fadeIn('slow', function () {
			dialog.data.slideDown('slow');	 
		});
	});
},
onClose: function (dialog) {
	dialog.data.fadeOut('slow', function () {
		dialog.container.hide('fast', function () {
			dialog.overlay.slideUp('fast', function () {
				$.modal.close();
			});
		});
	});
}

});

$(window.parent.document).find('#simplemodal-overlay').css('width', '100%');
}
</script>
