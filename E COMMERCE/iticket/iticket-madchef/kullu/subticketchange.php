<?php
include '../db.php';
$id = $_GET['id'];

$sql = mysql_query("SELECT * FROM `ticket_type` WHERE `group_id`='".$id."'");

	echo '<option value="">-Select A Ticket Type-</option>';
while ($row = mysql_fetch_row($sql)) { ?>
	<option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
<?php } ?>