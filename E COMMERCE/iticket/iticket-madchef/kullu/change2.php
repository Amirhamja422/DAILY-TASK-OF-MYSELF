<?php
include '../db.php';
$sub_group = $_GET['sub_group'];
$sql = mysql_fetch_assoc(mysql_query("SELECT * FROM `sub_group` WHERE `id` = '".$sub_group."'"));
$group = mysql_query("SELECT * FROM `user_group` WHERE `id`='".$sql['user_group_id']."'");

while ($row = mysql_fetch_row($group)) { ?>
    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
<?php } ?>