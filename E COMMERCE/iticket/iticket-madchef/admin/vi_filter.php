<link href="bootstrap.min.css" rel="stylesheet">
<link href="report.css" rel="stylesheet">
<?php
	
	
	function validatePhone($number) {

$number=preg_replace('/\D/', '',  $number);    						//  Deleting Non Numeric Characters
if(substr($number, 0, 1) == "+" ) $number=substr($number, 1);		//  Deleting + if in First Position
if(substr($number, 0, 2) == "88") $number=substr($number, 2);		//  Deleting 8 if in First Two Position
if(substr($number, 0, 2) == "00") $number=substr($number, 2);		//  Deleting 0 if in First Two Position
if(substr($number, 0, 1) == "0" ) $number=substr($number, 1);		//  Deleting 0 if in First Position


if(strlen($number)<=5 || strlen($number)>10) return "NO";
else return $number;
}
?>



<style type="text/css">
.upbtn{
background-color:#0066CC;
color:#FFFFFF;
border-radius:5px;
cursor:pointer;
border:none;
}
.detti{
font-size:18px;
font-weight:bolder;
color:#FF0000;
font-family:Verdana, Arial, Helvetica, sans-serif;
}
</style>






<div align="center" style="font-family:'Times New Roman', Times, serif; font-size:28px; font-weight:bolder; color:#003399;">Lead Filter</div>  <!-- Title -->


<div align="center">
<form action="vi_filter.php" method="post" enctype="multipart/form-data" name="puron" id="puron">
<input type="file" name="exupload" id="exupload" >
<input type="submit" name="up" id="up" class="upbtn" value="Upload (.csv)">
</form>
</div>


<div align="center" style="font-size:14px; color:#0033FF; font-weight:bolder;"><span style="color:#990000;">N.B:</span> Please Set Category Number &amp; Decimal Places 0 before Saving to (.csv) Format in MSExcel</div>

























