
<?php
session_start();
if($_SESSION['previlege'] == 0){
	$suc=NULL;
	$fail=NULL;

	if(isset($_POST['adduser']))
	{
		include '../db.php';

		$second = ($_POST['hour_time']*3600);
		if(mysql_query("INSERT INTO `ticket_dev`.`users` (`id`,`designation`,`superior_id`, `user_id`, `user_pass`, `user_name`, `user_email`, `user_group_id`, `previlege`,`phone`,`concern`,`complain_id`) VALUES (NULL,'".$_POST['designa']."','".$_POST['superi']."', '".$_POST['uid']."','".$_POST['upass']."','".$_POST['uname']."','".$_POST['uemail']."','".$_POST['gi']."','".$_POST['prev']."','".$_POST['uphone']."','".$_POST['concern']."','".$_POST['complain_id']."')")){
			$suc="User Inserted Successfully";
		}else{
			$fail="Faild to create New User";
		}

	}

	if(isset($_POST['updtuser'])){
		include '../db.php';
		$userid = $_POST['id'];
		if(mysql_query("UPDATE`ticket_dev`.`users` SET `user_name`='".$_POST['uname']."',`user_group_id`='".$_POST['gi']."', `previlege`='".$_POST['prev']."',`concern`='".$_POST['concern']."',`user_pass`='".$_POST['password']."',`complain_id`='".$_POST['complain_id']."' WHERE `id` ='".$userid."'")){
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
										<input type="text" class="form-control" id="designa" placeholder="Enter Euser Designation" name="designa">
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
										<input type="number" class="form-control" id="uphone" placeholder="EnterPhone Number" name="uphone">
									</div>
								</div>

								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">User ID:</div>
									<div class="col-sm-8" style="float: left;">
										<input type="text" class="form-control" id="uid" placeholder="Enter User ID / Email" name="uid" required="required">
									</div>
								</div>
								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">User Password :</div>
									<div class="col-sm-8" style="float: left;">
										<input type="password" class="form-control" id="upass" placeholder="Enter password" name="upass" required="required">
									</div>
								</div>

								<div class="col-md-12" style="float: left; padding: 10px;">
									<div class="col-sm-4" style="float: left;">User Privileges:</div>
									<div class="col-sm-8" style="float: left;">
										<select class="form-control" name="prev" id="prev" required>
											<option value="" selected disabled>Select A Privileges</option>
											<option value="0">Administrator</option>
											<option value="2">Group Admin</option>
											<option value="3">Report Update</option>
											<option value="4">Ticket Admin</option>
											<option value="5">Reject Admin</option>
										</select>
									</div>
								</div>


								<div class="col-md-12" style="float: left; padding: 10px;" id="dept_tab">
									<div class="col-sm-4 control-label" style="float: left;">Department:</div>
									<div class="col-sm-8" style="float: left;">
										<select class="form-control" id="group" name="gi" onchange="changeText4(this.value)">
											<option value="">Select A Group</option>
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
<!-- 									<div class="col-sm-4" style="float: left;">
				                      <input type="text" class="form-control" name="gi" readonly placeholder="Enter Other receiver" id="gi">
				                    </div> -->
								</div>

								<div class="col-md-12" style="float: left; padding: 10px;" id="service_tab">
									<div class="col-sm-4" style="float: left;">Service:</div>
									<div class="col-sm-4" style="float: left;">
										<select class="form-control type" id="type" name="concern" onchange="changeText3(this.value)">
											<option value="">Select A Ticket Type</option>
										</select>
									</div>
									<div class="col-sm-4" style="float: left;">
				                      <input type="text" class="form-control" name="concern" readonly placeholder="Enter Other receiver" id="cc">
				                    </div>
								</div>

								<div class="col-md-12" style="float: left; padding: 10px;" id="complaint_tab">
									<div class="col-sm-4" style="float: left;">Complaint Type:</div>
									<div class="col-sm-4" style="float: left;">
										<select class="form-control complaint_type" id="complaint_type" onchange="changeText5(this.value)">
											<option value="">Select A Complaint Type</option>
										</select>
									</div>
									<div class="col-sm-4" style="float: left;">
				                      <input type="text" class="form-control" name="complain_id" readonly placeholder="Enter Complaint Type" id="complain_id">
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
												<th scope="col">User ID</th>
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
				url: "../kullu/change_2.php",
				type: "GET",
				success: function(data){
					$(".type").html(data);
					$("#complain_id").val('');
					$("#cc").val('');
				}
			});                                
		});

		$('#type').change(function(e){
			var id = $("#group").val();
			var type_id = $("#type").val();

			$.ajax({
				data: "id="+id+"&type="+type_id,
				url: "../kullu/change_3.php",
				type: "GET",
				success: function(data){
					$(".complaint_type").html(data);
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

		function changeText3(str) {
          document.getElementById('cc').value = document.getElementById('cc').value + "," + document.getElementById('type').value;
      	}

      	function changeText4(str) {
          document.getElementById('gi').value = document.getElementById('gi').value + "," + document.getElementById('group').value;
      	}      	

      	function changeText5(str) {
          document.getElementById('complain_id').value = document.getElementById('complain_id').value + "," + document.getElementById('complaint_type').value;
      	}
	</script>

	<script>

    $(document).ready(function () {

        /* username validation */
        $('#uid').keyup(function () {
            let uid = $(this).val();

            if (uid !== '') {
                $.ajax({
                    data: "uid="+uid,
					url: "../kullu/user_id_check.php",
					type: "GET",
					success: function(data){
						if (data != '') {
							$("#uid").val("");
							alert("User Alreay In Database!!");
						}
					}
                });
            }
        });

        $("#service_tab").hide();
        $("#dept_tab").hide();
        $("#complaint_tab").hide();

        $("#prev").change(function(){ 

        	let prev = $("#prev").val();

        	if (prev == 3) {
        		$("#dept_tab").show();
        		$("#service_tab").show();
        		$("#gi").show();
        		$("#complaint_tab").show();

        		// $("#type").val('');
        		$("#cc").val('');
        		$("#gi").val('');
        		$("#complaint_type").val('');
        		// $("#group").val('');
        	} else if (prev == 2){
        		$("#dept_tab").show();
        		$("#service_tab").hide();
        		$("#complaint_tab").hide();
        		$("#gi").show();

        		// $("#type").val('');
        		$("#cc").val('');
        		$("#gi").val('');
        		$("#complaint_type").val('');
        		// $("#group").val('');
        	} else {
        		$("#dept_tab").hide();
        		$("#service_tab").hide();
        		$("#complaint_tab").hide();
        		$("#gi").hide();

        		// $("#type").val('');
        		$("#cc").val('');
        		$("#gi").val('');
        		$("#complaint_type").val('');
        		// $("#group").val('');
        	}
		 
		});


    });
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
}elseif ($_SESSION['previlege'] == 4) { ?>


<?php include 'header.php';?>
    <script type="text/javascript">

        function reportJAVA()
        {
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("scontent").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET","../admin/update/dash.php", true);
        xmlhttp.send();
        }

    </script>
    <style type="text/css">
        .my-card {
            position: absolute;
            left: 40%;
            top: -20px;
            border-radius: 50%;
        }
    </style>

</style>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12" id="scontent">
                        
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script type="text/javascript">
        $( document ).ready(function() {
            reportJAVA();
        });
    </script>

<script>
// Display an external page using an iframe
function smcollege(kuti)
{
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
var Y=50;
var src = "update/edittieket.php?q1="+kuti;
$.modal('<iframe src="' + src + '" height="480" width="830" style="border:0">', {
    closeHTML:"",
    appendTo: $(window.parent.document).find('body'),
    opacity:70,
    overlayCss: {backgroundColor:"#000"},
    containerCss:{
        backgroundColor:"#fff", 
        borderColor:"#000",
        borderRadius:15,
        height:510, 
        padding:0, 
        width:830
    },
    overlayClose:true,
    position: [Y,X],
    onOpen: function (dialog) {
    dialog.overlay.fadeIn('slow', function () {
        dialog.data.hide();
        dialog.container.fadeIn('slow', function () {
            dialog.data.slideDown('slow');   
        });
    });
},
onClose: function (dialog) {
    dialog.data.fadeOut('slow', function () {
        dialog.container.hide('fast', function () {
            dialog.overlay.slideUp('fast', function () {
                $.modal.close();
            });
        });
    });
}

});

$(window.parent.document).find('#simplemodal-overlay').css('width', '100%');
$(window.parent.document).find('#simplemodal-overlay').css('height', '100%');
}



function modify(id)
{
    var change_assign = $("#change_assign"+id).val();
    var change_status = $("#change_status"+id).val(); 

    $.ajax({
        data: "id="+id+"&change_assign="+change_assign+"&change_status="+change_status,
        url: "../kullu/changeAssign.php",
        type: "GET",
        success: function(res){
            if (res) {
                alert(res);
            }
        }
    });
}

</script>

<?php include 'footer.php';?>
<?php } elseif ($_SESSION['previlege'] == 5) { ?>

<?php include 'header.php';?>
    <script type="text/javascript">

        function reportJAVA()
        {
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("scontent").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET","../admin/update/dash.php", true);
        xmlhttp.send();
        }

    </script>
    <style type="text/css">
        .my-card {
            position: absolute;
            left: 40%;
            top: -20px;
            border-radius: 50%;
        }
    </style>

</style>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12" id="scontent">
                        
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script type="text/javascript">
        $( document ).ready(function() {
            reportJAVA();
        });
    </script>

<script>
// Display an external page using an iframe
function smcollege(kuti)
{

 
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
var Y=50;
var src = "update/edittieket.php?q1="+kuti;
$.modal('<iframe src="' + src + '" height="480" width="830" style="border:0">', {
    closeHTML:"",
    appendTo: $(window.parent.document).find('body'),
    opacity:70,
    overlayCss: {backgroundColor:"#000"},
    containerCss:{
        backgroundColor:"#fff", 
        borderColor:"#000",
        borderRadius:15,
        height:510, 
        padding:0, 
        width:830
    },
    overlayClose:true,
    position: [Y,X],
    onOpen: function (dialog) {
    dialog.overlay.fadeIn('slow', function () {
        dialog.data.hide();
        dialog.container.fadeIn('slow', function () {
            dialog.data.slideDown('slow');   
        });
    });
},
onClose: function (dialog) {
    dialog.data.fadeOut('slow', function () {
        dialog.container.hide('fast', function () {
            dialog.overlay.slideUp('fast', function () {
                $.modal.close();
            });
        });
    });
}

});

$(window.parent.document).find('#simplemodal-overlay').css('width', '100%');
$(window.parent.document).find('#simplemodal-overlay').css('height', '100%');
}



function modify(id)
{
    var change_assign = $("#change_assign"+id).val();
    var change_status = $("#change_status"+id).val(); 

    $.ajax({
        data: "id="+id+"&change_assign="+change_assign+"&change_status="+change_status,
        url: "../kullu/changeAssign.php",
        type: "GET",
        success: function(res){
            if (res) {
                alert(res);
            }
        }
    });
}

</script>

<?php include 'footer.php';?>

<?php } ?>