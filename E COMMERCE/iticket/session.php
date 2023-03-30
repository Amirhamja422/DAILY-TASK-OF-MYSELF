<?php 
//session_start();


if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
if(!isset($_SESSION['usr01937417227']) || !isset($_SESSION['pswd01937417227'])){
print "<meta http-equiv=\"refresh\" content=\"0; url=http://".$_SERVER['HTTP_HOST']."/singerticket\" />";
} 
?>