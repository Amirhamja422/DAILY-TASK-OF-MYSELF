<?php 
//session_start();


if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if(!isset($_SESSION['usr01937417227']) || !isset($_SESSION['pswd01937417227'])){
    print "<meta http-equiv=\"refresh\" content=\"0; url=http://".$_SERVER['HTTP_HOST']."/iticket\" />";
}
if (isset($_POST['notification_status'])) {
    $status = $_POST['notification_status'];
    if ($status == 0) {
        echo $_SESSION['notification_status'] = 0;
    }
    if ($status == 1) {
        echo $_SESSION['notification_status'] = 1;
    }
}
?>