<?php
session_start();
//if(!isset($_SESSION['usr']) || !isset($_SESSION['pswd']))
//{
//unset($_SESSION['usr']);
//unset($_SESSION['pswd']);
//session_destroy();
session_unset();
unset($_SESSION['usr01937417227']);
unset($_SESSION['pswd01937417227']);
session_destroy();
//}

print "<meta http-equiv=\"refresh\" content=\"0; url=http://".$_SERVER['HTTP_HOST']."/iticket-bank\" />";
?>