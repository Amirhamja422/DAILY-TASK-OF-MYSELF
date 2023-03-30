<?php /*________________________________________________________________


lixlpixel PHParadise

_______________________________________________________________________

category :		databases

snippet :		mySQL to excel

downloaded :	01.26.2014 - 04:43

file URL :		http://www.fundisom.com/phparadise/php/databases/mySQL_to_excel

description :	export a mySQL database table to an EXCEL file.
 database table dump to WORD document possible also.

___________________________START___COPYING___HERE__________________*/ ?>


<?php

//EDIT YOUR MySQL Connection Info:
$DB_Server = "localhost";		//your MySQL Server 
$DB_Username = "intrade_apu";				 //your MySQL User Name 
$DB_Password = "Q04+o%?(!!f^";				//your MySQL Password 
$DB_DBName = "ticket";				//your MySQL Database Name 
$DB_TBLName = "ticket";				//your MySQL Table Name 
//$DB_TBLName,  $DB_DBName, may also be commented out & passed to the browser
//as parameters in a query string, so that this code may be easily reused for
//any MySQL table or any MySQL database on your server

//DEFINE SQL QUERY:
//you can use just about ANY kind of select statement you want - 
//edit this to suit your needs!
$q1 = $_GET['idate'];
$q2 = $_GET['edate'];
		//$q3 = $_GET['q3'];
		//$q4 = $_GET['q4'];
//$q5 = $_GET['q5'];



$sql = "select * from history where date >='$q1 00:00:00'  AND date <='$q2 23:59:59' ";    
//"SELECT * FROM `vicidial_list` where user in (select user from vicidial_campaign_agents where campaign_id='".$_GET['campaign']."') && modify_date > '".$_GET['date1']." 00:00:00' || modify_date<'".$_GET['date2']." 23:59:59' ORDER BY `vicidial_list`.`modify_date`  DESC";
//"SELECT * FROM `vicidial_list` where user in (select user from vicidial_campaign_agents where campaign_id='".$_GET['campaign']."') && modify_date > '2014-01-27 00:00:00'";
//"select * from vicidial_list";
//"Select * from $DB_TBLName where list_id=3003 && modify_date > '2014-01-27 00:00:00'";
//"SELECT * FROM `vicidial_list` where user in (select user from vicidial_campaign_agents where campaign_id='".$_POST['campaign']."') && modify_date > '".$_POST['date1']." 00:00:00'   LIMIT 0 , 30";


//Optional: print out title to top of Excel or Word file with Timestamp
//for when file was generated:
//set $Use_Titel = 1 to generate title, 0 not to use title
$Use_Title = 1;
//define date for title: EDIT this to create the time-format you need
//$now_date = date('m-d-Y H:i');
$now_date = date('l jS \ F Y h:i:s A');
//define title for .doc or .xls file: EDIT this if you want
$title = "\t\t\t\t\t\t--- iTracker Report Detail Escalation---  ".""."\n\t\t\t\t\t\tPRAN RFL Group\n\t\t\t\t\tCustomer Relationship Department\n\n\t\t\t\t\t".$now_date."\n\n";//"Dump For Table $DB_TBLName from Database $DB_DBName on $now_date";
/*

Leave the connection info below as it is:
just edit the above.

(Editing of code past this point recommended only for advanced users.)
*/
//create MySQL connection
$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password)
	or die("Couldn't connect to MySQL:<br>" . mysql_error() . "<br>" . mysql_errno());
//select database
$Db = @mysql_select_db($DB_DBName, $Connect)
	or die("Couldn't select database:<br>" . mysql_error(). "<br>" . mysql_errno());
//execute query

mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$result = @mysql_query($sql,$Connect)
	or die("Couldn't execute query:<br>" . mysql_error(). "<br>" . mysql_errno());

//if this parameter is included ($w=1), file returned will be in word format ('.doc')
//if parameter is not included, file returned will be in excel format ('.xls')
if (isset($w) && ($w==1))
{
	$file_type = "msword";
	$file_ending = "doc";
}else {
	$file_type = "vnd.ms-excel";
	$file_ending = "xls";
}
//header info for browser: determines file type ('.doc' or '.xls')

header("Content-Type: application/$file_type");
header("Content-Disposition: attachment; filename=iTracker-Report-PRAN-RFL_Group.$file_ending");
header("Pragma: no-cache");
header("Expires: 0");

/*	Start of Formatting for Word or Excel	*/

if (isset($w) && ($w==1)) //check for $w again
{
	/*	FORMATTING FOR WORD DOCUMENTS ('.doc')   */
	//create title with timestamp:
	if ($Use_Title == 1)
	{
		echo("$title\n\n");
	}
	//define separator (defines columns in excel & tabs in word)
	$sep = "\n"; //new line character

	while($row = mysql_fetch_row($result))
	{
		//set_time_limit(60); // HaRa
		$schema_insert = "";
		for($j=0; $j<mysql_num_fields($result);$j++)
		{
		//define field names
		$field_name = mysql_field_name($result,$j);
		//will show name of fields
		$schema_insert .= "$field_name:\t";
			if(!isset($row[$j])) {
				$schema_insert .= "NULL".$sep;
				}
			elseif ($row[$j] != "") {
				$schema_insert .= "$row[$j]".$sep;
				}
			else {
				$schema_insert .= "".$sep;
				}
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		$schema_insert .= "\t";
		print(trim($schema_insert));
		//end of each mysql row
		//creates line to separate data from each MySQL table row
		print "\n----------------------------------------------------\n";
	}
}else{
	/*	FORMATTING FOR EXCEL DOCUMENTS ('.xls')   */
	//create title with timestamp:
	if ($Use_Title == 1)
	{
		echo("$title\n");
	}
	//define separator (defines columns in excel & tabs in word)
	$sep = "\t"; //tabbed character

	//start of printing column names as names of MySQL fields
	for ($i = 0; $i < mysql_num_fields($result); $i++)
	{
		echo mysql_field_name($result,$i) . "\t";
	}
	print("\n");
	//end of printing column names

	//start while loop to get data
	while($row = mysql_fetch_row($result))
	{
		//set_time_limit(60); // HaRa
		$schema_insert = "";
		for($j=0; $j<mysql_num_fields($result);$j++)
		{
			if(!isset($row[$j]))
				$schema_insert .= "NULL".$sep;
			elseif ($row[$j] != "")
				$schema_insert .= "$row[$j]".$sep;
			else
				$schema_insert .= "".$sep;
		}
		$schema_insert = str_replace($sep."$", "", $schema_insert);
		//following fix suggested by Josue (thanks, Josue!)
		//this corrects output in excel when table fields contain \n or \r
		//these two characters are now replaced with a space
		$schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
		$schema_insert .= "\t";
		print(trim($schema_insert));
		print "\n";
	}
}

?>


<?php /*_____________________END___OF___THE___CODE______________________


get more code from http://www.fundisom.com/phparadise/


___________________________________________________________________*/ ?>