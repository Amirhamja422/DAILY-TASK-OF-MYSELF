<?php
$servername = "localhost";
$username = "root";
$password = "iHelpBD@2017";

try {
  $connect = new PDO("mysql:host=$servername;dbname=ticket", $username, $password);
  // set the PDO error mode to exception
  $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>