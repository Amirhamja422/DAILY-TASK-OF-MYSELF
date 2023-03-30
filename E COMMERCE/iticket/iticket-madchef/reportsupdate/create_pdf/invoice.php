<?php
include 'fpdf183/fpdf.php';
include 'db.php';

class mypdf extends FPDF
{

	function dynamic_cell($w,$h,$x,$t){
		$len     = strlen($t);
		$i=1;
		if($len >25){
			$text = str_split($t,25);
			foreach ($text as $key => $text) {
				$this->SetX($x);
				$this ->cell($w,$h,$text,0,1);			}
			}else{
				$this->SetX($x);
				$this ->cell($w,$h,$t,0,0);
			}

		}
	}

	$pdf = new mypdf('P','mm',array(300,80));
	 $pdf->SetAutoPageBreak(true, 0);
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',8);
	$pdf->Ln();
	$w=25;
	$h =7;

//##################### Company information Start ####################
	$pdf->Cell(25	,3,'MadDelivery',0,0);
	$pdf->Ln();


	if (isset($_GET['id'])) {


		$ticket_id = $_GET['id'];
		$sql1 = "SELECT * FROM `ticket` WHERE `id`='".$ticket_id."' LIMIT 1";
		$ticket_details = mysqli_fetch_assoc(mysqli_query($con,$sql1));
		// $order_id = '01792788718_1632823290';
		$order_id = $ticket_details['order_id'];
		$phone = $ticket_details['cus_contact'];
		$notes = $ticket_details['note'];

		$branch_info_sql = "SELECT * FROM `order_list` WHERE `order_id`='".$order_id."'";
		$branch_info = mysqli_fetch_assoc(mysqli_query($con,$branch_info_sql));
		$brand = $branch_info['brand'];
		$branch = $branch_info['branch'];

		$data = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `asterisk`.`sms_template` WHERE `brand`='".$brand."' AND `branch`='".$branch."'"));



		$pdf->Cell(25,3,$data['brand'].'!'.$data['branch'],0,0);
		$pdf->Ln();
		$pdf->SetFont('Arial','',8);

		$pdf->Cell(13,3,'Hotline',0,0);
		$pdf->Cell(5,3,':',0,0);
		$pdf->Cell(10,3,$data['Hotline'],0,0);
		$pdf->Ln();

	// $pdf->Cell(13,7,'Address',0,0);
	// $pdf->Cell(5,7,':',0,0);
	// $x =$pdf->getX();
	// $pdf->myCell(10,7,$x,$data['address'],0,0);
	// $pdf->Ln();

		$pdf->Cell(13,3,'Address',0,0);
		$pdf->Cell(5,3,':',0,0);
		$x =$pdf->getX();
		$pdf->dynamic_cell(40,3,$x,$data['address'],0,0);
		$pdf->Ln();



		$pdf->Cell(13,3,'Phone',0,0);
		$pdf->Cell(5,3,':',0,0);
		$pdf->Cell(10,3,$data['phone'],0,0);
		$pdf->Ln();



		$pdf->Cell(13,3,'Date',0,0);
		$pdf->Cell(5,3,':',0,0);
		$pdf->Cell(10,3,date('Y-m-d H:s:i'),0,0);
		$pdf->Ln();
	//##################### Company information End ####################



		$sql1 = "SELECT * FROM `ticket`.`billing_address` WHERE `phone`='".$phone."' AND `order_id`='".$order_id."' ORDER BY id DESC LIMIT 1";
		$cu_details = mysqli_fetch_assoc(mysqli_query($con,$sql1));


	//##################### Bill to Start ####################
		$pdf->Ln();
		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(25,3,'Bill To',0,0);
		$pdf->Ln();

		$pdf->SetFont('Arial','',8);

		$pdf->Cell(13,3,'Name',0,0);
		$pdf->Cell(5,3,':',0,0);
		$pdf->Cell(10,3,$cu_details['name'],0,0);
		$pdf->Ln();


		$pdf->Cell(13,3,'Email',0,0);
		$pdf->Cell(5,3,':',0,0);
		$pdf->Cell(10,3,$cu_details['email'],0,0);
		$pdf->Ln();

	// $pdf->Cell(13,3,'Address',0,0);
	// $pdf->Cell(5,3,':',0,0);
	// $pdf->Cell(10,3,$cu_details['address'],0,0);
	// $pdf->Ln();

		$pdf->Cell(13,3,'Address',0,0,'MT');
		$pdf->Cell(5,3,':',0,0);
		$x =$pdf->getX();
		$pdf->dynamic_cell(40,3,$x,$cu_details['address']);
		$pdf->Ln();


		$pdf->Cell(13,3,'Phone',0,0);
		$pdf->Cell(5,3,':',0,0);
		$pdf->Cell(10,3,$cu_details['phone'],0,0);
		$pdf->Ln();

		$pdf->Cell(13,3,'Other Phn',0,0);
		$pdf->Cell(5,3,':',0,0);
		$pdf->Cell(10,3,$cu_details['additional_phone'],0,0);
		$pdf->Ln();


		$pdf->Cell(13,3,'Order ID',0,0);
		$pdf->Cell(5,3,':',0,0);
		$pdf->Cell(10,3,$order_id,0,0);
		$pdf->Ln();
		$pdf->Ln();
	//##################### Bill to End ####################



		$pdf->Cell(13,3,'Notes',0,0);
		$pdf->Cell(5,3,':',0,0);
		$x =$pdf->getX();
		$pdf->dynamic_cell(40,3,$x,$notes,0,0);
		$pdf->Ln();
		$pdf->Ln();



		$pdf->SetFont('Arial','B',8);
		$pdf->Cell(25,3,'Product List',0,0);
		$pdf->Ln();


		$discount_data = mysqli_fetch_assoc(mysqli_query($con,"SELECT `discount` FROM `discount` WHERE `order_id` ='".$order_id."' "));
		$discount = $discount_data['discount'];

		if (isset($order_id)) {
			$sql = "SELECT * FROM `order_list` WHERE `order_id`='".$order_id."'";
			$result = mysqli_query($con,$sql);

			$x = $pdf->getX();
			$pdf->Cell($w,3,'Product Name',0,0,'L');

			$x = $pdf->getX();
			$pdf->Cell(10,3,'Size',0,0,'L');

			$x = $pdf->getX();
			$pdf->Cell(10,3,'QTY',0,0,'L');

			$x = $pdf->getX();
			$pdf->Cell(10,3,'Total',0,0,'L');
			$pdf->Ln();

			$pdf->SetFont('Arial','',8);
			$cell_width = 10;  //define cell width
 			$cell_height=3;    //define cell height

 			$start_x = $pdf->GetX();

			while($row = mysqli_fetch_assoc($result)){
				$current_x = $pdf->GetX();
 				$current_y = $pdf->GetY();

				// $pdf->myCell($w,$h,$x,$row['product_name'],0,0,'L');
 				$pdf->MultiCell(25,3,$row['product_name'],0,'L');

 				$current_x+=25;                      			//calculate position for next cell
 				$pdf->SetXY($current_x, $current_y);            //set position for next cell to print
 				$pdf->MultiCell(10,3,$row['product_size'],0);


 				$current_x+=10;                       		//calculate position for next cell
 				$pdf->SetXY($current_x, $current_y);            //set position for next cell to print
 				$pdf->MultiCell(10,3,$row['qty'],0);


 				$current_x+=10;                     		//calculate position for next cell
 				$pdf->SetXY($current_x, $current_y);            //set position for next cell to print
 				$pdf->MultiCell(10,3,$row['total_price'],0);
 				$pdf->Ln();

 				$pdf->Cell(60,1,'',0,0);
 				$pdf->Ln();

 				$current_x = $start_x;
 				$current_y = $pdf->GetY();
 				$current_y +=$cell_height;
 				$pdf->SetXY($current_x, $current_y);

				$total_price += $row['total_price'];
				$total_vat += $row['vat'];
				$total_sd  += $row['sd'];
			}
			$pdf->SetFont('Arial','B',8);
			$x = $pdf->getX();
			$pdf->Cell(60,0,'',1,0);
			$pdf->Ln(1);

		//summary
			$pdf->Cell(25,2,'',0,0);
			$pdf->Cell(15,2,'Subtotal',0,0);
			$pdf->Cell(5,2,'=',0,0);
			$pdf->Cell(10,2,$total_price,0,1,'L');
			$pdf->Ln();

			$pdf->Cell(25,2,'',0,0);
			$pdf->Cell(15,2,'Vat 10%',0,0);
			$pdf->Cell(5,2,'=',0,0);
			$pdf->Cell(10,2,$total_vat,0,1,'L');
			$pdf->Ln();


			$pdf->Cell(25,2,'',0,0);
			$pdf->Cell(15,2,'SD 10%',0,0);
			$pdf->Cell(5,2,'=',0,0);
			$pdf->Cell(10,2,$total_sd,0,1,'L');
			$pdf->Ln();

			$pdf->Cell(25,2,'',0,0);
			$pdf->Cell(15,2,'Discount',0,0);
			$pdf->Cell(5,2,'=',0,0);
			$pdf->Cell(10,2,$discount,0,1,'L');
			$pdf->Ln();

			$x = $pdf->getX();
			$pdf->Cell(60,0,'',1,0);
			$pdf->Ln(1);


			$pdf->Cell(20,2,'',0,0);
			$pdf->Cell(20,2,'Total Payable',0,0);
			$pdf->Cell(5,2,'=',0,0);
		$pdf->Cell(10,2,(round($total_price+$total_vat+$total_sd)-$discount),0,1,'R');//end of line
		$pdf->Ln();
		$pdf->Output();
	}
}
?>