<?php            
if(isset($_POST['up']))
{
include '../db.php';

//print $_POST['exupload'];
  $csv_file = $_FILES['exupload']['tmp_name'];

  if ( ! is_file( $csv_file ) )
    exit('File not found.');

   $sql = '';
   $time = time();
   $date = date('Y-m-d');
   
  if (($handle = fopen( $csv_file, "r")) !== FALSE)
  {
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
      {
	  if($data[0]!='')
	  {
	  $formated=validatePhone($data[0]);
	  		if($formated=="NO")
			{
            $sql = mysql_query("INSERT INTO `excel` SET
			`id` = NULL,
            `date` = '$date',
            `tracking_id` = '$time',
            `number` = '$data[0]',
			`shop` = '$data[2]',
			`status` = 'BAD',
			`cc` = '$data[3]',
			`part` = '$data[5]',
			`sdate` = '$data[8]';");
			}
			else
			{
            $sql = mysql_query("INSERT INTO `excel` SET
            `id` = NULL,
			`date` = '$date',
            `tracking_id` = '$time',
            `number` = '$formated',
			`shop` = '$data[2]',
			`status` = 'GOOD',
			`cc` = '$data[3]',
			`part` = '$data[5]',
			`sdate` = '$data[8]';");
			}
	  }
      }
      fclose($handle);
  }

  // Insert into database completed

  
  exit( "<div align=\"center\">Complete Upload & Filter !!!!</div>" );

}
?>


<div align="center">
<?php
include '../db.php';
$results=mysql_query("SELECT date,tracking_id,COUNT(number) AS tot_num FROM excel GROUP BY date,tracking_id");  


print "<div align=\"center\" class=\"datagrid\" style=\"width:670px; overflow:auto;\">";
print "<table class=\"anlepore\">";
print "<thead align=\"center\"><tr><th>Date</th><th>Tracking ID</th><th>Total Count</th><th>Detail</th></tr></thead>";

$i=0;
print "<tbody align=\"center\">";
while($data_array=mysql_fetch_row($results))
{   
  if($i==0)
  {
print "<tr>";
print "<td>".$data_array[0]."</td><td style=\"font-weight:bolder; color:#003399;\">".$data_array[1]."</td><td>".$data_array[2]."</td><td>"."<a href=\"vi_filter.php?trackdetail=".$data_array[1]."&total=".$data_array[2]."\">View Detail</a>"."</td>";
print "</tr>";
  
  $i=1;
  }
    else   
  {
print "<tr class=\"altav\">";
print "<td>".$data_array[0]."</td><td style=\"font-weight:bolder; color:#003399;\">".$data_array[1]."</td><td>".$data_array[2]."</td><td>"."<a href=\"vi_filter.php?trackdetail=".$data_array[1]."&total=".$data_array[2]."\">View Detail</a>"."</td>";
print "</tr>";
  
  $i=0;
  }

}   // loop End
print "</tbody>";
print "</table></div>";
?>
</div>





<br><br>
<div align="center">
<?php
if(isset($_GET['trackdetail']))
{
print "<div align=\"center\" class=\"detti\">Detail Information for Tracking ID ".$_GET['trackdetail']."</div>";
print "<div align=\"center\" style=\"width:300px;\">";
print "<div align=\"left\"><span style=\"font-weight:bolder; color:#0033FF;\">Total Lead : </span>".$_GET['total']."</div>"; // Total Number Only GET Method
include '../db.php';
$results=mysql_query("SELECT COUNT(*)  FROM excel where tracking_id='".$_GET['trackdetail']."' && status='GOOD'");
$data_array=mysql_fetch_row($results);
print "<div align=\"left\"><span style=\"font-weight:bolder; color:#0033FF; \">Good Lead : </span>".$data_array[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"excel.php?q1=".$_GET['trackdetail']."\">Download</a> <a href=\"excel.php?q1=".$_GET['trackdetail']."\"><img src=\"ex.png\" width=\"15\" height=\"15\" title=\"Excel Export\"></a></div>";




$results=mysql_query("SELECT COUNT(*)  FROM excel where tracking_id='".$_GET['trackdetail']."' && status='BAD'");
$data_array=mysql_fetch_row($results);
print "<div align=\"left\"><span style=\"font-weight:bolder; color:#0033FF; \">Bad Lead : </span>".$data_array[0]."</div>";


print "<br><div align=\"left\"><span style=\"font-weight:bolder; color:#0033FF; \">Send Bad Lead(s) to: </span>";
print "<form action=\"vi_filter.php\" method=\"post\">";
/*print "<select name=\"toto\" id =\"toto\" style=\"border-radius:5px;\" required>";

$results=mysql_query("SELECT `id`,`user_name` FROM `users`");

  print "<option value=\"\">-- Receiver --</option>";
  while($data_array=mysql_fetch_row($results))
       {
           print "<option value=\"".$data_array[0]."\">".$data_array[1]."</option>";
       }
print "</select>";*/
print "<input type=\"hidden\" name=\"trackid\" value=\"".$_GET['trackdetail']."\">";
print "<input type=\"submit\" name=\"badSend\" value=\"Send\" class=\"upbtn\"/>";
print "</form>";
print "</div>";




print "<div align=\"left\"><span style=\"font-weight:bolder; color:#0033FF; \">Load Good Lead(s) to: </span>";
print "<form action=\"vi_filter.php\" method=\"post\">";
print "<select name=\"acac\" id =\"acac\" style=\"border-radius:5px;\" required>";

include('../db_asterisk.php');
$resultL = mysql_query("Select DISTINCT(list_id),list_description FROM vicidial_lists WHERE active='Y'");

  print "<option value=\"\">-- Campaign --</option>";
  while($data_array=mysql_fetch_row($resultL))
       {
           print "<option value=\"".$data_array[0]."\">".$data_array[1]."</option>";
       }
print "</select>";
print "<input type=\"hidden\" name=\"trackid\" value=\"".$_GET['trackdetail']."\">";
print "<input type=\"submit\" name=\"goodSend\" value=\"Load List\" class=\"upbtn\"/>";
print "</form>";
print "</div>";







print "</div>";
}
?>
</div>









<?php

if(isset($_POST['goodSend']))
{
include '../db.php';
$results1=mysql_query("SELECT number  FROM excel where tracking_id='".$_POST['trackid']."' && status='GOOD'");
while($da=mysql_fetch_row($results1))
{
//echo "$da[0]";
$username = "root"; 
$password = "MyOlRnd";
$hostname = "localhost";	
$connect2 = mysql_connect($hostname, $username, $password) 
	or die("Unable to connect to MySQL");
$select2 = mysql_select_db("asterisk",$connect);
$results=mysql_query("INSERT INTO `asterisk`.`vicidial_list` (`lead_id`, `entry_date`, `modify_date`, `status`, `user`, `vendor_lead_code`, `source_id`, `list_id`, `gmt_offset_now`, `called_since_last_reset`, `phone_code`, `phone_number`, `title`, `first_name`, `middle_initial`, `last_name`, `address1`, `address2`, `address3`, `city`, `state`, `province`, `postal_code`, `country_code`, `gender`, `date_of_birth`, `alt_phone`, `email`, `security_phrase`, `comments`, `called_count`, `last_local_call_time`, `rank`, `owner`, `entry_list_id`) VALUES (NULL, '$date', NOW(), 'NEW', '', '', '', '".$_POST['acac']."', '6.00', 'N', '0', '$da[0]', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', '$date', '0', '', '0')");
mysql_close($connect2);
echo "<br>";
}
print "Lead Loaded Successfully to LIST ".$_POST['acac'].".";
}


?>





<?php
if(isset($_POST['badSend']))
{
include '../db.php';

//$results=mysql_query("UPDATE `ticket`.`excel` SET `to` = '".$_POST['toto']."',`senddate`='".date('Y-m-d')."' WHERE `excel`.`tracking_id`  = '".$_POST['trackid']."' && `excel`.`status` = 'BAD'");
$results=mysql_query("UPDATE `ticket`.`excel` SET `to` = (select di from users where `users`.`user_name` =  `excel`.`shop`) ,`senddate`='".date('Y-m-d')."' WHERE `excel`.`tracking_id`  = '".$_POST['trackid']."' && `excel`.`status` = 'BAD'");
print "<div align=\"center\" style=\"color:#009933;\">Bad/Malformated Number(s) Successfully Send.</div>";
}


?>