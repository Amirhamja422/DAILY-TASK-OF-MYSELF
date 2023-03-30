<?php

include_once 'database.php';
if (isset($_POST['get_option'])) {
	$type = $_POST['get_option'];
	$sql=mysqli_fetch_assoc($con->query("SELECT category FROM product WHERE category='$type'"));
	$category = $sql['category'];
	$results44 = mysqli_query($con, "SELECT  * FROM `restaurant`.`adons_product` WHERE `category`='$category'");
	?>
	<select name="sub_category_name" id="sub_category_name" class="form-control"  style="padding: 0px;" >
		<option value="">Select A Sub Category</option>
		<?php
		while($row=mysqli_fetch_assoc($results44))
		{?>
			<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
			<?php
		}
		?>
	</select>
	<?php
}



//#################################### Fetch Ad ons ##########################
if (isset($_POST['category'])) {
	$brand = $_POST['brand'];
	$branch = $_POST['branch'];
	$category = $_POST['category'];
	$sql ="SELECT * FROM `adons_product` WHERE `brand`='$brand' AND  `branch`='$branch' AND `category`='$category'";
	$result=$con->query($sql);
	while($row=mysqli_fetch_assoc($result)){?>
		<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
		<?php
	}
}
//#################################### Fetch Adons ##########################



if (isset($_POST['branch'])) {
	$type = $_POST['branch'];
	$sql=$con->query("SELECT branch FROM branch WHERE brand='$type'");
	?>
	<select name="branch" id="branch" class="form-control"  style="padding: 0px;" >
		<option value="">Select A Branch</option>
		<?php
		while($row=mysqli_fetch_assoc($sql))
		{
			?>
			<option value="<?php echo $row['branch']; ?>"><?php echo $row['branch']; ?></option>
			<?php
		}
		?>
	</select>
	<?php
}


if (isset($_POST['all_product'])) {
	$type = $_POST['all_product'];
	$sql=$con->query("SELECT name FROM su_product WHERE category='$type'");
	?>
	<select name="branch" id="branch" class="form-control"  style="padding: 0px;" >
		<option value="">Select A Branch</option>
		<?php
		while($row=mysqli_fetch_assoc($sql))
		{?>
			<option value="<?php echo $row['name']; ?>"><?php echo $row['name']; ?></option>
			<?php
		}
		?>
	</select>
	<?php
}