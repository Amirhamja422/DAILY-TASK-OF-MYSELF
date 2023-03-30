<style type="text/css">
.anlepore tr:hover{
//background-color:#CCFF99;
background: rgb(184,225,252);
background: -moz-linear-gradient(top, rgba(184,225,252,1) 0%, rgba(169,210,243,1) 10%, rgba(144,186,228,1) 25%, rgba(144,188,234,1) 37%, rgba(144,191,240,1) 50%, rgba(107,168,229,1) 51%, rgba(162,218,245,1) 83%, rgba(189,243,253,1) 100%);
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(184,225,252,1)), color-stop(10%,rgba(169,210,243,1)), color-stop(25%,rgba(144,186,228,1)), color-stop(37%,rgba(144,188,234,1)), color-stop(50%,rgba(144,191,240,1)), color-stop(51%,rgba(107,168,229,1)), color-stop(83%,rgba(162,218,245,1)), color-stop(100%,rgba(189,243,253,1)));
background: -webkit-linear-gradient(top, rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%);
background: -o-linear-gradient(top, rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%);
background: -ms-linear-gradient(top, rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%);
background: linear-gradient(to bottom, rgba(184,225,252,1) 0%,rgba(169,210,243,1) 10%,rgba(144,186,228,1) 25%,rgba(144,188,234,1) 37%,rgba(144,191,240,1) 50%,rgba(107,168,229,1) 51%,rgba(162,218,245,1) 83%,rgba(189,243,253,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b8e1fc', endColorstr='#bdf3fd',GradientType=0 );
}
.altav{
background:#DFFFDE;
}
</style>
<?php
include '../../supernova_dipu/database.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 



$q1 = $_GET['q1'];
$q2 = $_GET['q2'];
$q3 = $_GET['q3'];
$q4 = $_GET['q4'];
$q5 = $_GET['q5'];



$results=mysql_query("SELECT * FROM crm where ".$q3." like '%".$q4."%'  && report_type like '%".$q5."%'  && `a_date` >= STR_TO_DATE('".$q1."','%Y-%m-%d')  && `a_date` <= STR_TO_DATE('".$q2."','%Y-%m-%d')  ORDER BY `crm`.`a_date`  DESC");  //where a_date like '%21/1/2014%'


print "<div align=\"left\" class=\"datagrid\" style=\"width:670px; height:230px; overflow:auto;\">";
print "<table class=\"anlepore\">";
print "<thead align=\"center\"><tr><th>Name</th><th>Contact</th><th>Address</th><th>Product</th><th>Sex</th><th>Model</th><th>Purchase Date</th><th>Father/Mother Name</th><th>Assigned Person</th><th>Assigned Date</th><th>Report Type</th><th>Status</th><th>Detail</th><th>Group</th><th>DoB</th></tr></thead>";

// class=\"firsttr\"
// class=\"porertr\"
$i=0;
print "<tbody align=\"center\">";
while($data_array=mysql_fetch_row($results))
{   // loop Start
  if($i==0)
  {
     print "<tr>";
print "<td>".$data_array[1]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[7]."</td><td>".$data_array[8]."</td><td>".$data_array[9]."</td><td>".$data_array[10]."</td><td>".$data_array[11]."</td><td>".$data_array[12]."</td><td>".$data_array[13]."</td><td>".$data_array[14]."</td><td>".$data_array[15]."</td>";
print "</tr>";
  
  $i=1;
  }
    else   //if($i==1)
  {
     print "<tr class=\"altav\">";
print "<td>".$data_array[1]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[7]."</td><td>".$data_array[8]."</td><td>".$data_array[9]."</td><td>".$data_array[10]."</td><td>".$data_array[11]."</td><td>".$data_array[12]."</td><td>".$data_array[13]."</td><td>".$data_array[14]."</td><td>".$data_array[15]."</td>";
print "</tr>";
  
  $i=0;
  }

}   // loop End
print "</tbody>";
print "</table></div>";




?>



<div align="center" style="cursor:pointer;"><a href="excel.php?q1=<?php print $q1; ?>&q2=<?php print $q2; ?>&q3=<?php print $q3; ?>&q4=<?php print $q4; ?>&q5=<?php print $q5;?>"><img src="ex.png" width="30" height="30" title="Excel Export"></a>&nbsp;<img src="mail.png" width="30" height="30" title="Group Mail"></div>