<?php
include '../db.php';
$q = intval($_GET['q']);

$results=mysql_query("SELECT `user_name` FROM `users` where `id` = (select `di` from `users` where `id`=".$q.")");

$data_array=mysql_fetch_row($results);
       
           if($data_array[0]!="") echo "District Inspector for Selected Shop : <strong>".$data_array[0]."</strong>.";
		   else echo "";
       
?>