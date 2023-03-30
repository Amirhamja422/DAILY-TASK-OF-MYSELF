<?php
include 'db.php';

$results=mysql_query("SELECT * FROM `theme`");


  while($data_array=mysql_fetch_row($results))
       {
		print $data_array[1];//"<option value=\"".$data_array[0]."\">".$data_array[1]."</option>";
       }

?>