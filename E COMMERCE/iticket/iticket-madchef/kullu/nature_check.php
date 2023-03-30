<?php
include '../db.php';

$type_id = $_GET['type_id'];
$nature = $_GET['nature'];

if ( (!empty($type_id)) && (!empty($nature)) ) {
  
  $update = mysql_fetch_object(mysql_query("SELECT * FROM `ticket_dev`.`nature_complaint` WHERE `nature`='".$nature."' AND `type_id`='".$type_id."'"));

  echo $update->nature;   

} else {

  echo "Field Can Not Blank!!";
}
