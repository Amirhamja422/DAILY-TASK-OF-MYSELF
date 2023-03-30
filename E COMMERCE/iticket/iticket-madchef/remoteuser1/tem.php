<?php
$id=$_GET['q'];
include '../db.php';
$results=mysql_query("select massage FROM template where id=".$id);

$data_array=mysql_fetch_row($results);
       
           echo $data_array[0];
       

?>