
<?php
session_start();
if($_SESSION['previlege'] == 0){
	$suc=NULL;
	$fail=NULL;

	if(isset($_POST['adduser']))
	{
		include '../db.php';

		$second = ($_POST['hour_time']*3600);
		if(mysql_query("INSERT INTO `ticket_dev`.`users` (`id`,`designation`,`superior_id`, `user_id`, `user_pass`, `user_name`, `user_email`, `user_group_id`, `previlege`,`phone`,`concern`) VALUES (NULL,'".$_POST['designa']."','".$_POST['superi']."', '".$_POST['uid']."','".$_POST['upass']."','".$_POST['uname']."','".$_POST['uemail']."','".$_POST['gi']."','".$_POST['prev']."','".$_POST['uphone']."','".$_POST['concern']."')")){
			$suc="User Inserted Successfully";
		}else{
			$fail="Faild to create New User";
		}

	}

	if(isset($_POST['updtuser'])){
		include '../db.php';
		$userid = $_POST['id'];
		if(mysql_query("UPDATE`ticket_dev`.`users` SET `user_name`='".$_POST['uname']."',`user_group_id`='".$_POST['gi']."', `previlege`='".$_POST['prev']."',`concern`='".$_POST['concern']."',`user_pass`='".$_POST['password']."' WHERE `id` ='".$userid."'")){
			$suc="User Updatrd Successfully";
		}else{
			$fail="Faild to uodate User";
		}
	}

	include 'header.php';
	?>
	<main class="py-4">
		<div class="container">
			<div id="userModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body" id="userdetail"></div>
					</div>
				</div>
			</div>

			<!-- //Create User Modal -->
			<div class="modal fade" id="createUser" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-body">
							<form class="form-horizontal" action="#" method="POST">


								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">New User Name:</div>
									<div class="col-sm-8" style="float: left;">
										<input type="text" class="form-control" id="uname" placeholder="Enter Full Name" name="uname" required="required">
									</div>
								</div>


								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">User Designation:</div>
									<div class="col-sm-8" style="float: left;">
										<input type="text" class="form-control" id="designa" placeholder="Enter Euser Designation" name="designa" required="required">
									</div>
								</div>

								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">Email ID :</div>
									<div class="col-sm-8" style="float: left;">
										<input type="email" class="form-control" id="uemail" placeholder="Enter E-mail ID" name="uemail" required="required">
									</div>
								</div>

								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">Phone Number:</div>
									<div class="col-sm-8" style="float: left;">
										<input type="number" class="form-control" id="uphone" placeholder="EnterPhone Number" name="uphone" required="required">
									</div>
								</div>

								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">User ID:</div>
									<div class="col-sm-8" style="float: left;">
										<input type="text" class="form-control" id="uid" placeholder="Enter User short Name" name="uid" required="required">
									</div>
								</div>
								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">User Password :</div>
									<div class="col-sm-8" style="float: left;">
										<input type="password" class="form-control" id="upass" placeholder="Enter password" name="upass" required="required">
									</div>
								</div>



								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4 control-label" style="float: left;">Department:</div>
									<div class="col-sm-8" style="float: left;">
										<select class="form-control" name="gi" id="group">
											<option>Select A Group</option>
											<?php
											$result1 = mysql_query("select *FROM user_group ORDER BY group_name ASC");
											while ($row = mysql_fetch_array($result1)) {
												?>
												<option value="<?= $row['id'] ?>">
													<?= $row['group_name'] ?>
												</option>
											<? } ?>
											?>
										</select>
									</div>
								</div>
								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">Service:</div>
									<div class="col-sm-8" style="float: left;">
										<select class="form-control" name="concern" id="type">
											<option>Select A Ticket Type</option>
										</select>
									</div>
								</div>

								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">User Privileges:</div>
									<div class="col-sm-8" style="float: left;">
										<select class="form-control" name="prev" id="prev">
											<option value="" selected disabled>Select A Privileges</option>
											<option value="0">Administrator</option>
											<option value="1">Create Ticket</option>
											<option value="2">Group Admin</option>
											<option value="3">Report Update</option>
										</select>
									</div>
								</div>

								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left; visibility: hidden;">Button</div>
									<div class="col-sm-8" style="float: left;">
										<input type="submit" name="adduser" value="Submit" class="btn btn-success">
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>



			<div class="row justify-content-center">
				<div class="col-md-12">

					<div class="col-md-12">
						<div class="card">
							<div class="card-header">Employee<button class="btn btn-outline-primary btn-sm float-right" data-toggle="modal" data-target="#createUser">Add Employee</button></div>

							<div class="card-body">
								<?php
								if($suc != NULL){?>
									<div class="btn-success text-center" style="font-size: 25px;">
										<?php 
										echo $suc;
										unset($suc);
										echo "<script>
										setTimeout(function () {
											window.location.replace('". $_SERVER['REQUEST_URI']."')
											}, 3000);
											</script>";
											?>
										</div>
										<?php
									}
									if ($fail != NULL) {?>
										<div class="btn-danger text-center" style="font-size: 25px;">
											<?php 
											echo $fail;
											unset($fail);
											echo "<script>setTimeout(function () {
												window.location.replace('". $_SERVER['REQUEST_URI']."')
											}, 3000);</script>";
											?>
										</div>
										<?php
									}

									?>
									<table class="table table-bordered">
										<thead>
											<tr>
												<th scope="col">#</th>
												<th scope="col">Full Name</th>
												<th scope="col">Department</th>
												<th scope="col">Service</th>
												<th scope="col">User Role</th>
												<th scope="col">Password</th>
												<th scope="col">Edit</th>
												<th scope="col">Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<?php include 'bralist2.php'; ?>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	<script type="text/javascript">
		$('#group').change(function(e){
			var id = $("#group").val();

			$.ajax({
				data: "id="+id,
				url: "../kullu/change2.php",
				type: "GET",
				success: function(data){
					document.getElementById("type").innerHTML = data;
				}
			});                                
		});

		$('#type').change(function(e){
			var id = $("#group").val();
			var type_id = $("#type").val();

			$.ajax({
				data: "id="+id+"&type="+type_id,
				url: "../kullu/change3.php",
				type: "GET",
				success: function(data){
					document.getElementById("sub_group").innerHTML = data;
				}
			});

			$.ajax({
				data: "id="+id+"&type_id="+type_id,
				url: "../kullu/change.php",
				type: "GET",
				success: function(data){
					document.getElementById("to").innerHTML = data;
				}
			});
		});
	</script>
	<script>
		function edituser(userid){
			// alert(userid);
			$.ajax({
				url:'user_action.php',
				method:'GET',
				data:{
					userid:userid,
				},
				success:function(data){
					$('#userdetail').html(data);
					$('#userModal').modal('show');
				}
			});
		}
	</script>

	<?php include 'footer.php';
}elseif ($_SESSION['previlege'] == 3) {
	echo "<script>
	window.location.replace('http://103.106.236.36:8081/iticket/admin/update.php')</script>";
}elseif ($_SESSION['previlege'] == 1) {
	echo "<script>
	window.location.replace('http://103.106.236.36:8081/iticket/admin/create_ticket.php')</script>";
}elseif ($_SESSION['previlege'] == 2) {
	echo "<script>
	window.location.replace('http://103.106.236.36:8081/iticket/admin/update.php')</script>";
}
?>