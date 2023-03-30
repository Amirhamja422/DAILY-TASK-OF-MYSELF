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
include '../db.php';
session_start();
if(isset($_POST['addtype'])){
	
	$pad_user = $_SESSION['id'];
	
	$oldpass = $_POST['oldpass'];
	$newpass = $_POST['newpass'];
	
	$count = mysql_num_rows(mysql_query("SELECT * FROM `users` WHERE `id`='".$pad_user."' AND `user_pass`='".$oldpass."'"));
	
	if($count==1){
		
		$update = mysql_query("UPDATE `users` SET `user_pass` = '".$newpass."' WHERE `id`='".$pad_user."'");
		
		if($update){
			$_SESSION['msg'] = "Password Update Successful.";
		}
		
	} else {
		
		$_SESSION['err'] = "Old Password Not Match!";
		
	}	
}


?>
<div align="center" class="TitleStyle">Change Password &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>
<div align="center" class="TitleStyle"><?php if($_SESSION['msg']){echo $_SESSION['msg'];} else if($_SESSION['err']){echo $_SESSION['err'];}?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>


<form action="pass.php" method="post">
  <table align="center" style="color:#000000;">
    
	  <tr>
		 <td align="right" style="color:#0000FF; font-weight:bolder;">Old Password :</td><td><input type="password" name="oldpass" placeholder="Old Password" class="userdapa" required></td>
	  </tr>
	  
	  <tr>
		 <td align="right" style="color:#0000FF; font-weight:bolder;">New Password :</td><td><input type="password" name="newpass" placeholder="New Password" class="userdapa" required></td>
	  </tr>
	  
     <tr><td></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="addtype" id="addtype" value="Change" style="border-radius:5px;" /></td></tr>
  </table>
</form>
<br>


<?php
unset($_SESSION['err']);
unset($_SESSION['msg']);

?>