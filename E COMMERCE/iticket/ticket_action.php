<?php
include 'db.php';
if (isset($_POST['cus_phone'])) {
	$phone = $_POST['cus_phone'];
	$order_id = $phone."_".time();

	$productsql = "SELECT * FROM ticket.cart WHERE  phone = '".$phone."'";
	$product_list = mysql_query($productsql);
	while ($prow = mysql_fetch_assoc($product_list)) {
		$order_sql = "INSERT INTO `order_list`(`order_id`,`brand`, `branch`, `product_name`, `product_image`, `unite_price`, `quantity`, `total_price`) VALUES ('$order_id','".$_POST['group']."','".$_POST['branch_name']."','".$prow['product_name']."','".$prow['product_image']."','".$prow['product_price']."','".$prow['qty']."','".$prow['total_price']."')";
		if(mysql_query($order_sql)){
			mysql_query("DELETE FROM `cart` WHERE `phone`='".$phone."'");
		}
	}
}
?>