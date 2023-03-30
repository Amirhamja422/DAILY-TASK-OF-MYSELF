<?php
include '../db.php';

$type = $_GET['type'];
$group_id = $_GET['group_id'];

if ( (!empty($type)) && (!empty($group_id)) ) {
  
  $update = mysql_fetch_object(mysql_query("SELECT * FROM `ticket_dev`.`ticket_type` WHERE `group_id`='".$group_id."' AND `type_name`='".$type."'"));

  echo $update->type_name;   

} else {

  echo "Field Can Not Blank!!";
}
