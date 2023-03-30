<?php
// filename for export
$csv_filename = 'db_export_'.date('Y-m-d').'.csv';

/*Get Data*/
$q1 = $_GET['q1'];  // Date Initial
$q2 = $_GET['q2'];  // Date End
$q3 = $_GET['q3'];  // Field Name
$q4 = $_GET['q4'];  // Field Data

// database variables
include '../../../db.php';

// create var to be filled with export data
$csv_export = '';

// query to get data from database
$query = mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE $q3 like '%$q4%' AND date >='$q1 00:00:00'  AND date <='$q2 23:59:59'");
$field = mysql_num_fields($query);
// Department,Complain Nature,Service,Issue,Raised,Assigned,Customer Name,Customer Phone No,Card No,Acc No,Email,Details,Last Details,Last Status,Create Date,
$csv_export.="ID, Details,";
  $csv_export.= '
';
while($row = mysql_fetch_array($query)) {
  
  $csv_export.= $row['id'].",";
  $csv_export.= strip_tags(preg_replace("/\r\n|\n\r|\n|\r/", " ", $row['details'])). ",";
  // echo $row['nature'].",";
  // echo $row['ticket_type'].",";
  // echo $row['sub_group'].",";
  // echo $row['from'].",";
  // echo $row['assignd'].",";
  // echo $row['cus_name'].",";
  // echo $row['cus_contact'].",";
  // echo $row['cus_amount'].",";
  // echo $row['cus_ac'].",";
  // echo $row['cus_product'].",";
  // echo $row['cus_ac'].",";
  // echo $row['details'].",";
  // echo $row['status'].",";
  // echo $row['date'].",";
  // $csv_export = '
  // ';
}


// // create var to be filled with export data
// $csv_export = '';

// // create line with field names
// for($i = 0; $i < $field; $i++) {
//   $csv_export.= mysql_field_name($query,$i).',';
// }
// // newline (seems to work both on Linux & Windows servers)
// $csv_export.= '
// ';

// while($row = mysql_fetch_array($query)) {
//   // create line with field values
//   for($i = 0; $i < $field; $i++) {
//     $csv_export.= '"'.$row[mysql_field_name($query,$i)].'",';
//   }	
//   $csv_export.= '
// ';	
// }

// Export the data and prompt a csv file for download
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=".$csv_filename."");
echo($csv_export);
?>