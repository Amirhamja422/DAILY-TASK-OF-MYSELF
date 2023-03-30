<?php
include 'db.php';
$sl=1;

$start_date = $_POST['idate']." 00:00:01";
$end_date = $_POST['edate']." 23:59:59";


if (isset($_POST['phone'])) {
	$phone = $_POST['phone'];

	$results1=mysql_query("SELECT * FROM ticket where cus_contact='$phone' AND date >= '".$start_date."' AND date < '".$end_date."' ORDER BY id DESC");

	echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
	<tr>
	<th align='center'>ID</th>
	<th align='center'>Opening date</th>
	<th align='center'>Status</th>
	<th align='center'>From</th>
	<th align='center'>Phone</th>
	<th align='center'>Check</th>
	<th align='center'>Invoice</th>
	</tr>";

	while($row = mysql_fetch_array($results1))
	{

		echo "<tr>";
		echo "<td >" . $row['id']. "</td>";
		echo "<td >" . $row['date'] . "</td>";  
		echo "<td >" . $row['status'] . "</td>"; 		
		echo "<td >" . $row['agent'] . "</td>";
		echo "<td >" . $row['cus_contact'] . "</td>"; 
		echo '<td ><div align=""><a href="followup.php?id='. $row['id'] .'&order_id='. $row['order_id'] .'&phone_number='.$row['cus_contact'].'">Check</div></td>';
		if($row['order_id'] != ''){
			echo '<td ><div align=""> <a href="create_pdf/thermal_printer_invoice.php?id='. $row['order_id'] .'&phone='.$row['cus_contact'].'">Print Invoice</div></td>'; 
		}
		
	}
	echo "</table>";
}

if(isset($_POST['Submit']))
{
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
	$in=$_POST['status'];

	$results1=mysql_query("SELECT * FROM ticket where status='$in' AND date >= '".$start_date."' AND date < '".$end_date."' ORDER BY id DESC");

	echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
	<tr>
	<th align='center'>ID</th>
	<th align='center'>Opening date</th>
	<th align='center'>Status</th>
	<th align='center'>From</th>
	<!-- <th align='center'>SMS</th> -->
	<!-- <th align='center'>Email</th>	--> 
	<th align='center'>Check</th>
	<th align='center'>Invoice</th>
	</tr>";


	while($row = mysql_fetch_array($results1))
	{

		echo "<tr>";
		echo "<td >" . $row['id'] . "</td>";
		echo "<td >" . $row['date'] . "</td>";  
		echo "<td >" . $row['status'] . "</td>"; 
		echo "<td >" . $row['agent'] . "</td>"; 
		echo '<td ><div align=""><a href="followup.php?id='. $row['id'] .'&order_id='. $row['order_id'] .'&phone_number='.$row['cus_contact'].'">Check</div></td>';
		// echo '<td ><div align=""> <a href="create_pdf/thermal_printer_invoice.php?id='. $row['order_id'] .' ">Print Invoice</div></td>';
		if($row['order_id'] != ''){
			echo '<td ><div align=""> <a href="create_pdf/thermal_printer_invoice.php?id='. $row['order_id'] .'&phone='.$row['cus_contact'].'">Print Invoice</div></td>'; 
		}
	}
	echo "</table>";
}

if(isset($_POST['Submit3'])){
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
	$in=$_POST['brand'];


	$results1=mysql_query("SELECT * FROM ticket where `group`='$in' AND date >= '".$start_date."' AND date < '".$end_date."' ORDER BY id DESC");

	echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
	<tr>

	<th align='center'>ID</th>
	<th align='center'>Opening date</th>
	<th align='center'>Status</th>
	<th align='center'>Brand</th>
	<th align='center'>From</th>
	<!-- <th align='center'>SMS</th> -->
	<!-- <th align='center'>Email</th>	-->
	<th align='center'>Check</th>
	<th align='center'>Invoice</th>
	</tr>";


	while($row = mysql_fetch_array($results1)){

		echo "<tr>";
		echo "<td >" . $row['id'] . "</td>"; 
		echo "<td >" . $row['date'] . "</td>"; 
		echo "<td >" . $row['status'] . "</td>"; 
		echo "<td >" . $row['group'] . "</td>"; 
		echo "<td >" . $row['agent'] . "</td>";
		echo '<td ><div align=""><a href="followup.php?id='. $row['id'] .'&order_id='. $row['order_id'] .'&phone_number='.$row['cus_contact'].'">Check</div></td>';
		// echo '<td ><div align=""> <a href="create_pdf/thermal_printer_invoice.php?id='. $row['order_id'] .' ">Print Invoice</div></td>';
		if($row['order_id'] != ''){
			echo '<td ><div align=""> <a href="create_pdf/thermal_printer_invoice.php?id='. $row['order_id'] .'&phone='.$row['cus_contact'].'">Print Invoice</div></td>'; 
		}
	}
	echo "</table>";
}

