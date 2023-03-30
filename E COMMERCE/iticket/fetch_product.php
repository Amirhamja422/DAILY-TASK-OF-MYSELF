	<?php

	$username = "root";
	$password = "iHelpBD@2017";
	$hostname = "localhost";

	$con = mysql_connect($hostname, $username, $password)
	or die("Unable to connect to MySQL");
	mysql_select_db("ticket",$con);



	if(!$con){
		die('Could not connect to database! Server ip - '.$hostname.' <br/>');
	}
	if (isset($_POST['product_list'])) {
		$barnd = $_POST['brand'];
		$branch = $_POST['branch'];
		$product_type = $_POST['product_type'];
		$from = $_POST['from'];

		echo $from;

		if($product_type == 'All'){
			$sql="SELECT `id`,`product_name`, `product_price`, `product_image`, `status`,`product_size` FROM `ticket`.`product` where  branch='$branch' AND brand='$barnd' ORDER BY id";
			?>
			<td valign="top"> Product List</td>
			<td valign="top"> : </td>
			<td valign="top">
				<select name="search_text" class="chosen" id="search_text" required  style=" max-width: 120px;"
				onchange="<?php if ($from  == 'order_update') { echo 'add_to_order()';}else{ echo 'add_to_cart()';}?>">
				<option value="option_header">Select Product</option>
				<?php
				$color = "color:red";
				$result1 = mysql_query($sql);
				while ($row1 = mysql_fetch_array($result1)) { ?>
					<option <?php if($row1['status']==0) {  echo "style='color:red'";  } ?> value="<?php echo $row1['id']; ?>">
						<?php echo  $row1['product_name']."-".$row1['product_size']." TK - ".$row1['product_price'];?>
					</option>
					<?php
				}
				?>
			</select>
		</td>

		<?php
	}else{
		$sql2="SELECT `id`,`product_name`, `product_price`, `product_image`, `status`,`product_size` FROM `ticket`.`product` where  branch='$branch' AND brand='$barnd' AND `type` = '$product_type' ORDER BY id DESC";
		?>
		<td valign="top">Half Product </td>
		<td valign="top"> : </td>
		<td valign="top">
			<select name="primary_product" class="chosen" id="primary_product" style=" max-width: 120px;" required onchange="select_secoundary_product(this.value)">
				<option value="option_header">Select Product</option>
				<?php
				$color = "color:red";
				$result2 = mysql_query($sql2);
				while ($row2 = mysql_fetch_array($result2)) { ?>

					<option <?php if($row2['status']==0) {  echo "style='color:red'";  } ?> value="<?php echo $row2['id']; ?>">
						<?php
						echo  $row2['product_name']."-".$row2['product_size']." TK - ".$row2['product_price'] ;
						?>
					</option>

					<?php
				}
				?>
			</select>
		</td>


		<td valign="top"> Another Half</td>
		<td valign="top"> : </td>
		<td valign="top">
			<div id="secondary_product_list">		
				<select name="secoundary_product" class="chosen" id="secoundary_product" required>
					<option value="option_header">Select Another Half Product</option>
				</select>
			</div>	
		</td>
		<?php
	}
}

if (isset($_POST['primary_product']) && isset($_POST['brand']) && isset($_POST['branch'])) {
	$brand=$_POST['brand'];
	$branch=$_POST['branch'];
	$primary_product=$_POST['primary_product'];
	$product_type = $_POST['product_type'];
	$from = $_POST['from'];

	$secoundary_product_sql = "SELECT `id`,`product_name`, `product_price`, `product_image`, `status`,`product_size` FROM `ticket`.`product` WHERE  branch='$branch' AND brand='$brand' AND `type` = '$product_type' AND `product_size` LIKE (SELECT `product_size` FROM `product` WHERE `id`='$primary_product') AND `id` !='$primary_product' ORDER BY id DESC";
	?>
	<select name="secoundary_product" class="chosen" id="secoundary_product" required 
	onchange="<?php if ($from  == 'order_update') { echo "add_to_order()";}else{ echo "add_to_cart()";}?>">
	<option value="option_header">Select Product</option>
	<?php
	$color = "color:red";
	$result3 = mysql_query($secoundary_product_sql);
	while ($row3 = mysql_fetch_array($result3)) { ?>
		<option <?php if($row3['status']==0) {  echo "style='color:red'";  } ?> value="<?php echo $row3['id']; ?>">
			<?php
			echo  $row3['product_name']."-".$row3['product_size']." TK - ".$row3['product_price'] ;
			?>
		</option>
		<?php
	}
	?>
</select>
<?php
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.chosen').chosen();
	});
</script>
