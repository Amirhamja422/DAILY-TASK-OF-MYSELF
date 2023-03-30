<?php
include 'db.php';
require 'PHPMailer/PHPMailerAutoload.php';
$array = array();
$sql = mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE `status` = 'New' AND `sla_8` < '".date("Y-m-d H:i:s")."' AND `sla_8_stat` = '0' ORDER BY `id` DESC LIMIT 1");

  while ($row = mysql_fetch_assoc($sql)) {

  	$user = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_dev`.`users` WHERE `id`='".$row['assignd']."'"));
  	$group = mysql_query("SELECT * FROM `ticket_dev`.`users` WHERE `user_group_id`='".$row['group']."' AND `previlege`='2'");
  	while ($group_ad = mysql_fetch_assoc($group)) {
  			array_push($array, $group_ad['id']);
  	}
  	array_push($array, $row['assignd'], 'nazmulalam@abbl.com');
  	$list = implode(', ', $array);
  	$user = mysql_query("SELECT * FROM `ticket_dev`.`users` WHERE `id` IN (".$list.")");

  	$mail = new PHPMailer;
	$mail->SMTPDebug = 3;                                 // Enable verbose debug output
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'host13.registrar-servers.com';  		 // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'support@rainbowcloths.com';             // SMTP username
	$mail->Password = '!QX5Yr_qm)0A';                     // SMTP password
	$mail->Port = 26;                                    // TCP port to connect to
	$mail->setFrom('support@rainbowcloths.com', 'ABBLCC');   // Sender email address

	  while ($user_mail = mysql_fetch_assoc($user)) {
          $mail->addAddress($user_mail['user_email'], $user_mail['user_name']);
      }

	$mail->Subject = "Complaint not assigned within 8 working hours";
	$mail_body = "Dear Concern,<br>Complaint ref# ".$row['id']." has not been assigned in last 8 working hours. Please take appropriate action.<br><br>Thank You! <br>Customer Service Team";
	$mail->Body    =  stripslashes ($mail_body);

	if(!$mail->send()) {
		echo "Not Ok";
	} else {
		echo "Email Send Successfully!!";
		mysql_query("UPDATE `ticket_dev`.`ticket` SET `sla_8_stat` = '1' WHERE `id` = '".$row['id']."'");
	}
  }

?>