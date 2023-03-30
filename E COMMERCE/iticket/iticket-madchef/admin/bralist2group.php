<?php include'session.php'; ?>
<?php
include '../db.php';

$results=mysql_query("SELECT * FROM `user_group`");
print "<option value=\""." "."\" selected disabled>"."Select A Group"."</option>";

  while($data_array=mysql_fetch_row($results))
       {
		print "<option value=\"".$data_array[0]."\">".$data_array[1]."</option>";
       }

?>