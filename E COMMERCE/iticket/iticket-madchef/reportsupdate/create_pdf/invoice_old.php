<?php
include 'fpdf183/fpdf.php';
include 'db.php';
$pdf = new FPDF('P','mm',array(100,90));

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',8);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(25	,3,'MadChef',0,0);
$pdf->Cell(50	,3,'',0,1);//end of line

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',7);

$pdf->Cell(25	,3,'[Street Address]',0,0);
$pdf->Cell(50	,3,'',0,1);//end of line

$pdf->Cell(25	,3,'[City, Country, ZIP]',0,0);
$pdf->Cell(10	,3,'',0,0);
$pdf->Cell(40	,3, '',0,1);//end of line

$pdf->Cell(25	,3,'Phone : [+12345678]',0,0);
$pdf->Cell(10	,3,'',0,0);
$pdf->Cell(40	,3,'',0,1);//end of line


$pdf->Cell(25	,3,'Fax : [+12345678]',0,0);
$pdf->Cell(10	,3,'',0,0);
$pdf->Cell(40	,3,'',0,1);//end of line

$pdf->Cell(7	,3,'Date : ',0,0);
$pdf->Cell(25	,3,date('Y/m/d H:i:s'),0,1);//end of line

$pdf->Cell(9	,3,'Invoice : ',0,0);
$pdf->Cell(20	,3,time(),0,0);
$pdf->Cell(40	,3,'',0,1);
//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(80	,3,'',0,1);//end of line


if (isset($_GET['id'])) {
	$order_id = $_GET['id'];
	$phone = explode('_', $order_id);

	$sql1 = "SELECT * FROM `ticket` WHERE `id`='".$order_id."' LIMIT 1";
	$cu_details = mysqli_fetch_assoc(mysqli_query($con,$sql1));
	//billing address
	$pdf->Cell(80	,3,'Bill to',0,1);//end of line

	//add dummy cell at beginning of each line for indentation

	$pdf->Cell(80	,3,'Name : '.$cu_details['cus_name'],0,1);


	$pdf->Cell(80	,3,'Email : '.$cu_details['email'],0,1);


	$pdf->Cell(80	,3,'Address : '.$cu_details['superiors'],0,1);


	$pdf->Cell(80	,3,'Phone : '.$cu_details['cus_contact'],0,1);

	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189	,5,'',0,1);//end of line

	//invoice contents

	$pdf->Cell(50,3,'Product Name',0,0);
	$pdf->Cell(7,3,'QTY',0,0);
		$pdf->Cell(7,3,'Size',0,0);
	$pdf->Cell(23,3,'Total',0,1);//end of line

	$pdf->SetFont('Arial','',8);

	//Numbers are right-aligned so we give 'R' after new line parameter
	$sql = "SELECT * FROM `order_list` WHERE `order_id`='".$cu_details['order_id']."'";
	$result = mysqli_query($con,$sql);
	while($row = mysqli_fetch_assoc($result)){
		$pdf->Cell(50,3,$row['product_name'],0,0);
		$pdf->Cell(5,3,$row['qty'],0,0);
		$pdf->Cell(5,3,$row['product_size'],0,0);
		$pdf->Cell(10,3,$row['total_price'],0,0,'R');
		$pdf->Ln(3);
		$total_price += $row['total_price'];
		$total_vat = $total_price*(10/100);
		$total_sd  += $row['sd'];
	}

	$pdf->Cell(70	,0,'',1,0);
	$pdf->Ln(3);

	//summary
	$pdf->Cell(31	,5,'',0,0);
	$pdf->Cell(15	,3,'Subtotal',0,0);
	$pdf->Cell(5	,3,'=',0,0);
	$pdf->Cell(14	,3,$total_price,0,1,'R');//end of line

	//summary
	$pdf->Cell(31	,3,'',0,0);
	$pdf->Cell(15	,3,'Vat 10%',0,0);
	$pdf->Cell(5	,3,'=',0,0);
	$pdf->Cell(14	,3,$total_vat,0,1,'R');//end of line


	//summary
	$pdf->Cell(31	,3,'',0,0);
	$pdf->Cell(15	,3,'SD',0,0);
	$pdf->Cell(5	,3,'=',0,0);
	$pdf->Cell(14	,3,$total_sd,0,1,'R');//end of line


	$pdf->Cell(31	,3,'',0,0);
	$pdf->Cell(15	,3,'Total(BDT)',0,0);
	$pdf->Cell(5	,3,'=',0,0);
	$pdf->Cell(14	,3,$total_price+$total_vat+$total_sd ,0,1,'R');//end of line
	$pdf->Output();
}
?>
