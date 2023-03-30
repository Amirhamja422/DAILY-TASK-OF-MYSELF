<?php
include '../db.php';

$sub_group = trim($_GET['sub_group']); 

$sql = mysql_query("SELECT * FROM `nature_complaint` WHERE `type`='".$sub_group."'");

while ($row = mysql_fetch_row($sql)) { ?>
  <option value="<?php echo $row[2] ?>"><?php echo $row[2] ?></option>  
<?php } ?>