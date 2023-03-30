<?php
include '../db.php';
$id = $_GET['id'];

$sql = mysql_query("SELECT * FROM `users` WHERE `user_group_id`='".$id."'");

    echo '<option value="">-Select More Recever-</option>';
while ($row = mysql_fetch_row($sql)) { ?>
    <option value="<?php echo $row[0] ?>"><?php echo $row[2] ?></option>
<?php } ?>