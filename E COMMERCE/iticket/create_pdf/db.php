<?php
$con = mysqli_connect("localhost","root","iHelpBD@2017","ticket");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>