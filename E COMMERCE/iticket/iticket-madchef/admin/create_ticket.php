
<?php
session_start();
include '../db.php';
include 'header.php';?>
<script src="../ck/ckeditor.js"></script>
<?php

if (isset($_POST['create_ticket'])) {
	$from        = $_SESSION['usr01937417227'];
	$group       = $_POST['group'];
	$type        = $_POST['type'];
	$to          = $_POST['to'];
	$sub_group   = $_POST['sub_group'];
	$account_id  = $_POST['account_id'];
	$cus_phone   = $_POST['cus_phone'];
	$amount      = $_POST['amount'];
	$product     = $_POST['product'];
	$cclist      = $_POST['cclist'];
	$cc          = $_POST['cc'];
	$templete    = $_POST['templete'];
	$cus_name    = $_POST['cus_name'];
	$editor1     = $_POST['editor1'];
	$date = date("d-m-Y");
  $t = time();
  $stamp = $t + $date;
	$attachment  = $_FILES['attachment'];
	$attach_name = $_FILES['attachment']['name'];
  $attach_tmp  = $_FILES['attachment']['tmp_name'];
  $attach_type = $_FILES['attachment']['type'];
	move_uploaded_file($attach_tmp,"attcahment/$attach_name");
	$superiors=mysql_query("SELECT superior_id from users where id=" . $_POST['to']);
	$data = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$_POST['type']."'"));

	$affetcted=mysql_query("INSERT INTO `ticket_dev`.`ticket`(`ticket_type`, `from`, `assignd`, `group`, `sub_group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`, `hour_time`,`stat`,`attachment`) VALUES ('".$type."','".$from."','".$to."','".$group."','".$sub_group."','".$cus_phone."','".$cus_name."','".$account_id."','".$product."','".$amount."','NEW','".$editor1."',NOW(),'".$stamp."','1','".$superiors."','".$data['hour_time']."','".$cc."','".$attach_name."')");

	if ($affetcted) {
		?>
		<div class="btn-warning text-center" style="font-size: 24px; font-family: serif;">
			<?php 
				echo "Ticket Created Successfully..";
				echo "<script>setTimeout(function () {           window.location.replace('http://103.106.236.36:8081/iticket/admin/create_ticket.php')}, 3000);</script>";
			?>
		</div>
		<?php
	}else{
		echo mysql_error($connect);
	}
}
?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#tcontent").load("ticket_generation.php").fadeIn("slow");
    $.ajaxSetup({ cache: false });
  });
</script>
<main class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="col-md-2 text-center" style="float: left;">
              <button class="btn btn-warning" id="crt_btn" onclick="location.href='create_ticket.php'"><i class="fas fa-plus-square"></i> Create Ticket</button>
            </div>
            <div class="col-md-2 text-center" style="float: right;">
              <button class="btn btn-success text-white">
                New Ticket <span class="badge"><?php
                include 'db.php';
                mysql_query("SET CHARACTER SET utf8");
                mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
                $results9=mysql_query("SELECT COUNT(status) FROM  `ticket` WHERE  `status` =  'New'");
                $count = mysql_fetch_array($results9);
                echo $count[0];
                ?></span>
              </button>
            </div>
            <div class="col-md-2 text-center" style="float: right;">
              <button class="btn btn-info" id="src_btn" onclick="location.href='search_ticket.php'"><i class="fas fa-eye"></i> Search ticket</button>
            </div>
            
          </div>
          <div class="card-body">
            <div id="create">
              <div class="col-md-12">
                <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4 control-label" style="float: left;">Department:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="group" id="group">
                        <option>Select Department</option>
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
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Service:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="type" id="type">
                        <option>-Select Service-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Assigned To:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="to" id="to">
                        <option>-Select A Reciever-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Issue:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="sub_group" id="sub_group">
                        <option>-Select an issue-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Order:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="number" class="form-control" id="account_id" placeholder="Enter order Number" name="account_id" value="<?php print $acc_no; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Customer Phone:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input name="cus_phone" type="number" class="form-control" id="cus_phone" placeholder="Enter Customer phone Number" value="<?php print $phone; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Title:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" id="amount" name="amount"placeholder="Enter Title" value="<?php print $address_tra; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Email Address:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="email" class="form-control" name="product" placeholder="Enter email" id="product" value="<?php print $product_tra; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Add more reciever:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="cclist" id="cclist" onchange="changeText3(this.value)"> 
                        <option value="NO">-Select Reciever-</option>
                        <?php
                        $sql = mysql_query("SELECT * FROM `users` WHERE `previlege`!='0' AND `previlege`!='2'");
                        while ($row = mysql_fetch_row($sql)) {
                          ?>
                          <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Other reciever:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" name="cc" placeholder="Enter Other receiver email" id="cc">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Message:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="templete" id="templete" onchange="changeText2(this.value)">
                        <option>-Select Message-</option>
                        <?php
                        $result1 = mysql_query("select * FROM template ORDER BY title ASC");
                        while ($row = mysql_fetch_array($result1)) {
                          ?>
                          <option value="<?= $row[0] ?>">
                            <?= $row[1] ?>
                          </option>
                        <? } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Customer Name:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" name="cus_name" id="cus_name" placeholder="Enter Customer Name" value="<?php print $customer_name; ?>">
                    </div>
                  </div>
                  <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">Attachment:</div>
                    <div class="col-sm-10" style="float: left;">
                      <input class="form-control" type="file" name="attachment" id="attachment">
                    </div>
                  </div>
                  <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">Tamplates:</div>
                    <div class="col-sm-10" style="float: left;" id="kullu">
                      <textarea class="form-control" id="editor1" name="editor1" style="color: black; " rows="4" required><?php print $detail_tra; ?></textarea>
                      <script>
                        CKEDITOR.replace('editor1');
                        CKEDITOR.config.height = 90;
                      </script>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left; visibility: hidden;">Button</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="submit" name="create_ticket" value="Create" class="btn btn-success">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>


        <div class="card">
          <div class="card-header">Ticket</div>
          <div class="card-body">
            <table class="table table-bordered" id="tcontent" style="font-size: 12px;"></table>
          </div>
        </div>


      </div>
    </div>
  </div>
</main>
<script src="../js/new.js"></script>
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

      function changeText3(str) {
          document.getElementById('cc').value = document.getElementById('cc').value + "," + document.getElementById('cclist').value;
      }

      function changeText2(str) {
    
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else
        {// code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function ()
        {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
            {
                document.getElementById('kullu').innerHTML = "<textarea class=\"form-control\" id=\"editor1\" name=\"editor1\" rows=\"4\" required>" + xmlhttp.responseText + "</textarea>";
                CKEDITOR.replace('editor1');
                CKEDITOR.config.height = 90;
            }
        }
        xmlhttp.open("GET", "../kullu/tem.php?q=" + str, true);
        xmlhttp.send();
    }
</script>
<?php include 'footer.php';?>