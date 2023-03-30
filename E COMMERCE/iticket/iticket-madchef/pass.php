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
border-radius:5px;
}
.userdapa1 {border-radius:5px;
}
</style>

<script src="dipu.js"></script>
<?php
session_start();
if(isset($_POST['addtype'])){
	
	$pad_user = $_SESSION['id'];
	
	$oldpass = $_POST['oldpass'];
	$newpass = $_POST['newpass'];
	
	$count = mysql_num_rows(mysql_query("SELECT * FROM users WHERE id=".$pad_user." AND user_pass=".$oldpass.""));
	
	if($count==1){
		
		echo "found";
		
	} else {
		echo "not found";
	}
	
	
}


?>
<div align="center" class="TitleStyle"><?php print_r($_SESSION['id']);?>Change Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>


<form action="pass.php" method="post">
  <table align="center" style="color:#000000;">
    
	  <tr>
		 <td align="right" style="color:#0000FF; font-weight:bolder;">Old Password :</td><td><input type="password" name="oldpass" placeholder="Old Password" class="userdapa" required></td>
	  </tr>
	  
	  <tr>
		 <td align="right" style="color:#0000FF; font-weight:bolder;">New Password :</td><td><input type="password" name="newpass" placeholder="New Password" class="userdapa" required></td>
	  </tr>
	  
     <tr><td><input type="submit" name="addtype" id="addtype" value="Change" style="border-radius:5px;" /></td></tr>
  </table>
</form>
<br>



<div align="center">
<br><br>
<table style="border-radius:20px; border:1px; border:solid; width:75%; cursor:pointer; color:#999999;" align="center" class="anlepore">
<tr style="background-color:#0099CC; color:#FFFFFF;">
<td align="center">No.</td><td align="center">Department</td><td align="center">Service</td><td align="center">Concern Person</td><td align="center">SLA Time</td><td title="Edit" align="center" style="border-top-right-radius:10px;"><img width="20" height="20" src="idebnath/100px-Gartoon-Gedit-icon.png" style="cursor:pointer;"></td><td title="Delete" align="center"><img src="idebnath/delete.png" style="cursor:pointer;"></td>

</tr>

</table>
</div>