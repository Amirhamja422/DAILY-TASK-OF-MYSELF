

<?php
include '../db.php';
if (isset($_GET['userid'])) {
	$userid = $_GET['userid'];
	$results=mysql_query("SELECT `id`,`user_name`,`user_group_id`,previlege,superior_id,designation,user_pass,concern,complain_id FROM `users` WHERE `id`='".$userid."' ");
	while($rows=mysql_fetch_assoc($results)){
		$groupid=mysql_fetch_array(mysql_query("SELECT id,group_name FROM user_group  WHERE id='".$rows['user_group_id']."'"))
		?>
		<form class="form-horizontal" action="#" method="POST" id="myform">
			<div class="col-md-12" style="float: left; padding: 10px;">
				<div class="col-sm-4" style="float: left;">Full Name:</div>
				<div class="col-sm-8" style="float: left;">
					<input type="text" class="form-control" id="uname" placeholder="Enter Full Name" name="uname" value="<?php echo $rows['user_name'];?>" required="required">
				</div>
			</div>

			<div class="col-md-12" style="float: left; padding: 10px;">
				<div class="col-sm-4" style="float: left;">User Privileges:</div>
				<div class="col-sm-8" style="float: left;">
					<select class="form-control" name="prev" id="prev_id">
						<option <?php if($rows['previlege'] == 0){ echo "selected";}?> value="0">Administrator</option>
						<option <?php if($rows['previlege'] == 2){ echo "selected";}?> value="2">Group Admin</option>
						<option <?php if($rows['previlege'] == 3){ echo "selected";}?> value="3">Report Update</option>
					</select>
				</div> 
			</div> 

			<div class="col-md-12" style="float: left; padding: 10px;">
				<div class="col-sm-4 control-label" style="float: left;">Department:</div>
				<div class="col-sm-8" style="float: left;">
					<select class="form-control" id="group_id" name="gi" onchange="changeText5(this.value)">
						<option>Select A Group</option>
						<?php
						$result1 = mysql_query("SELECT * FROM user_group ORDER BY group_name ASC");
						while ($row = mysql_fetch_array($result1)) {
							?>
							<option value="<?= $row['id'] ?>" <?php if($rows['user_group_id'] == $row['id']){echo "Selected";}?>>
								<?= $row['group_name'] ?>
							</option>
						<? } ?>
						?>
					</select>
				</div>
			</div>
			<div class="col-md-12" style="float: left; padding: 10px;" id="type_div">
				<div class="col-sm-4" style="float: left;">Service:</div>
				<div class="col-sm-8" style="float: left;" onchange="changeText4(this.value)">
					<select class="form-control" id="type">
						
					</select>
				</div>
			</div>
			<div class="col-md-12" style="float: left; padding: 10px;" id="concern_div">
				<div class="col-sm-4 control-label" style="float: left;">Selected Service:</div>
				<div class="col-sm-8 control-label" style="float: left;">
					<input type="text" class="form-control" value="<?php echo $rows['concern']; ?>" name="concern" readonly placeholder="Selected Complaint" id="cc">
				</div>
			</div>
			<div class="col-md-12" style="float: left; padding: 10px;" id="complain_div">
				<div class="col-sm-4" style="float: left;">Complaint Type:</div>
				<div class="col-sm-8" style="float: left;">
					<select class="form-control" id="complaint_type" onchange="changeText6(this.value)">
						
					</select>
				</div>
			</div>
			<div class="col-md-12" style="float: left; padding: 10px;" id="complaint_val">
				<div class="col-sm-4 control-label" style="float: left;">Selected Complaint:</div>
				<div class="col-sm-8 control-label" style="float: left;">
					<input type="text" class="form-control" value="<?php echo $rows['complain_id']; ?>" name="complain_id" readonly placeholder="Selected Complaint" id="complain_id">
				</div>
			</div>


			<input type="hidden" name="id" value="<?php echo $userid;?>">
			<input type="hidden" id="concern_ready" value="<?php echo $rows['concern'];?>">

			<div class="col-md-12" style="float: left; padding: 10px;">
				<div class="col-sm-4" style="float: left;">Password:</div>
				<div class="col-sm-8" style="float: left;">
					<input type="text" class="form-control" id="password" placeholder="Enter user password" name="password" value="<?php echo $rows['user_pass'];?>">
				</div>
			</div>

			<div class="col-md-12" style="float: left; padding: 10px;">
				<div class="col-sm-4" style="float: left; visibility: hidden;">Button</div>
				<div class="col-sm-8" style="float: left;">
					<input type="submit" name="updtuser" value="Submit" class="btn btn-success">
				</div>
			</div>
		</form>

		<?php
	}
}
?>
<script type="text/javascript">

	$( document ).ready(function() {

	    var id = $("#group").val();

		$.ajax({
			data: "id="+id,
			url: "../kullu/change2.php",
			type: "GET",
			success: function(data){
				document.getElementById("type").innerHTML = data;
			}
		});

		var prev_id = $("#prev_id").val();
		
		if (prev_id == '2') {
			$("#type_div").hide();
			$("#concern_div").hide();
			$("#complain_div").hide();
			$("#complaint_val").hide();

			$("#type_div").val('');
			$("#concern_div").val('');
			$("#complaint_type").val('');
			$("#complaint_val").val('');
		} 

		$('#prev_id').change(function(e){
		var prev_id = $("#prev_id").val();

		if (prev_id == '3') {
			$("#type_div").show();
			$("#concern_div").show();
			$("#complain_div").show();
			$("#complaint_val").show();
		} else if (prev_id == '2') {
			$("#type_div").hide();
			$("#concern_div").hide();
			$("#complain_div").hide();
			$("#complaint_val").hide();

			$("#type_div").val('');
			$("#concern_div").val('');
			$("#complaint_type").val('');
		} else if (prev_id == '0') {
			$("#type_div").hide();
			$("#concern_div").hide();
			$("#complain_div").hide();
			$("#complaint_val").hide();

			$("#type_div").val('');
			$("#concern_div").val('');
			$("#complaint_type").val('');
		}
                                
		});

	});

	$('#group_id').change(function(e){
		var id = $("#group_id").val();

		$.ajax({
			data: "id="+id,
			url: "../kullu/change_2.php",
			type: "GET",
			success: function(data){
				document.getElementById("type").innerHTML = data;
				$("#complain_id").val('');
				$("#cc").val('');
			}
		});                                
	});

	$('#type').change(function(e){
		var id = $("#group_id").val();
		var type_id = $("#type").val();

		$.ajax({
			data: "id="+id+"&type="+type_id,
			url: "../kullu/change_3.php",
			type: "GET",
			success: function(data){
				document.getElementById("complaint_type").innerHTML = data;
			}
		});

		$.ajax({
			data: "id="+id+"&type_id="+type_id,
			url: "../kullu/change_0.php",
			type: "GET",
			success: function(data){
				document.getElementById("to").innerHTML = data;
			}
		});
	});

	function changeText6(str) {
      document.getElementById('complain_id').value = document.getElementById('complain_id').value + "," + document.getElementById('complaint_type').value;
  	}

  	function changeText5(str) {
      document.getElementById('gi_id').value = document.getElementById('gi_id').value + "," + document.getElementById('group_id').value;
  	}

  	function changeText4(str) {
      document.getElementById('cc').value = document.getElementById('cc').value + "," + document.getElementById('type').value;
  	}

  	$( document ).ready(function() {
	    var id = $("#group_id").val();
	    var concern_ready = $("#concern_ready").val();

		$.ajax({
			data: "id="+id+"&concern_ready="+concern_ready,
			url: "../kullu/change_2.php",
			type: "GET",
			success: function(data){
				document.getElementById("type").innerHTML = data;
			}
		});

		$.ajax({
			data: "id="+id+"&type="+concern_ready,
			url: "../kullu/change_3.php",
			type: "GET",
			success: function(data){
				document.getElementById("complaint_type").innerHTML = data;
			}
		});
	});

	
</script>
