<?php
include '../db.php';
$sub_group = $_GET['sub_group'];
$sql = mysql_fetch_assoc(mysql_query("SELECT * FROM `sub_group` WHERE `id` = '".$sub_group."'"));
$service = mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$sql['ticket_type_id']."'");

while ($row = mysql_fetch_row($service)) { ?>
    <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
<?php } ?>