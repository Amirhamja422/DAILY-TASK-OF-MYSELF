<?php
include '../db.php';
$id = $_GET['id'];
$concern_ready = $_GET['concern_ready'];
$sql2 = mysql_query("SELECT * FROM `ticket_type` WHERE `group_id`='".$id."'");

  echo '<option value="">-Select A Service-</option>';
while ($row = mysql_fetch_row($sql2)) { ?>
  <option value="<?php echo $row[0] ?>" <?php if($row[0] == $concern_ready){echo "Selected";} ?> ><?php echo $row[1] ?></option>
<?php } ?>