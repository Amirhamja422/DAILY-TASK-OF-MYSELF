<?php
include_once '../../database.php';

//#################################### Fetch Branch start ##########################
if (isset($_POST['branch']) && $_POST['fetch_branch'] == 'fetch_branch') {
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
//#################################### Fetch branch end ##########################


//#################################### Fetch Ad ons  start ##########################
if (isset($_POST['category']) && $_POST['fetch_adons'] == 'fetch_adons') {
	$brand = $_POST['brand'];
	$branch = $_POST['branch'];
	$category = $_POST['category'];
	$sql ="SELECT * FROM `adons_product` WHERE `brand`='$brand' AND  `branch`='$branch' AND `category`='$category'";
	$result=$con->query($sql);
	?>
	<select name="adons_id[]" class="js-example-basic-multiple"   id="adons_id" style="width: 320px;" multiple="multiple">
		<?php
		while($row=mysqli_fetch_assoc($result)){?>
			<option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
			<?php
		}
		?>
	</select>
	<?php
}
//#################################### Fetch Adons end ##########################
?>