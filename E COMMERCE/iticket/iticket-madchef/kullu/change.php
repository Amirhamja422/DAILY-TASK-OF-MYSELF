<?php
include '../db.php';
$sub_group = $_GET['sub_group'];
$sql = mysql_fetch_assoc(mysql_query("SELECT * FROM `sub_group` WHERE `id` = '".$sub_group."'"));

$user = mysql_query("SELECT * FROM `users` WHERE `complain_id` LIKE '%".$sql['id']."%' AND `previlege`!='0' AND `previlege`!='2'");

$count = mysql_num_rows($user);

if ($count > 0) {
	while ($row = mysql_fetch_row($user)) { ?>
	<option value="<?php echo $row[0] ?>"><?php echo $row[3] ?></option>
<?php } } else { ?>
	<option value="">No User Found</option>
<?php } ?>