<style type="text/css">
.anlepore{
font-family:Verdana, Arial, Helvetica, sans-serif;
}
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
.exbtnex{
border:1px solid #000000;
border-radius: 5px;
cursor:pointer;
color:#FFFFFF;
background-color:#009900;
}
</style>
<?php
include '../../db.php';
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 



$q1 = $_GET['q1'];
$q2 = $_GET['q2'];
$q3 = $_GET['q3'];
$q4 = $_GET['q4'];



$results=mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', (select user_id from users where id = `ticket`.`assignd`) as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name',  `cus_product` as 'Product Details',   `date` as 'Create Date' FROM `ticket` WHERE ".$q3." like '%".$q4."%' AND date >='".$q1." 00:00:00'  AND date <='".$q2." 23:59:59' ORDER BY `ticket`.`id` DESC");
$num_rows = mysql_num_rows($results);
?>
<br><br>
<div align="center">

<div style="float:right; color:#003366; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px;">
Total Row(s) : <span style="color:#FF3333; font-weight:bolder;"><?php print $num_rows;?> </span>
</div>



</div>
<br>


<?php
print "<div align=\"center\" class=\"datagrid\" style=\"width:99%; height:auto; overflow:auto;\">";
print "<table class=\"anlepore\">";
print "<thead align=\"center\"><tr><th>ID</th><th>TYPE</th><th>Raised</th><th>Assigned</th><th>Contact</th><th>Name</th><th>Product</th><th>Carete Date</th><th title=\"UPDATE\"><img src=\"update.png\" width=\"20\" height=\"20\"></th><th title=\"Delete\"><img src=\"delete.png\" width=\"20\" height=\"20\"></th></tr></thead>";

// class=\"firsttr\"
// class=\"porertr\"
$i=0;
print "<tbody align=\"center\">";
while($data_array=mysql_fetch_row($results))
{   // loop Start
  if($i==0)
  {
     print "<tr>";
print "<td>".$data_array[0]."</td><td>".$data_array[1]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[7]."</td><td><a onclick=\"smcollege('".$data_array[0]."');\"><img src=\"edit.png\" width=\"15\" height=\"15\" style=\"cursor:pointer;\" title=\"Update Ticket $data_array[0]\"></a></td><td><a href=\"delete.bra2.php?id=".$data_array[0]."&q1=$q1&q2=$q2&q3=$q3&q4=$q4\" onclick=\"return confirm('Are you really want to delete ".$data_array[0]."');\"><img src=\"del.png\" width=\"20\" height=\"20\" style=\"cursor:pointer;\" title=\"Delete Ticket $data_array[0]\"></a></td>";
print "</tr>";
  
  $i=1;
  }
    else   //if($i==1)
  {
     print "<tr class=\"altav\">";
print "<td>".$data_array[0]."</td><td>".$data_array[1]."</td><td>".$data_array[2]."</td><td>".$data_array[3]."</td><td>".$data_array[4]."</td><td>".$data_array[5]."</td><td>".$data_array[6]."</td><td>".$data_array[7]."</td><td><a onclick=\"smcollege('".$data_array[0]."');\"><img src=\"edit.png\" width=\"15\" height=\"15\" style=\"cursor:pointer;\" title=\"Update Ticket $data_array[0]\"></a></td><td><a href=\"delete.bra2.php?id=".$data_array[0]."&q1=$q1&q2=$q2&q3=$q3&q4=$q4\" onclick=\"return confirm('Are you really want to delete ".$data_array[0]."');\"><img src=\"del.png\" width=\"20\" height=\"20\" style=\"cursor:pointer;\" title=\"Delete Ticket $data_array[0]\"></a></td>";
print "</tr>";
  
  $i=0;
  }

}   // loop End
print "</tbody>";
print "</table></div>";




?>






