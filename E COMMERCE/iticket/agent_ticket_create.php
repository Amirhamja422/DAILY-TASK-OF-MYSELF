<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="jquery-3.5.1.min.js"></script>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	<script type="text/javascript">

		function productlists(product_type){
			var product_container = document.getElementById('product_sections');
			if(product_type == 'All'){
				var branch = $('#branch_name').val();
				fetch_product(branch);
			}else{
				select_primary_product(product_type);
			}			
		}


		function select_primary_product(product_type){
			var brand  = $('#group').val();
			var branch = $('#branch_name').val();
			var product_list = 'productlists';
			$.ajax({
				type: 'post',
				url: 'fetch_product.php',
				data: {
					brand:brand,
					branch:branch,
					product_type:product_type,
					product_list:product_list
				},
				success: function (response) {			
					$("#product_sections").html(response);
					$("#product_sections").trigger("chosen:updated");
				}
			});

		}


		function select_secoundary_product(primary_product){
			var brand  = $('#group').val();
			var branch = $('#branch_name').val();
			var product_type = $('#product_type').val();
			var from ='add_to_cart';
			$.ajax({
				type: 'post',
				url: 'fetch_product.php',
				data: {
					brand:brand,
					branch:branch,
					primary_product:primary_product,
					product_type:product_type,
					from : from
				},
				success: function (response) {
					$("#secondary_product_list").html(response);
					$("#secondary_product_list").trigger("chosen:updated");
				}
			});

		}


		function Hamba_Java(str2)
		{
			if (window.XMLHttpRequest){
				xmlhttp = new XMLHttpRequest();
			} else{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function ()
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					document.getElementById("dishow").innerHTML = xmlhttp.responseText;
				}
			}
			xmlhttp.open("GET", "supernova_dipu/plist.php?q=" + str2, true);
			xmlhttp.send();
		}

		function load_cart_item_number() {
			var phone = $('#cus_phone').val();
			var brand=$('#group').val();
			var branch=$('#branch_name').val();
			$.ajax({
				url: 'load_cart.php',
				method: 'GET',
				data: {
					brand:brand,
					branch:branch,
					phone:phone,
					cartItem: "cart_item"
				},
				success: function(response) {
					$("#cart_item").html(response);
					pick_discount();
				}
			});
		}


		function pick_discount(){
			var discount_value = $('#discount').val();
			var total_with_vat = $('#total_price').val();
			var discount_price = Math.round((total_with_vat-discount_value),2);
			$('#total_with_vat').html(discount_price);
			$('#discount_total').html(discount_value);
		}
	</script>

	<script src="ck/ckeditor.js"></script>
	<script type="text/javascript">

		function changeText3(str) {
			document.getElementById('cc').value = document.getElementById('cc').value + "," + document.getElementById('cclist').value;
		}


		function changeText2(str) {
			if (window.XMLHttpRequest){
				xmlhttp = new XMLHttpRequest();
			} else
			{
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function ()
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
				{
					document.getElementById('kullu').innerHTML = "<textarea class=\"form-control\" id=\"editor1\" name=\"editor1\" rows=\"4\" required>" + xmlhttp.responseText + "</textarea>";
					CKEDITOR.replace('editor1');
					CKEDITOR.config.height = 90;
				}
			}
			xmlhttp.open("GET", "kullu/tem.php?q=" + str, true);
			xmlhttp.send();
		}
	</script>
	<title>. : : i Tracker : : .</title>
</head>

