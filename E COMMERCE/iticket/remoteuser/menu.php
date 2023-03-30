<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iDialer</title>
</head>

<body>
<?php include'session.php'; ?>
<?php
//include 'db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$results9=mysql_query("SELECT COUNT(status) FROM  `ticket` WHERE  `status` =  'New'");
$count = mysql_fetch_array($results9);
//echo $count[0];
?>
<div>
  <table width="653" border="0" align="center">
  
  <tr>
  <td>&nbsp;</td> 
  <td align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; color:#990000; font-weight:bolder;">Welcome 
  <span style="color:#009933;">
  <?php 
  $results3=mysql_query("SELECT user_name FROM users WHERE id=".$_GET['i']);
	$row222 = mysql_fetch_array($results3);
	print $row222[0]; 
  ?>
  </span>
  </td>
  <td>
  <!-- Timer Div -->
  <div align="right"><?php include 'timer.php';?></div>
  </td> 
  </tr>
  
  
  
    <tr>
      <td width="108" height="55" valign="bottom"><img src="../kullu/Logo.png" width="70" height="70" /></td>
      <td width="331"  valign="bottom" ><button class="btn btn-primary btn-sm" onclick="location.href='index.php?i=<?php print $_GET['i'];?>'" > <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> My Ticket
</button>   

<button class="btn btn-primary btn-sm" onclick="location.href='new.php?i=<?php print $_GET['i'];?>'" > <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> New Ticket</button> 

<!-- <button class="btn btn-primary btn-sm" onclick="location.href='mal.php?i=<?php print $_GET['i'];?>'" > <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Notice</button>  -->

    </td>
    
      <td width="200" valign="bottom">
<div class="part" style="
    margin-right: -124px;
    float: left;
">	  <button class="btn btn-warning btn-sm" type="button">New <span class="badge"><?php
  $who= $_GET['i'];
include '../db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
//$results999=mysql_query("SELECT COUNT(*) FROM  `ticket` WHERE  `status` =  'New' and (assignd='$who' || `group`=(select user_group_id from users where id='$who') || FIND_IN_SET(28,`superiors`)) ");


//Last   SELECT COUNT(*) FROM `ticket` where `status` =  'New' && (FIND_IN_SET($who,`superiors`) || assignd='$who' ||  `group`=(select user_group_id from users where id=$who))


$results999=mysql_query("SELECT COUNT(*) FROM ticket where status='New' and ( `group`=(select CAST(user_group_id as CHAR(50)) from users where id= ".$who.") or FIND_IN_SET(".$who.",`superiors`) or assignd='".$who."' )");


$countDIP = mysql_fetch_array($results999);
   
/*$res=mysql_query("select user_group_id from users where id='$who'");
$gr=mysql_fetch_array($res);
$count=0;
$results=mysql_query("SELECT `assignd`,`group`,`superiors`,`stamp` FROM `ticket`");
while($data_array=mysql_fetch_row($results))
       {
           if()
       }*/




echo $countDIP[0];
?></span>
</button>  


<button class="btn btn-warning btn-sm" type="button">Pending <span class="badge"><?php
  $who= $_GET['i'];
include '../db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
//$results999=mysql_query("SELECT COUNT(*) FROM  `ticket` WHERE  `status` =  'New' and (assignd='$who' || `group`=(select user_group_id from users where id='$who') || FIND_IN_SET(28,`superiors`)) ");


//Last   SELECT COUNT(*) FROM `ticket` where `status` =  'New' && (FIND_IN_SET($who,`superiors`) || assignd='$who' ||  `group`=(select user_group_id from users where id=$who))


$results999=mysql_query("SELECT COUNT(*) FROM ticket where status='Pending' and ( `group`=(select CAST(user_group_id as CHAR(50)) from users where id= ".$who.") or FIND_IN_SET(".$who.",`superiors`) or assignd='".$who."' )");


$countDIP = mysql_fetch_array($results999);
   
/*$res=mysql_query("select user_group_id from users where id='$who'");
$gr=mysql_fetch_array($res);
$count=0;
$results=mysql_query("SELECT `assignd`,`group`,`superiors`,`stamp` FROM `ticket`");
while($data_array=mysql_fetch_row($results))
       {
           if()
       }*/




echo $countDIP[0];
?></span>
</button>
<button class="btn btn-warning btn-sm" type="button">Solved <span class="badge"><?php
  $who= $_GET['i'];
include '../db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
//$results999=mysql_query("SELECT COUNT(*) FROM  `ticket` WHERE  `status` =  'New' and (assignd='$who' || `group`=(select user_group_id from users where id='$who') || FIND_IN_SET(28,`superiors`)) ");


//Last   SELECT COUNT(*) FROM `ticket` where `status` =  'New' && (FIND_IN_SET($who,`superiors`) || assignd='$who' ||  `group`=(select user_group_id from users where id=$who))


$results999=mysql_query("SELECT COUNT(*) FROM ticket where status='solved' and ( `group`=(select CAST(user_group_id as CHAR(50)) from users where id= ".$who.") or FIND_IN_SET(".$who.",`superiors`) or assignd='".$who."' )");


$countDIP = mysql_fetch_array($results999);
   
/*$res=mysql_query("select user_group_id from users where id='$who'");
$gr=mysql_fetch_array($res);
$count=0;
$results=mysql_query("SELECT `assignd`,`group`,`superiors`,`stamp` FROM `ticket`");
while($data_array=mysql_fetch_row($results))
       {
           if()
       }*/




echo $countDIP[0];
?></span>
</button>
 </div>

<button class="btn btn-danger btn-sm" onclick="location.href='../admin/out.php?i=90'" style="
    margin-left: 256px;
    float: left;
    margin-top: -29px;
"> <span class="glyphicon glyphicon-off" aria-hidden="true"></span>&nbsp;Log out</button>
 
    </tr>

  </table>
</div>
</body>
</html>
