<?php
require 'config.php';
if (isset($_POST['product_id'])) {
	$product_id = $_POST['product_id'];
	$quantity = $_POST['quantity'];
	$product_from = $_POST['product_from'];
	$sql = "SELECT `product_price`,`product_code`,`product_from` FROM `order_list` WHERE `id`='$product_id'";
	$response = $conn->query($sql)->fetch_assoc();
	echo $new_price = $response['product_price'] * $quantity;
	$vat = $new_price*(10/100);

	if($product_from == 'main_product'){
		$psql = "SELECT * FROM `product` WHERE `id`='".$response['product_code']."'";		
	}
	if ($product_from == 'ad_ons_product') {
		$psql = "SELECT * FROM `add_ons` WHERE `id`='".$response['product_code']."'";
	}
	$product = $conn->query($psql)->fetch_assoc();
	$sd =  $new_price*($product['sd']/100);
	$conn->query("UPDATE `order_list` SET `qty`='$quantity',`total_price`='$new_price',`vat`='$vat',`sd`='$sd' WHERE `id`='$product_id'");
}

if (isset($_POST['search_key'])) {
	$strkey = $_POST['search_key'];
	$sql = "SELECT SUM(`total_price`) as total FROM `order_list` WHERE product_name LIKE '%$strkey%' || product_price LIKE '%$strkey%'";
	$response = $conn->query($sql)->fetch_assoc();
	echo $new_price = $response['total'];
}
if (isset($_POST['delete_product_id'])) {
	$product_id = $_POST['delete_product_id'];
	$deletesql = "DELETE FROM `order_list` WHERE `id`='$product_id'";
	$conn->query($deletesql);	
}
if (isset($_POST['searchkey'])) {
	$strkey=$_POST['searchkey'];
	$result = $conn->query("SELECT * FROM ticket.order_list WHERE  `order_id` ='$strkey'");
	$grand_total = 0;
	while ($row = $result->fetch_assoc()) {
		?>
		<tr>
			<td><?= $row['id'] ?></td>
			<input type="hidden" class="pid" value="<?= $row['id'] ?>">
			<input type="hidden" name="strkey" id="strkey" value="<?php echo $strkey;?>">
			<td><img src="<?= $row['product_image'] ?>" width="50"></td>
			<td><?= $row['product_name'] ?></td>
			<td>
				&#2547;&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
			</td>
			<input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
			<td>
				<input type="number" id="qty<?php echo $row['id']?>" class="form-control itemQty" value="<?= $row['qty'] ?>" onchange="calculate_quantity(<?php echo $row['id'];?>)" style="width:75px;">
			</td>
			<td>&#2547;&nbsp;&nbsp;<?php echo number_format($row['vat'],2)?></td>
                <td>&#2547;&nbsp;&nbsp;<?php echo number_format($row['sd'],2)?></td>
			<td>&#2547;&nbsp;&nbsp;<span id="total_price<?php echo $row['id']?>"><?= number_format($row['total_price'],2); ?></span></td>
			<td>
				<div onclick="remove_item(<?= $row['id'] ?>)" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></div>
			</td>
		</tr>
		<?php 
		$grand_total += $row['total_price'];
	} 
	?>
	<tr>
		<td colspan="3">
		</td>
		<td colspan="2"><b>Grand Total</b></td>
		<td><b><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<span id="grand_total"><?= number_format($grand_total,2); ?></span></b></td>
		<td>
			<button class="btn btn-success" type="submit" name="Submit" id="place_order">Update Order</button>
		</td>
	</tr>

	<?php
}
?>