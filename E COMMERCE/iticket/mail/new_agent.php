<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<script type="text/javascript">
function validate(){
    x=document.myForm
    input=x.myInput.value
	var ck_password =  /^[!@#$%^&*()_]{}$/
    if (input.length !=8 && !ck_password.test(input) ){
        alert("Password length cann't be more or less then 8 character!")
        return false
    }else {
        return true
    }
}

function validate1(){
var iChars = "!@#$%^&*()+=-[]\\\';,./{}|\":<>?";

for (var i = 0; i < document.myForm.myInput.value.length; i++) {
    if (iChars.indexOf(document.myForm.myInput.value.charAt(i)) != -1)
	 {
	var flag="1"; 
	//if(flag =="1")
	//{
	 // alert ("Provide your password with special character.");
	//}
	//else
        //alert ("Your username has special characters. \nThese are not allowed.\n Please remove them and try again.");
   
    }
	///else
	//alert ("Provide your password with special character.");
		//return false;
   }
   
   if(flag =="1")
   {
  //alert ("Provide your password with special character.");
   }
	else
    alert ("YProvide your password with special character.");
 
}
</script>



    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iDialer</title>
<style type="text/css">
<!--
body {
	background-image: url(background.png);
	background-repeat: repeat;
}
.style1 {
	color: #003399;
	font-weight: bold;
}
.style2 {
	color: #330066;
	font-weight: bold;
}
-->
</style></head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="412" border="0" align="center"  style="overflow: auto; border:1px solid #555;border-radius:10px; height:400px; width:400px; margin-top:-75px;  background-repeat:no-repeat; background-size:100%; background-size:cover;">
  <tr>
    <td valign="top"><h4 class="style1">New agent</h4>    </td>
  </tr>
  <tr>
    <td height="239" valign="top"><form id="myForm" name="myForm" method="post" action="new_agent.php" >
      <table width="352" height="118%" border="0" align="center">
        <tr>
          <td width="150"><h5 class="style2">Username/ID</h5></td>
          <td width="192"><input name="id" type="text" class="form-control" id="id" required/></td>
        </tr>
        <tr>
          <td><h5 class="style2">Password</h5></td>
          <td><input name="myInput" type="text"  class="form-control" id="myInput" maxlength="8" required/></td>
        </tr>
        <tr>
          <td><h5 class="style2">Full name </h5></td>
          <td><input name="name" type="text" class="form-control" id="name" required/></td>
        </tr>
        <tr>
          <td height="24"><h5 class="style2">Security question </h5></td>
          <td><select name="question" id="question" class="form-control" required>
            <option>--Select--</option>
            <option value="Where you born?">Where you born?</option>
            <option value="Who is your favourite  person?">Who is your favourite person?</option>
            <option value="Whats your favourite color?">Whats your favourite color?</option>
          </select>          </td>
        </tr>
        <tr>
          <td height="24" class="style2"><h5 class="style2">Answer</h5></td>
          <td><input name="answer" type="text" class="form-control" id="answer" required/></td>
        </tr>
        <tr>
          <td><h5 class="style2">E-mail</h5></td>
          <td><input name="mail" type="email" id="mail" class="form-control" required/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><table width="192" border="0">
              <tr>
                <td width="119">&nbsp;</td>
                <td width="63"><input type="submit" name="Submit" value="Submit" class="btn btn-primary"/></td>
              </tr>
          </table></td>
        </tr>
      </table>
	  <?php
if(isset($_POST['Submit']))
{
include 'db.php';  mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$date = date("Y-m-d");
$results=mysql_query("INSERT INTO `agents` (`agent_id`,`agent_password`,`agent_name`,`security_question`, `security_answer`, `mail`, `status`) VALUES ('".$_POST['id']."', '".$_POST['myInput']."', '".$_POST['name']."', '".$_POST['question']."', '".$_POST['answer']."', '".$_POST['mail']."', 'no')");
}
?>
	  
	  
    </form>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table> 





<?php
require_once('PHPMailerAutoload.php');

$to="juboraj4all@gmail.com";
$body="Password Activation Link Here";
$phpmailer          = new PHPMailer();


$phpmailer->IsSMTP(); // telling the class to use SMTP
$phpmailer->Host       = "mail.myolbd.com"; // SMTP server  "ssl://smtp.gmail.com";
$phpmailer->SMTPAuth   = true;                  // enable SMTP authentication
$phpmailer->Port       = 25;          // set the SMTP port for the GMAIL server; 465 for ssl and 587 for tls  465
$phpmailer->Username   = "ccadmin@myolbd.com"; // Gmail account username
$phpmailer->Password   = "NN@@2010";        // Gmail account password

$phpmailer->SetFrom('ccadmin@myolbd.com', 'MYOL Call Center'); //set from name

$phpmailer->Subject    = "Password Activation";
$phpmailer->MsgHTML($body);

$phpmailer->AddAddress($to, "To Name");

if(!$phpmailer->Send()) {
  echo "Mailer Error: " . $phpmailer->ErrorInfo;
} else {
  echo "Message sent!";
}



?>
</body>
</html>



