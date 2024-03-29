<!DOCTYPE html>
<html>

<head>

  <meta charset="UTF-8">

  <title> Order Management </title>

  <style>
/*! normalize.css v3.0.2 | MIT License | git.io/normalize */html{font-family:sans-serif;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}body{margin:0}article,aside,details,figcaption,figure,footer,header,hgroup,main,menu,nav,section,summary{display:block}audio,canvas,progress,video{display:inline-block;vertical-align:baseline}audio:not([controls]){display:none;height:0}[hidden],template{display:none}a{background-color:transparent}a:active,a:hover{outline:0}abbr[title]{border-bottom:1px dotted}b,strong{font-weight:bold}dfn{font-style:italic}h1{font-size:2em;margin:0.67em 0}mark{background:#ff0;color:#000}small{font-size:80%}sub,sup{font-size:75%;line-height:0;position:relative;vertical-align:baseline}sup{top:-0.5em}sub{bottom:-0.25em}img{border:0}svg:not(:root){overflow:hidden}figure{margin:1em 40px}hr{-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box;height:0}pre{overflow:auto}code,kbd,pre,samp{font-family:monospace, monospace;font-size:1em}button,input,optgroup,select,textarea{color:inherit;font:inherit;margin:0}button{overflow:visible}button,select{text-transform:none}button,html input[type="button"],input[type="reset"],input[type="submit"]{-webkit-appearance:button;cursor:pointer}button[disabled],html input[disabled]{cursor:default}button::-moz-focus-inner,input::-moz-focus-inner{border:0;padding:0}input{line-height:normal}input[type="checkbox"],input[type="radio"]{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;padding:0}input[type="number"]::-webkit-inner-spin-button,input[type="number"]::-webkit-outer-spin-button{height:auto}input[type="search"]{-webkit-appearance:textfield;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;box-sizing:content-box}input[type="search"]::-webkit-search-cancel-button,input[type="search"]::-webkit-search-decoration{-webkit-appearance:none}fieldset{border:1px solid #c0c0c0;margin:0 2px;padding:0.35em 0.625em 0.75em}legend{border:0;padding:0}textarea{overflow:auto}optgroup{font-weight:bold}table{border-collapse:collapse;border-spacing:0}td,th{padding:0}

</style>

    <style>
/*@import url(http://fonts.googleapis.com/css?family=Open+Sans);*/
.btn { display: inline-block; *display: inline; *zoom: 1; padding: 4px 10px 4px; margin-bottom: 0; font-size: 13px; line-height: 18px; color: #333333; text-align: center;text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75); vertical-align: middle; background-color: #f5f5f5; background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6); background-image: -ms-linear-gradient(top, #ffffff, #e6e6e6); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6)); background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6); background-image: -o-linear-gradient(top, #ffffff, #e6e6e6); background-image: linear-gradient(top, #ffffff, #e6e6e6); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#ffffff, endColorstr=#e6e6e6, GradientType=0); border-color: #e6e6e6 #e6e6e6 #e6e6e6; border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25); border: 1px solid #e6e6e6; -webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px; -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); -moz-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05); cursor: pointer; *margin-left: .3em; }
.btn:hover, .btn:active, .btn.active, .btn.disabled, .btn[disabled] { background-color: #e6e6e6; }
.btn-large { padding: 9px 14px; font-size: 15px; line-height: normal; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px; }
.btn:hover { color: #333333; text-decoration: none; background-color: #e6e6e6; background-position: 0 -15px; -webkit-transition: background-position 0.1s linear; -moz-transition: background-position 0.1s linear; -ms-transition: background-position 0.1s linear; -o-transition: background-position 0.1s linear; transition: background-position 0.1s linear; }
.btn-primary, .btn-primary:hover { text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25); color: #ffffff; }
.btn-primary.active { color: rgba(255, 255, 255, 0.75); }
.btn-primary { background-color: #4a77d4; background-image: -moz-linear-gradient(top, #6eb6de, #4a77d4); background-image: -ms-linear-gradient(top, #6eb6de, #4a77d4); background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#6eb6de), to(#4a77d4)); background-image: -webkit-linear-gradient(top, #6eb6de, #4a77d4); background-image: -o-linear-gradient(top, #6eb6de, #4a77d4); background-image: linear-gradient(top, #6eb6de, #4a77d4); background-repeat: repeat-x; filter: progid:dximagetransform.microsoft.gradient(startColorstr=#6eb6de, endColorstr=#4a77d4, GradientType=0);  border: 1px solid #3762bc; text-shadow: 1px 1px 1px rgba(0,0,0,0.4); box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.5); }
.btn-primary:hover, .btn-primary:active, .btn-primary.active, .btn-primary.disabled, .btn-primary[disabled] { filter: none; background-color: #4a77d4; }
.btn-block { width: 100%; display:block; }

* { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

html { width: 100%; height:100%; overflow:hidden; }

body { 
	width: 100%;
	height:100%;
	font-family: 'Open Sans', sans-serif;
	background: #F8F8FF;
	background: -moz-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(255,245,238) 40%),-moz-linear-gradient(top,  rgba(57,173,219,.25) 0%, rgba(42,60,87,.4) 100%), -moz-linear-gradient(-45deg,  rgba(254, 22, 30, 1) 0%, #092756 100%);
	background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -webkit-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -webkit-linear-gradient(-45deg,  rgba(254, 22, 30, 1) 0%,#092756 100%);
	background: -o-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -o-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -o-linear-gradient(-45deg,  rgba(254, 22, 30, 1) 0%,#092756 100%);
	background: -ms-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), -ms-linear-gradient(top,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), -ms-linear-gradient(-45deg,  rgba(254, 22, 30, 1) 0%,#092756 100%);
	background: -webkit-radial-gradient(0% 100%, ellipse cover, rgba(104,128,138,.4) 10%,rgba(138,114,76,0) 40%), linear-gradient(to bottom,  rgba(57,173,219,.25) 0%,rgba(42,60,87,.4) 100%), linear-gradient(135deg,  rgba(254, 22, 30, 1) 0%,#092756 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#3E1D6D', endColorstr='#092756',GradientType=1 );
}
.login { 
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -150px 0 0 -150px;
	width:300px;
	height:300px;
}
.login h1 { color: #fff; 
text-shadow: 0 0 10px rgba(0,0,0,0.3); letter-spacing:1px; text-align:center; 
font-family: Georgia, "Times New Roman", Times, serif;
font-style: oblique; font-weight: bolder; font-size: 36px;
//color:#333333;
font-weight:bolder;


}

input { 
	width: 100%; 
	margin-bottom: 10px; 
	background: rgba(0,0,0,0.3);
	border: none;
	outline: none;
	padding: 10px;
	font-size: 13px;
	color: #fff;
	text-shadow: 1px 1px 1px rgba(0,0,0,0.3);
	border: 1px solid rgba(0,0,0,0.3);
	border-radius: 4px;
	box-shadow: inset 0 -5px 45px rgba(100,100,100,0.2), 0 1px 1px rgba(255,255,255,0.2);
	-webkit-transition: box-shadow .5s ease;
	-moz-transition: box-shadow .5s ease;
	-o-transition: box-shadow .5s ease;
	-ms-transition: box-shadow .5s ease;
	transition: box-shadow .5s ease;
}
input:focus { box-shadow: inset 0 -5px 45px rgba(100,100,100,0.4), 0 1px 1px rgba(255,255,255,0.2); }

.error{
color:#FF0000;
}

</style>

    <script src="js/prefixfree.min.js"></script>

</head>

<body style="background-image: url(madchef_tcheez.jpg); background-size: 100% 100%;">

  <div class="login">
	<h1 style="color: black; font-family:sans-serif;"><span></span> Order Management</h1>
    <form method="post">
    	<input type="text" name="uid" placeholder="Username" required="required" />
        <input type="password" name="pass" placeholder="Password" required="required" />
<!-- 		<input type="checkbox" name="agent_login" id="agent_login" style="width: 7%;" /> I am an Agent.
 -->        <button type="submit" class="btn btn-primary btn-block btn-large" name="logbtn" id="logbtn">Let me in.</button>
    </form>
	
	
	<!-- php Checking Start's Here -->
<?php
if(isset($_POST['logbtn']))
{
	include 'db.php';
	if(isset($_POST['agent_login'])){
		//print "<div align=\"center\"><label class=\"error\">Agent Login</label></div>";
		$RES=mysql_query("SELECT count(*),user,full_name,user_id,user_level FROM asterisk.vicidial_users where user='".$_POST['uid']."' && pass='".$_POST['pass']."'");
		$GH=mysql_fetch_array($RES);
		if($GH[0]==1){
			if($GH[4]>1){
				print "<div align=\"center\"><label class=\"error\">Only Agent can login</label></div>";
			} else if($GH[4]==1){
				session_start();
				//$_SESSION['agent_name'] = $_POST['uid'];
				$_SESSION['agent_name'] = $GH[2];
				$_SESSION['action'] = 'login_action';
				print "<meta http-equiv=\"refresh\" content=\"0; url=./agent_ticket_create.php\" />";
			}
		} else {
			print "<div align=\"center\"><label class=\"error\">Invalid User-id or Password</label></div>";
		}
	} else{
		$RES=mysql_query("SELECT count(*),user_group_id,user_name,id,previlege, brand, branch FROM users where user_id='".$_POST['uid']."' && user_pass='".$_POST['pass']."'");
		$GH=mysql_fetch_array($RES);
		if($GH[0]==1)
		{
			
			if($GH[4]==3){
				session_start();
				$_SESSION['usr01937417227'] = $_POST['uid'];
				$_SESSION['pswd01937417227'] = $_POST['pass'];
				$_SESSION['usr01937417227'] = $_POST['uid'];
				$_SESSION['pswd01937417227'] = $_POST['pass'];
				$_SESSION['id'] = $GH[3];
				$_SESSION['previlege'] = $GH[4];
				$_SESSION['group_id'] = $GH[1];
				$_SESSION['brand'] = $GH[5];
				$_SESSION['branch'] = $GH[6];
				print "<meta http-equiv=\"refresh\" content=\"0; url=iticket-madchef/reportsupdate/?i=".$GH[3]."\" />";
			}
			
			if($GH[4]==0){
				session_start();
				$_SESSION['usr01937417227'] = $_POST['uid'];
				$_SESSION['pswd01937417227'] = $_POST['pass'];
				$_SESSION['usr01937417227'] = $_POST['uid'];
				$_SESSION['pswd01937417227'] = $_POST['pass'];
				print "<meta http-equiv=\"refresh\" content=\"0; url=admin/?i=".$GH[3]."\" />";
			}
		}
		else
		{
			print "<div align=\"center\"><label class=\"error\">Invalid User-id or Password</label></div>";
		}
	}
}
?>	
</div>
  <script src="js/index.js"></script>
<?php include 'footeri.php';?>
</body>
</html>