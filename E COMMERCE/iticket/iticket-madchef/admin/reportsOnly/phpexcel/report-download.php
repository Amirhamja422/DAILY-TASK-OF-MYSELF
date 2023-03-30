
<?php
include '../../../db.php';
session_start();

/*Get Data*/
$q1 = $_GET['q1'];  // Date Initial
$q2 = $_GET['q2'];  // Date End
$q3 = $_GET['q3'];  // Field Name
$q4 = $_GET['q4'];  // Field Data


$Use_Title = 1;
$now_date = date('l jS \ F Y h:i:s A');

$title = "\t\t\t\t\t\t--- Export iTicket Report ---  " . "" . "\n\t\t\t\t\t\t\tI HELP BD\n\t\t\t\t\t\tCustomer Relationship Department\n\n\t\t\t\t\t\tAs on " . $q1 . " To ".$q2."\n\n";

$file_type = "vnd.ms-excel";
$file_ending = "xls";

header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=Export_iTicket_Report_$now_date.$file_ending");
header("Pragma: no-cache");
header("Expires: 0");

if ($Use_Title == 1) {
    echo("$title\n");
}

$array = array();
$qry = mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE $q3  like '%$q4%' AND date >='$q1 00:00:00'  AND date <='$q2 23:59:59' AND `group` = '".$_SESSION['group_id']."'");
// echo "SELECT * FROM `ticket_dev`.`ticket` WHERE $q3  like '%$q4%' AND date >='$q1 00:00:00'  AND date <='$q2 23:59:59' AND `group` = '".$_SESSION['group_id']."'";

while ($row = mysql_fetch_assoc($qry)) {
	$history = mysql_num_rows(mysql_query("SELECT * FROM `history` WHERE `id`='".$row['id']."'"));
	array_push($array, $history);
}

$max = max($array);

echo "ID\tDepartment\tComplain Nature\tService\tIssue\tRaised\tAssigned\tCustomer Name\tCustomer Phone No\tCard No\tAcc No\tEmail\tDetails\tLast Details\tLast Status\tCreate Date\t";
	for ($i=1; $i <= $max; $i++) { 
		echo $i." Details Date\t";
		echo "Status\t";
		echo "User\t"; 
		echo "Remarks\t";
	}
echo "\n";

$stmt = mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE $q3  like '%$q4%' AND date >='$q1 00:00:00'  AND date <='$q2 23:59:59' AND `group` = '".$_SESSION['group_id']."'");

while ($stmt_row = mysql_fetch_assoc($stmt)) {

	$dept = mysql_fetch_assoc(mysql_query("SELECT * FROM `user_group` WHERE `id`='".$stmt_row['group']."'"));
	$service = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$stmt_row['ticket_type']."'"));
	$issue = mysql_fetch_assoc(mysql_query("SELECT * FROM `sub_group` WHERE `id`='".$stmt_row['sub_group']."'"));
	$assignd = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$stmt_row['assignd']."'"));
	$raised = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$stmt_row['from']."'")); 
	$history = mysql_query("SELECT * FROM `history` WHERE `id`='".$stmt_row['id']."'"); 
	$first_details = mysql_fetch_assoc(mysql_query("SELECT * FROM `history` WHERE `id`='".$stmt_row['id']."' ORDER BY `date` ASC")); 

	echo $stmt_row['id']."\t";
	echo $dept['group_name']."\t";
	echo $stmt_row['nature']."\t";
	echo $service['type_name']."\t";
	echo $issue['sub_group_name']."\t";
	echo $raised['user_name']."\t";
	echo $assignd['user_name']."\t";
	echo $stmt_row['cus_name']."\t";
	echo $stmt_row['cus_contact']."\t";
	echo $stmt_row['cus_amount']."\t";
	echo $stmt_row['cus_ac']."\t";
	echo $stmt_row['cus_product']."\t";
	echo strip_tags(preg_replace("/\r\n|\n\r|\n|\r/", " ", utf8_encode ($first_details['details'])))."\t";
	echo strip_tags(preg_replace("/\r\n|\n\r|\n|\r/", " ", utf8_encode ($stmt_row['details'])))."\t";
	echo $stmt_row['status']."\t";
	echo $stmt_row['date']."\t";
	while ($row = mysql_fetch_assoc($history)) {
		echo $row['date']."\t";
		echo $row['status']."\t";
		echo $row['from']."\t";
		echo strip_tags(preg_replace("/\r\n|\n\r|\n|\r/", " ", utf8_encode ($row['details'])))."\t";
	}
	echo "\n";

}	
	