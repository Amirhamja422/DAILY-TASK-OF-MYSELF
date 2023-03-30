<?php
require 'config.php';
if (isset($_POST['cart_id'])) {
	$cart_id = $_POST['cart_id'];
	$quantity = $_POST['quantity'];
	$product_id = $_POST['product_id'];
	$product_from = $_POST['product_from'];
	if($product_from=='main_product'){
		$sql = "SELECT `product_price`,`vat`,`sd` FROM `product` WHERE `id`='$product_id'";
	}else{
		$sql = "SELECT `product_price`,`vat`,`sd` FROM `add_ons` WHERE `id`='$product_id'";
	}	
	$response = $conn->query($sql)->fetch_assoc();
	echo $new_price = $response['product_price'] * $quantity;	
	$sd = $new_price * ($response['sd']/100);
	$vat = ($new_price + $sd) * (10/100);
	$upsql = "UPDATE `cart` SET `qty`='$quantity',`total_price`='$new_price' ,`vat`='$vat',`sd`='$sd' WHERE `id`='$cart_id'";
	$conn->query($upsql);
}
?>