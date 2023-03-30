
<?php

  include 'db.php';
 $order_id = $_POST['order_id'];

 echo  $order_id;
 $brand = $_POST['brand'];
 $branch = $_POST['branch'];
 $product_name = $_POST['product_name'];
 $product_image = $_POST['product_image'];
 $product_price = $_POST['product_price'];
 $qty = $_POST['qty'];
 $total_price = $_POST['total_price'];


	$sql = "UPDATE order_list SET brand='$brand',branch='$branch', product_name='$product_name', product_image='$product_image', product_price='$product_price',qty='$qty', total_price='$total_price' WHERE order_id='$order_id'";

	$result = mysql_query($sql);
	if($result){
		echo 'Update Successfully...';
	}
	else{
		echo 'Not Update....';

	}
?>