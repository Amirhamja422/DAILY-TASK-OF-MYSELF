<?php
include '../db.php';
$id = $_GET['id'];

$sql2 = mysql_query("SELECT * FROM `sub_group` WHERE `user_group_id`='".$id."'");

  echo '<option value="">-Select A Service-</option>';
while ($row = mysql_fetch_row($sql2)) { ?>
  <option value="<?php echo $row[0] ?>"><?php echo $row[3] ?></option>
<?php } ?>