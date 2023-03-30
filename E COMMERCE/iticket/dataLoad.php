<title>MSSQL</title><!--  Get Data from MSSQL  -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'MSdatabase.php';

//$ULTA	=mssql_query("INSERT INTO tblComplain (`id`, `ticket_type`, `from`, `assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`) VALUES (NULL, 'Ticket Type', 'From', 'Assigned', 'Group', 'Cus_contact', 'Cus_name', 'cus_ac', 'Cus_product', 'Cus_amount', 'Status', 'Details', CURRENT_TIMESTAMP, 'stamp', '1', 'Superiors')");

//$ULTA	= mssql_query("INSERT INTO tblComplain (id, ticket_type, assignd) VALUES ('203203','Complain', 'Saurav Debnath')");




/*$ULTA	= mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors) 			VALUES 
			(
			2032044, 
			'type', 
			'Forma Banano',
			'Assignd', 
			'Contact', 
			'Name', 
			'Account', 
			'Product', 
			'Amount', 
			'New', 
			'Details', 
			GETDATE(), 
			45612358, 
			'1', 
			'Superiors')");*/










  //$R=mssql_query("delete FROM tblComplain where id > 161411 and id < 162312");
  $results=mssql_query("SELECT * FROM tblComplain where id > 161409 and id < 161414");   //   select * from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='tblComplain'
  
  print "<table border=\"1\" width=\"100%\">";
  while($data_array=mssql_fetch_array($results))
  {
  print "<tr>";
  for ($i = 0; $i < mssql_num_fields($results); ++$i)
  		{
  		print "<td>$data_array[$i]</td>";
  		}
  print "</tr>";
  /*print "<tr>
  <td>$data_array[0]</td>
  <td>$data_array[1]</td>
  <td>$data_array[3]</td>
  <td>$data_array[5]</td>
  <td>$data_array[6]</td>
  <td>$data_array[11]</td>
  </tr>"; */
  }
  print "</table>";   
  
  
  
  
  
  
  
print "<br><br>"; 
$query=mssql_query("SELECT * FROM tblComplain");

for ($i = 0; $i < mssql_num_fields($query); ++$i) {
    echo ' ---- <strong>' . mssql_field_name($query, $i).'</strong>', PHP_EOL;
	echo '<br>';
}

mssql_free_result($query); 
?>