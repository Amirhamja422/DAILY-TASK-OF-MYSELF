<?php
include '../db.php';

$uid = $_GET['uid'];

if (!empty($uid)) {
  
  $update = mysql_fetch_object(mysql_query("SELECT * FROM `ticket_dev`.`users` WHERE `user_id`='".$uid."'"));

  echo $update->user_id;

} else {

  echo "Field Can Not Blank!!";
}