<body background="admin/<?php include 'bg.php'; ?>">

	<?php  
	$phone = "";
	$customer_name = "";
	$email_address = "";
	$order_address = "";
	$acc_no = "";
	$product_tra = "";
	$detail_tra = "";
	$address_tra = "";
	$agent89 = $_SESSION['agent_name'];
	if (isset($_GET['phone_number']))
		$phone = $_GET['phone_number'];
	if (isset($_GET['customer_name']))
		$customer_name = $_GET['customer_name'];
	if (isset($_GET['cus_email']))
		$email_address  = $_GET['cus_email'];  
	if (isset($_GET['order_address']))
		$order_address  = $_GET['order_address'];
	if (isset($_GET['acc_no']))
		$acc_no = $_GET['acc_no'];
	if (isset($_GET['agent_name']) != null)
		$agent89 = $_GET['agent_name'];
	if (isset($_GET['product']))
		$product_tra = $_GET['product'];
	if (isset($_GET['detail']))
		$detail_tra = $_GET['detail'];
	if (isset($_GET['address']))
		$address_tra = $_GET['address'];

	if (isset($_GET['cus_email']))
		$cus_email = $_GET['cus_email'];

	if (isset($_GET['other_phone']))
		$other_phone=$_GET['other_phone'];


	

  //mysql_query("DELETE FROM `cart` WHERE `phone`='".$phone."'");
	?>

	<style type="text/css">
		table{
			width: 100%;
		}
		tr{
			width: 100%;
			height: 30px;
		}

		select{
			width: 100%;
		}
		.chosen{
			width: 100%;
		}
		input{
			width: 100%;
		}
	</style>
	<div class="container" style="color:white; font-size:12px;">
		<table align="center">
			<!-- <tr>
				<td width="575" valign="top"><?php include'menu.php'; ?>
			&nbsp;</td> -->
		</tr>
		<tr>
			<td valign="top">
				<form id="form1" name="form1" method="post">
					<table> 
						<?php 
							$check_previous_result=mysql_query("SELECT * FROM `billing_address` WHERE `phone`='$phone' ORDER BY id DESC LIMIT 1");
							$previous_data_count=mysql_num_rows($check_previous_result);
							if($previous_data_count>0)
							{
							$previous_data_row=mysql_fetch_assoc($check_previous_result);
							}
							else
							{
								$crm_data_result=mysql_query("SELECT * FROM `asterisk`.`crm_durbiin` WHERE `phone`='$phone' ORDER BY id DESC LIMIT 1");
								$previous_data_row=mysql_fetch_assoc($crm_data_result);
							}
						?>
						<tr>
							<td valign="top">Customer Name </td>
							<td valign="top"> : </td>
							<td valign="top" style="width: 120px;"><input name="cus_name" type="text"   id="cus_name" required value="<?php print $previous_data_row['name']; ?>"/></td>


							<td valign="top">Phone No</td>
							<td valign="top"> : </td>
							<td valign="top" style="width: 120px;">
								<input name="cus_phone" type="text"   required id="cus_phone" value="<?php print $previous_data_row['phone']; ?>" readonly/>
							</td>

							
							<td valign="top">Email</td>
							<td valign="top"> : </td>
							<td valign="top" style="width: 120px;"><input name="email" type="text"    id="email" value="<?php print $previous_data_row['email']; ?>" />
							</td>							
							
						</tr>

						<tr>
							<td>Brand</td>
							<td valign="top"> : </td>
							<td valign="top">
								<select name="group"   id="group" onchange="fetch_branchs(this.value);" required="required">
									<!-- <option value="NO">-Select Brand-</option> -->
									<?php
									include 'db.php';
									$result1 = mysql_query("select * FROM ticket_type WHERE `type_name` != 'Madchef'");
									while ($row = mysql_fetch_array($result1)) {
										?>
										<option value="<?= $row['type_name'] ?>">

											<?= $row['type_name'] ?>
										</option>
									<?php } ?>
								</select>
							</td>

							<td>Branch</td>
							<td valign="top"> : </td>
							<td valign="top">
								<select name="branch_name" id="branch_name" class="input"  onchange="fetch_product(this.value); fetch_adons(this.value);" required>
								</select>
							</td>


							<td valign="top">Type</td>
							<td valign="top"> : </td>
							<td valign="top">
								<select name="product_type" id="product_type" onclick="productlists(this.value);">
									<option value="All">All</option>
									<option value="half&half">Half & Half</option>
								</select>
							</td>
						</tr>
						<tr id="product_sections"></tr>
						<tr>
							<td valign="top">Add-ons </td>
							<td valign="top"> : </td>
							<td valign="top">
								<select name="add_ons" class="chosen" id="add_ons" onchange="add_ons_to_cart()" required>
									<option value="">Select Adons Product</option>
								</select>
							</td>

							<td valign="top">Delivery Address</td>
							<td valign="top"> : </td>
							<td valign="top" style="width: 120px;">
								<textarea name="cc" required  id="cc"><?php echo $previous_data_row['address']; ?></textarea>
								<!-- <input name="cc" type="text" required  id="cc" value="<?php print $order_address; ?>" /> -->
							</td>


							<td valign="top">Note</td>
							<td valign="top"> : </td>
							<td valign="top">
								<!-- <input name="note" type="text" id="note" value="<?php print $note; ?>" /> -->
								<textarea name="note" id="note"><?php print $note; ?></textarea>
							</td>
						</tr>
						<tr>
							<td valign="top">Discount</td>
							<td valign="top"> : </td>
							<td valign="top">
								<input name="discount" type="number"    id="discount" value="<?php print $discount; ?>" onchange="pick_discount()" />
								<script>
								$("#discount").on("input", function() {
									var nonNumReg = /[^0-9]/g
									$(this).val($(this).val().replace(nonNumReg, ''));
								});
							</script>
							</td>
						
							<td valign="top">Additional Phone</td>
							<td valign="top"> : </td>
							<td valign="top">
								<input name="additional_phone" type="text"  id="additional_phone" value="<?php print $previous_data_row['additional_phone']; ?>" />
							</td>
						</tr>
					</table>
					<div class="row justify-content-center">
						<div style="color: green; font-size: 14px;" id="message"></div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-striped text-center" style="background: beige;">
							<thead>
								<tr>
									<th>ID</th>
									<th>Image</th>
									<th>Product</th>
									<th>Size</th>                   
									<th>Quantity</th>
									<!-- <th>VAT</th> -->
									<!-- <th>SD</th> -->
									<th>Unit Price</th>
									<th>Total Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="cart_item"></tbody>
						</table>
					</div>
				</div>
			</form>       
			<tr>
				<td valign="top">
					<div align="center">
						<?php
						if (isset($_POST['Submit'])) {
							$brand = $_POST['brand'];
							$branch = $_POST['branch'];
							$delivery_address=$_POST['cc'];
							$email=$_POST['email'];
							$name=$_POST['cus_name'];
							$additional_phone=$_POST['additional_phone'];


							$productsql = "SELECT * FROM ticket.cart WHERE  phone = '".$phone."' AND `brand`='$brand' AND `branch`='$branch'";
							$product_list = mysql_query($productsql);
							$number_of_rows = mysql_num_rows($product_list);

							if($number_of_rows >0 ){
								$order_id = $_POST['cus_phone'].time();
								$discount = $_POST['discount'];
								$billing_result=mysql_query("INSERT INTO `billing_address`(`order_id`, `address`, `email`, `name`, `phone`, `additional_phone`) VALUES ('$order_id','$delivery_address','$email','$name','$phone','$additional_phone')");


								while ($prow = mysql_fetch_assoc($product_list)) {
									$order_sql = "INSERT INTO `order_list`(`phone`,`order_id`,`brand`, `branch`, `product_code`,`product_name`, `product_image`, `product_price`,`product_size`, `qty`,`vat`,`sd`,`total_price`,`product_from`) VALUES ('$phone','$order_id','".$_POST['group']."','".$_POST['branch_name']."','".$prow['product_code']."','".$prow['product_name']."','".$prow['product_image']."','".$prow['product_price']."','".$prow['product_size']."','".$prow['qty']."','".$prow['vat']."','".$prow['sd']."','".$prow['total_price']."','".$prow['product_from']."')";
									mysql_query($order_sql);
								}					

								mysql_query("INSERT INTO `discount`(`order_id`, `discount`) VALUES ('$order_id','$discount')");
								//############################# Clear Cart And Send SMS to the customer Start ##################################
								mysql_query("DELETE FROM `cart` WHERE `phone`='".$phone."' OR `phone`='NO'");
							}else{
								$order_id = '';
							}

							$order_info_sql = "SELECT SUM(`vat`) as vat,SUM(`sd`) as sd,SUM(`total_price`) as total_price FROM `order_list` WHERE `order_id` ='".$order_id."'";
							$order_info = mysql_fetch_assoc(mysql_query($order_info_sql));
							$total_Cost = ($order_info['vat'] + $order_info['sd'] + $order_info['total_price']);

							$discount_sql = "SELECT `discount` FROM `discount` WHERE `order_id` = '".$order_id."'";
							$discount = mysql_fetch_assoc(mysql_query($discount_sql));


							$discount_price = round($total_Cost - $discount['discount']);


							$msg = "Your Order ID ".$order_id." Total Amount = ".round($total_Cost)." Total Discount ".round($discount['discount'])." Total Payable Amount = ".$discount_price." -- Regards, MadDelivery (".$_POST['branch_name']."-".$_POST['group'].")";
							$phone = "+88".$_POST['cus_phone'];
							$message = urlencode($msg);
							// $message = $msg;
							// echo $message;
							$url = "http://sms.brilliant.com.bd:6005/api/v2/SendSMS?ApiKey=TqKYEIuJQKAEVf2zCR0yvTNEWOaD2XB1WTmmrjOO8l0=&ClientId=d3b4c920-0bee-49e5-8a7c-a104f940323a&SenderId=8809638050505&Message=$message&MobileNumbers=$phone";	
							$c = curl_init(); 
							curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
							curl_setopt($c, CURLOPT_URL, $url); 
							$response = curl_exec($c);
							if ($response) {
								echo 'success';
							}else{
								echo 'Curl error: ' . curl_error($c);
							}
							//############################# Clear Cart And Send SMS to the customer End ##################################


							if (isset($_POST['ishir'])) {
								include 'db.php';             

								mysql_query("SET CHARACTER SET utf8");
								mysql_query("SET SESSION collation_connection =utf8_general_ci");
								$date = date("d-m-Y");
								echo $date;
								$t = time();
								$stamp = $t + $date;
								$results = mysql_query("INSERT INTO `ticket`.`ticket` (`id`, `another_name`,`ticket_type`, `agent`, `assignd`, `group`, `total_amount`,`periority_type`,`quantity`,`branch_name`,`note`,`cus_contact`, `cus_name`,`email`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`,`order_id`) VALUES (NULL, '" . $_POST['another_name'] . "','" . $_POST['type'] . "', '" . $agent89 . "', '" . $_POST['to'] . "', '" . $_POST['group'] . "', '" . $_POST['total_amount'] . "','" . $_POST['quantity'] . "','" . $_POST['branch_name'] . "','" . $_POST['note'] . "','" . $_POST['periority_type'] . "', '" . $_POST['cus_phone'] . "', '" . $_POST['cus_name'] . "', '" . $_POST['email'] . "', '" . $_POST['account_id'] . "', '" . $_POST['product'] . "', '" . $_POST['amount'] . "', 'New', '" . $_POST['editor1'] . "', NOW(), '$stamp', '1',CONCAT((select superior_id from users where id=" . $_POST['to'] . "),\"" . $_POST['cc'] . "\")),'".$order_id."'");


								if ($results) {

									$result = mysql_query("SELECT id FROM ticket where stamp= '$stamp' ");



									$id_no = mysql_result($result, 0);

									$flag = '1';
									$Aperson = mysql_fetch_row(mysql_query("select user_name from users where id = " . $_POST['to']));
									echo "<font color='Blue'><h4>New Ticket ID number is $id_no. </h4></font>\n";
									include 'MSdatabase.php';
									/* INsert Into MSSQL DB */

									$fresh_Milk = strip_tags($_POST['editor1']);

									$ULTA = mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, [group],total_amount,quantity, branch_name,periority_type,cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors)           VALUES 
										(
										$id_no, 
										'" . $_POST['type'] . "', 
										'$agent89', 
										'$Aperson[0]',
										'0',
										'" . $_POST['cus_phone'] . "', 
										'" . $_POST['cus_name'] . "', 
										'CUSTOMER ACCOUNT', 
										'" . $_POST['product'] . "', 
										'" . $_POST['amount'] . "', 
										'New', 
										'" . $fresh_Milk . "', 
										GETDATE(), 
										$stamp, 
										'1', 
										'Superiors')");
								}
							} else {
								include 'db.php';
								mysql_query("SET CHARACTER SET utf8");
								mysql_query("SET SESSION collation_connection =utf8_general_ci");
								$date = date("d-m-Y");
								$t = time();
								$stamp = $t + $date;


								$results = mysql_query("INSERT INTO `ticket`.`ticket` (`id`, `another_name`,`ticket_type`, `agent`, `assignd`, `group`,`total_amount`,`quantity`,`branch_name`,`note`,`periority_type`, `cus_contact`, `cus_name`, `email`,`cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`,`order_id`) VALUES (NULL, '" . $_POST['another_name'] . "','" . $_POST['type'] . "', '" . $agent89 . "', '" . $_POST['to'] . "', '" . $_POST['group'] . "','" . $_POST['total_amount'] . "','" . $_POST['quantity'] . "','" . $_POST['branch_name'] . "','" . $_POST['note'] . "','" . $_POST['periority_type'] . "', '" . $_POST['cus_phone'] . "', '" . $_POST['cus_name'] . "', '" . $_POST['email'] . "', '" . $_POST['account_id'] . "', '" . $_POST['product'] . "', '" . $_POST['amount'] . "', 'New', '" . $_POST['editor1'] . "', NOW(), '$stamp', '1', '" . ($_POST['cc']) . "','".$order_id."')");


								if ($results) {

									$result = mysql_query("SELECT id FROM ticket where stamp= '$stamp' ");



									$id_no = mysql_result($result, 0);

									$flag = '1';
									$Aperson = mysql_fetch_row(mysql_query("select user_name from users where id = " . $_POST['to']));
									echo "<font color='Blue'><h4>New Order Serial number is $id_no. </h4></font>\n";
									include 'MSdatabase.php';
									/* INsert Into MSSQL DB */
									$fresh_Milk = strip_tags($_POST['editor1']);
									$ULTA = mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, [group], total_amount, quantity, branch_name,periority_type,cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors)             VALUES 
										(
										$id_no, 
										'" . $_POST['type'] . "', 
										'$agent89', 
										'$Aperson[0]',
										'0',
										'" . $_POST['cus_phone'] . "', 
										'" . $_POST['cus_name'] . "', 
										'CUSTOMER ACCOUNT', 
										'" . $_POST['product'] . "', 
										'" . $_POST['amount'] . "', 
										'New', 
										'" . $fresh_Milk . "', 
										GETDATE(), 
										$stamp, 
										'1', 
										'Superiors')");
								}
							}
						}
						?>
						&nbsp;
					</div>
				</td>
			</tr>
		</table>

		<p>&nbsp;</p>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('.chosen').chosen();
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {


			//############################################ Product List Control Start #######################################			
			var product_type = $('#product_type').val();
			productlists(product_type);

			fetch_branchs('Cheez');
			//############################################ Product List Control End #######################################
			load_cart_item_number();

			$(".itemQty").on('change', function() {
				var el = $(this).closest('tr');

				var pid = el.find(".pid").val();
				var pprice = el.find(".pprice").val();
				var qty = el.find(".itemQty").val();
				location.reload(true);
				$.ajax({
					url: 'action2.php',
					method: 'post',
					cache: false,
					data: {

						qty: qty,
						pid: pid,
						pprice: pprice
					},
					success: function(response) {						
					}
				});
			});
		});

		function add_to_cart(){
			var brand=$('#group').val();
			var branch=$('#branch_name').val();			
			var product_id = $('#search_text').val();			
			var phone      = $('#cus_phone').val();
			var primary_product = $('#primary_product').val();
			var secoundary_product = $('#secoundary_product').val();

			$.ajax({
				url : "fetch.php",
				type : "POST",
				data : {
					brand:brand,
					branch:branch,
					phone:phone,
					product_id : product_id,
					primary_product:primary_product,
					secoundary_product:secoundary_product
				},
				success : function(data){
					load_cart_item_number();
				}
			});
		}


		function add_ons_to_cart(){
			var brand=$('#group').val();
			var branch=$('#branch_name').val();
			var product_id = $('#add_ons').val();
			var phone      = $('#cus_phone').val();
			$.ajax({
				url : "fetch.php",
				type : "POST",
				data : {
					brand:brand,
					branch:branch,
					phone:phone,
					add_ons_product_id : product_id
				},
				success : function(data){
					load_cart_item_number();					
				}
			});
		}

		function delete_from_cart(cart_id){
			$.ajax({
				url : "action2.php",
				type : "GET",
				data : { 
					cart_id:cart_id
				},
				success : function(data){
					$("#message").html(data);
					load_cart_item_number();
				}
			});
		}

		function fetch_branchs(val){

			$.ajax({
				type: 'post',
				url: 'fetch_branch.php',
				data: {
					get_option:val
				},
				success: function (response) {
					document.getElementById("branch_name").innerHTML=response;
					var branch = $('#branch_name').val();					
					fetch_product(branch);
					fetch_adons(branch);

				}
			});
		};

		function fetch_product(branch){
			var brand = $('#group').val();
			var product_type = $('#product_type').val();
			var product_list = 'productlists';
			var from ='add_to_cart';
			$.ajax({
				type: 'post',
				url: 'fetch_product.php',
				data: {
					brand:brand,
					branch:branch,
					product_type:product_type,
					product_list:product_list
				},
				success: function (response) {
					load_cart_item_number();
					$("#product_sections").html(response);
					$("#product_sections").trigger("chosen:updated");
				}
			});
		};

		// fetch_adons
		function fetch_adons(branch_name)
		{
			// alert(branch_name);
			$.ajax({
				type: 'post',
				url: 'fetch_adons.php',
				data: {
					branch_name:branch_name
				},
				success: function (response) {
					$("#add_ons").html(response);
					$("#add_ons").trigger("chosen:updated");
				}
			});
		}
	</script>
	<script type="text/javascript">
		function calculate_quantity(cart_id){
			var quantity = $('#qty'+cart_id).val();
			var product_id = $('#product_id'+cart_id).val();
			var product_from  =$('#product_from'+cart_id).val();
			$.ajax({
				url: "maction.php",
				type: "POST",
				data: {
					quantity:quantity,
					product_id:product_id,
					cart_id:cart_id,
					product_from:product_from    
				},
				cache: false,
				success: function(response){
					load_cart_item_number();
				}
			});
		}

		function total_price(){
			var search_key = $('#strkey').val();
			$.ajax({
				url: "maction.php",
				type: "POST",
				data: {
					search_key:search_key    
				},
				cache: false,
				success: function(response){
					$('#grand_total').html(response); 


				}
			});
		}

		function vat(){
			var vat = $('#strkey').val();
			$.ajax({
				url: "maction.php",
				type: "POST",
				data: {
					vat:vat    
				},
				cache: false,
				success: function(response){
					$('#vat').html(response); 
				}
			});
		}


		function total_with_vat(){
			var total_with_vat = $('#strkey').val();
			$.ajax({
				url: "maction.php",
				type: "POST",
				data: {
					total_with_vat:total_with_vat    
				},
				cache: false,
				success: function(response){
					$('#total_with_vat').html(response); 
				}
			});
		}

		function remove_item(product_id){
			$.ajax({
				url: "maction.php",
				type: "POST",
				data: {
					delete_product_id:product_id    
				},
				cache: false,
				success: function(response){
					product_list();
				}
			});
		}

		function product_list(){
			var search_key = $('#strkey').val();
			$.ajax({
				url: "maction.php",
				type: "POST",
				data: {
					searchkey:search_key    
				},
				cache: false,
				success: function(response){
					$("#filter_data_container").html(response);
				}
			});
		}
	</script>
</body>
</html>




