<?php
session_start();
include 'db.php';
// include 'header.php';?>
<link href="css-new/app.css" rel="stylesheet">
<script src="ck/ckeditor.js"></script>
<main class="py-4">
  <div class="">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" style="margin-top: -28px;">
          <div class="card-header">
            <div class="col-md-2 text-center" style="float: left;">
              <button class="btn btn-warning btn-sm" id="crt_btn" onclick="location.href='create.php'"><i class="fas fa-plus-square"></i> Create Ticket</button>
            </div>
            <div class="col-md-2 text-center" style="float: right;">
              <button class="btn btn-success btn-sm text-white" style="width: 130px;">
                <span>New Ticket - <?php
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
              <button class="btn btn-info btn-sm" id="src_btn" onclick="location.href='search_ticket.php'"><i class="fas fa-eye"></i> Search ticket</button>
            </div>
          </div>
                    <div class="card-body">
            <div id="search">
              <form class="form-horizontal" id="form1" name="form1" method="post" action="">
                <div class="col-md-12" style="float: left;">
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Start Date:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input name="idate" type="date" class="form-control" id="idate" placeholder="Enter start date" value="<?php echo date("Y-m-d"); ?>" required="required">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">End Date:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="date" class="form-control" id="edate" name="edate"placeholder="Enter end date" required="required" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                  </div>
                </div>


                <div class="col-md-12" style="float: left;">
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Search By:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select name="search" class="form-control" id="category">
                        <option value="">--Select field--</option>
                        <option value="id">Ticket ID</option>
                        <option value="cus_name">Customer Name</option>
                        <option value="cus_contact">Phone</option>
                        <option value="cus_ac">Account No</option>
                        <option value="cus_amount">Card No</option>
                        <option value="assignd">Employee</option>
                        <option value="status">Status</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Value:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input name="value" type="text" class="form-control" id="value" onblur="myFunction(this)"/>

                      <select name="assignd" class="form-control" id="agent">
                        <option value="">--Select Employee Name--</option>
                        <?php
                        $agent_sql = mysql_query("SELECT * FROM `users` ORDER BY `user_name` ASC");
                        while($agent = mysql_fetch_assoc($agent_sql)){
                        ?>
                        <option value="<?php echo $agent['id']; ?>"><?php echo $agent['user_name']; ?></option>
                        <?php } ?>
                      </select>

                      <select name="status" class="form-control" id="status">
                        <option value="">--Select Status--</option>
                        <?php
                        $status_sql = mysql_query("SELECT * FROM `ticket_status` ORDER BY `status_name` ASC");
                        while($status = mysql_fetch_assoc($status_sql)){
                        ?>
                        <option value="<?php echo $status['status_name']; ?>"><?php echo $status['status_name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                </div>


                <div class="col-md-12" style="float: left;">
                  <div class="col-md-1" style="float: right; padding: 10px;">
                    <input type="submit" name="Submit3" value="Search" class="btn btn-success">
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header">Ticket</div>
          <div class="card-body">
            <?php
            if(isset($_POST['Submit'])){
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['status'];
              

              $results1 = mysql_query("SELECT * FROM `ticket_dev`.`ticket` where status = '$in' and date >= '".$_POST['idate']." 00:00:01' and date <= '".$_POST['edate']." 23:59:59'");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>
              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Service</th>
              <th align='center'>SLA Status</th>
              <!-- <th align='center'>Email</th>  --> 
              <th align='center'>Check</th>
              <th align='center'>SMS</th> 
              </tr>";


              while($row = mysql_fetch_array($results1)){

                $create = strtotime($row['date']);
                $today = strtotime(date('Y-m-d H:i:s'));
                $calculation = $today - $create;

                $exit = $row['hour_time'];

                if (($calculation > $exit) && ($row['status'] != 'Solved')) { 
                  $res = "Not Resolved Within SLA"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solved')){
                  $res = "Resolved  & SLA Not Met"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solved'){
                  $res = "Solved within SLA"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "Not Resolved & SLA Not Met"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }
                $type=mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$row['ticket_type']."'"));


                echo $tr;
                echo "<td >" . $row['id'] . "</td>";
                echo "<td >" . $row['date'] . "</td>";  
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $type[1] . "</td>";
                echo "<td >" . $res . "</td>";
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";
              }
              echo "</table>";

            }
            if(isset($_POST['Submit3'])){
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $search = $_POST['search']; 
              $value = $_POST['value'];
              $qry = "";

              if (!empty($_POST['value'])) {
                 $value = $_POST['value'];
               } elseif (!empty($_POST['assignd'])) {
                 $value = $_POST['assignd'];
               } elseif (!empty($_POST['status'])) {
                 $value = $_POST['status'];
               }

              if ($search == 'cus_amount') {
                  $search = "SUBSTRING(".$search.", -6 )";
              }


              if (!empty($search)) {
                
                $results1=mysql_query("SELECT * FROM `ticket_dev`.`ticket` where ".$search." ='".$value."' ORDER BY `id` DESC");
              } else if(empty($search) && empty($value)) {
                $results1=mysql_query("SELECT * FROM `ticket_dev`.`ticket` where date >= '".$_POST['idate']." 00:00:01' and date <= '".$_POST['edate']." 23:59:59' ORDER BY `id` DESC");
              } else {

                $results1=mysql_query("SELECT * FROM `ticket_dev`.`ticket` where ".$search." ='".$value."' AND date >= '".$_POST['idate']." 00:00:01' AND date <= '".$_POST['edate']." 23:59:59' ORDER BY `id` DESC");
                
              }
            

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Service</th>
              <th align='center'>SLA Status</th>
              <!-- <th align='center'>Email</th>  -->
              <th align='center'>Check</th>
              <th align='center'>SMS</th>
              </tr>";


              while($row = mysql_fetch_array($results1)){

                $create = strtotime($row['date']);
                $today = strtotime(date('Y-m-d H:i:s'));
                $calculation = $today - $create;

                $exit = $row['hour_time'];

                if (($calculation > $exit) && ($row['status'] != 'Solved')) { 
                  $res = "Not Resolved Within SLA"; 
                  $tr  = "<tr>";
                  // style=\"background-color: #F9245E;\"
                } else if(($calculation > $exit) && ($row['status'] == 'Solved')){
                  $res = "Resolved  & SLA Not Met"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solved'){
                  $res = "Solved within SLA"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "Not Resolved & SLA Not Met"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }

                $type=mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$row['ticket_type']."'"));

                echo $tr;
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $type[1] . "</td>"; 
                echo "<td >" . $res . "</td>";
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' " style="color: black;">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\" style=\"color: black;\">Send</a>" . "</td>";
              }
              echo "</table>";

            }

            if(isset($_POST['Submit2'])){
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in2=$_POST['search'];
              $value=$_POST['value'];
              $results1=mysql_query("SELECT * FROM `ticket_dev`.`ticket` where $in2 like '%$value%' ");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Service</th>
              <th align='center'>SLA Status</th>
              <!-- <th align='center'>Email</th>  --> 
              <th align='center'>Check</th>
              <th align='center'>SMS</th>
              </tr>";


              while($row = mysql_fetch_array($results1)){

                $create = strtotime($row['date']);
                $today = strtotime(date('Y-m-d H:i:s'));
                $calculation = $today - $create;

                $exit = $row['hour_time'];

                if (($calculation > $exit) && ($row['status'] != 'Solved')) { 
                  $res = "Not Resolved Within SLA"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solved')){
                  $res = "Resolved  & SLA Not Met"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solved'){
                  $res = "Solved within SLA"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "Not Resolved & SLA Not Met"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }

                $type=mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$row['ticket_type']."'"));

                echo $tr;
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $type[1] . "</td>";
                echo "<td >" . $res . "</td>";
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";
              }
              echo "</table>";

            }

            if(isset($_POST['all']))
            {
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['type'];

              $results1=mysql_query("SELECT * FROM `ticket_dev`.`ticket` where  date >= '".$_POST['idate']."' and date < '".$_POST['edate']."'");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Service</th>
              <th align='center'>SLA Status</th>
              <!-- <th align='center'>Email</th>  --> 
              <th align='center'>Check</th>
              <th align='center'>SMS</th>
              </tr>";


              while($row = mysql_fetch_array($results1)){

                $create = strtotime($row['date']);
                $today = strtotime(date('Y-m-d H:i:s'));
                $calculation = $today - $create;

                $exit = $row['hour_time'];

                if (($calculation > $exit) && ($row['status'] != 'Solved')) { 
                  $res = "Not Resolved Within SLA"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solved')){
                  $res = "Resolved  & SLA Not Met"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solved'){
                  $res = "Solved within SLA"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "Not Resolved & SLA Not Met"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }

                $type=mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$row['ticket_type']."'"));

                echo $tr;
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $type[1] . "</td>"; 
                echo "<td >" . $res . "</td>";
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&ticket_id=".$row['id']."\">Send</a>" . "</td>";
              }
              echo "</table>";
            }
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script src="js/new.js"></script>

<script type="text/javascript">
  $( document ).ready(function() {
     $("#value").show();
     $("#agent").hide();
     $("#status").hide();

    $('#category').change(function(e){

      var search = $(this).val();

      if (search == "assignd") {
         $("#value").hide();
         $("#agent").show();
         $("#status").hide();
      } else if(search == "status"){
         $("#value").hide();
         $("#agent").hide();
         $("#status").show();
      } else {
         $("#value").show();
         $("#agent").hide();
         $("#status").hide();
      }
    });
  });

  function myFunction()
  {
    var value = $("#value").val();
    var category = $("#category").val();
    if ((category == "cus_amount") && (value.length == 6)) {
      
    } else if((category == "cus_amount") && (value.length != 6)){
      alert("Card Number Must Be 6 Digits!!");
      $("#value").val("");
    }
  }
</script>
<?php include 'footer.php';?>