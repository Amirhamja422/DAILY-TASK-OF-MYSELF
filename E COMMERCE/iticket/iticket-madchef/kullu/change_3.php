<?php
include '../db.php';
$id = $_GET['id'];
$type = $_GET['type'];
$sql2 = mysql_query("SELECT * FROM `sub_group` WHERE `user_group_id`='".$id."' AND `ticket_type_id`='".$type."'");

    echo '<option value="">-Select A Issue-</option>';
while ($row = mysql_fetch_row($sql2)) { ?>
    <option value="<?php echo $row[0] ?>"><?php echo $row[3] ?></option>
<?php } ?>