if(isset($_POST['Submit2']))
{
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
	$in2=$_POST['search'];
	$value=$_POST['value'];

	$results1=mysql_query("SELECT * FROM ticket where $in2 like '%$value%' AND date >= '".$start_date."' AND date < '".$end_date."' ORDER BY id DESC");

	echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
	<tr>

	<th align='center'>ID</th>
	<th align='center'>Opening date</th>
	<th align='center'>Status</th>
	<th align='center'>From</th>
	<!-- <th align='center'>SMS</th> -->
	<!-- <th align='center'>Email</th>	--> 
	<th align='center'>Check</th>
	<th align='center'>Invoice</th>
	</tr>";
	while($row = mysql_fetch_array($results1))
	{

		echo "<tr>";
		echo "<td >" . $row['id'] . "</td>"; 
		echo "<td >" . $row['date'] . "</td>"; 
		echo "<td >" . $row['status'] . "</td>"; 
		echo "<td >" . $row['agent'] . "</td>";
		echo '<td ><div align=""><a href="followup.php?id='. $row['id'] .'&order_id='. $row['order_id'] .'&phone_number='.$row['cus_contact'].'">Check</div></td>';
		// echo '<td ><div align=""> <a href="create_pdf/thermal_printer_invoice.php?id='. $row['order_id'] .' ">Print Invoice</div></td>';
		if($row['order_id'] != ''){
			echo '<td ><div align=""> <a href="create_pdf/thermal_printer_invoice.php?id='. $row['order_id'] .'&phone='.$row['cus_contact'].'">Print Invoice</div></td>'; 
		}
	}
	echo "</table>";
}

if(isset($_POST['type']) =='All'){
	mysql_query("SET CHARACTER SET utf8");
	mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
	$in=$_POST['type'];
	$idate=$start_date;
	$edate=$end_date;

	$results1=mysql_query("SELECT * FROM ticket  where date >= '".$start_date."' AND date < '".$end_date."' ORDER BY id DESC");

	echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
	<tr>

	<th align='center'>ID</th>
	<th align='center'>Opening date</th>
	<th align='center'>Status</th>
	<th align='center'>From</th>
	<!-- <th align='center'>SMS</th> -->
	<!-- <th align='center'>Email</th>	--> 
	<th align='center'>Check</th>
	<th align='center'>Invoice</th>
	</tr>";


	while($row = mysql_fetch_array($results1)){

		echo "<tr>";
		echo "<td >" . $row['id'] . "</td>"; 
		echo "<td >" . $row['date'] . "</td>"; 
		echo "<td >" . $row['status'] . "</td>";  
		echo "<td >" . $row['agent'] . "</td>"; 
		echo '<td ><div align=""><a href="followup.php?id='. $row['id'] .'&order_id='. $row['order_id'] .'&phone_number='.$row['cus_contact'].'">Check</div></td>';
		// echo '<td ><div align=""> <a href="create_pdf/thermal_printer_invoice.php?id='. $row['order_id'] .' ">Print Invoice</div></td>';
		if($row['order_id'] != ''){
			echo '<td ><div align=""> <a href="create_pdf/thermal_printer_invoice.php?id='. $row['order_id'] .'&phone='.$row['cus_contact'].'">Print Invoice</div></td>'; 
		}
	}
	echo "</table>";
}
?>