<?php
include '../db.php';
$id = $_GET['id'];
$type_id = $_GET['type_id'];

$sql = mysql_query("SELECT * FROM `users` WHERE `user_group_id`='".$id."' AND `concern`='".$type_id."' AND (`previlege`='2' OR `previlege`='3')");

  echo '<option value="">-Select A Receiver-</option>';
while ($row = mysql_fetch_row($sql)) { ?>
  <option value="<?php echo $row[0] ?>"><?php echo $row[3] ?></option>
<?php } ?>