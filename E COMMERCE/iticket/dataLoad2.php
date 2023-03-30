<title>MSSQL</title><!--  Get Data from MSSQL  -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'db.php';
include 'MSdatabase.php';




$results=mysql_query("SELECT `id`, `ticket_type`, `from`, (select user_name from users where id = ticket.assignd), `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors` FROM `ticket` where id > 161411 and id < 162312");

  while($data_array=mysql_fetch_row($results))
       {
	    print $data_array[1]." Inserted <br>";
		$fresh_Milk = strip_tags($data_array[10]);

		$ULTA	= mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, [group], cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors) 			VALUES 
			(
			$data_array[0], 
			'".$data_array[1]."', 
			'$data_array[2]', 
			'$data_array[3]',
			'0',
			'".$data_array[5]."', 
			'".$data_array[6]."', 
			'CUSTOMER ACCOUNT', 
			'".$data_array[8]."', 
			'".$data_array[9]."', 
			'New', 
			'".$fresh_Milk."', 
			GETDATE(), 
			$data_array[13], 
			'1', 
			'Superiors')");
		
		
       }
  
  
  
  

?>