
<?php
include_once 'database.php';
if (isset($_POST['post_id'])) {
	$id_update = $_POST['post_id'];
	$subcategory_update = $_POST['post_subcategory'];


	$sql = "UPDATE `subcategory` SET `subcategory`='$subcategory_update' WHERE `id`='$id_update'";

	// echo $sql;

	$result = mysqli_query($con,$sql);
	if($sql){
		echo 'data sucessfully updated';
	}
	else{
		echo 'failed to update Record';

	}
}

$id=$_POST['id'];
$sql = "SELECT * FROM subcategory WHERE `id`='$id'";
$result = mysqli_query($con,$sql);
$assoc=mysqli_fetch_assoc($result);

if (isset($_POST['id'])) {

	?>
	<div class="form-group">
<!-- 		<label for="input" class="col-sm-3 control-label">Category</label>
 -->		<div class="col-sm-9">
			<input type="hidden" class="form-control"name="category_update" id="id_update" type="text" value="<?php echo $assoc['id']; ?>" placeholder="Enter Youser Name" required="required">
		</div>
	</div>	
<!-- <br><br>
	<div class="form-group">
		<label for="input" class="col-sm-3 control-label">Category</label>
		<div class="col-sm-9">
			<input type="text" class="form-control"name="category_update" id="category_update" type="text" value="<?php echo $assoc['category']; ?>" placeholder="Enter Youser Name" required="required">
		</div>
	</div> -->
	<br>
	<div class="form-group">
		<label for="input" class="col-sm-3 control-label">Subcategory</label>
		<div class="col-sm-9">
			<input type="text" class="form-control"name="subcategory_update" id="subcategory_update" type="text" value="<?php echo $assoc['subcategory']; ?>" placeholder="Enter Youser Name" required="required">
		</div>
	</div>


	
	<?php
}

?>