<?php
require_once('PHPMailerAutoload.php');
$to=$_GET['to'];//"s.debnath.net@gmail.com";
$body=$_GET['msg'];//"Hey Man !!!!!!!!!!!!!!!!  This is TEst Mail";
//$to="dipak.cse.diu@gmail.com";
//$body="This is TEst Mail";
$phpmailer          = new PHPMailer();
$phpmailer->IsSMTP();
$phpmailer->Host       = "mail.ihelpbd.com";
$phpmailer->SMTPAuth   = true;
$phpmailer->Port       = 25;
$phpmailer->Username   = "dipak@ihelpbd.com";
$phpmailer->Password   = "dipak@123";
$phpmailer->SetFrom('dipak@ihelpbd.com', 'Customer Relations Department'); //set from name
$phpmailer->addReplyTo('dipak@ihelpbd.com', 'Customer Relations Department');

/*$phpmailer->IsSMTP(); // telling the class to use SMTP
$phpmailer->Host       = "pranrflgroup.com";//"ssl://smtp.gmail.com"; // SMTP server  "ssl://smtp.gmail.com";  ////
$phpmailer->SMTPAuth   = true;                  // enable SMTP authentication
$phpmailer->Port       = 25;//465;          // set the SMTP port for the GMAIL server; 465 for ssl and 587 for tls  465  25;
$phpmailer->Username   = "crd@pranrflgroup.com";//"crd.prangroup@gmail.com"; // Gmail account username   "crd@prangroup.net//";//
$phpmailer->Password   = "pran@@crd951753";//"burhan@2060";        // Gmail account password  "crd74710";//

$phpmailer->SetFrom('crd@pranrflgroup.com', 'Customer Relations Department'); //set from name
$phpmailer->addReplyTo('crd@pranrflgroup.com', 'Customer Relations Department');
*/

$phpmailer->Subject    = "iTicket Reminder";
$phpmailer->MsgHTML($body);

$phpmailer->AddAddress($to, "");
$phpmailer->Send();
if(!$phpmailer->Send()) {
  echo "Mailer Error: " . $phpmailer->ErrorInfo;
} else {
  echo "Message sent!";
}




?>