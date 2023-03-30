<?php
session_start();
include '../db.php';
include 'header.php';?>
<script src="../ck/ckeditor.js"></script>
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
            <div id="search">
              <form class="form-horizontal" id="form1" name="form1" method="post" action="">
                <div class="col-md-12" style="float: left;">
                  <div class="col-md-4" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Start Date:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input name="idate" type="date" class="form-control" id="idate" placeholder="Enter start date" value="<?php echo date("Y-m-d"); ?>" required="required">
                    </div>
                  </div>
                  <div class="col-md-4" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">End Date:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="date" class="form-control" id="edate" name="edate"placeholder="Enter end date" required="required" value="<?php echo date("Y-m-d"); ?>">
                    </div>
                  </div>

                  <div class="col-md-3" style="float: left; padding: 10px;">
                    <div class="col-sm-4 control-label" style="float: left;">Status:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select name="status" class="form-control" id="status" >
                        <option value="">-Select Status-</option>
                        <? include 'db.php';
                        $result1 = mysql_query("select *FROM ticket_status ");
                        while($row=mysql_fetch_array($result1)) { ?>
                          <option value="<?=$row['status_name']?>">
                            <?=$row['status_name']?>
                          </option>
                        <? } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-1" style="float: left; padding: 10px;">
                    <input type="submit" name="Submit" value="Search" class="btn btn-success">
                  </div>
                </div>


                <div class="col-md-12" style="float: left;">
                  <div class="col-md-4" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Column By:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select name="search" class="form-control" id="search">
                        <option>--Select field--</option>
                        <option value="id">Ticket ID</option>
                        <option value="cus_contact">Phone</option>
                        <option value="cus_ac">Account Number</option>
                        <option value="cus_amount">Card Number</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Value:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input name="value" type="text" class="form-control" id="value"/>
                    </div>
                  </div>
                  <div class="col-md-1" style="float: right; padding: 10px;">
                    <input type="submit" name="Submit2" value="Search" class="btn btn-success">
                  </div>
                </div>


                <div class="col-md-12" style="float: left;">
                  <div class="col-md-4" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Type:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select name="type" class="form-control" id="type" >
                        <option value="">-Select Type-</option>
                        <? include 'db.php';
                        $result11 = mysql_query("select *FROM ticket_type ");
                        while($row=mysql_fetch_array($result11)) { ?>
                          <option value="<?=$row['type_name']?>">
                            <?=$row['type_name']?>
                          </option>
                        <? } ?>
                      </select>
                    </div>
                  </div>
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

              $results1=mysql_query("SELECT * FROM ticket where status='$in' and date >= '".$_POST['idate']."' and date < '".$_POST['edate']."'");

              // SELECT * FROM `ticket` WHERE `date`>='2019-01-20' AND `date`<='2020-07-11' AND `status` ='new'

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>
              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>SLA (Hours)</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>SLA</th>
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
                  $res = "Time Over Not Solve"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solved')){
                  $res = "Time Over And Solve"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solved'){
                  $res = "Solve On Time"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "On Process"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }


                echo $tr;
                echo "<td >" . $row['id'] . "</td>";
                echo "<td >" . $row['date'] . "</td>";  
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>";
                echo "<td >" . $res . "</td>";
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";
              }
              echo "</table>";

            }
            if(isset($_POST['Submit0'])){ 
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['type']; 
              // print_r("Ok");
              // exit();

              // $results1=mysql_query("SELECT * FROM ticket where ticket_type='$in' and date >= '".$_POST['idate']."' and date < '".$_POST['edate']."'");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>SLA</th>
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
                  $res = "Time Over Not Solve"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solved')){
                  $res = "Time Over And Solve"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solved'){
                  $res = "Solve On Time"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "On Process"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }

                echo $tr;
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>"; 
                echo "<td >" . $calculation . "</td>";
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";
              }
              echo "</table>";

            }

            if(isset($_POST['Submit2'])){
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in2=$_POST['search'];
              $value=$_POST['value'];
              $results1=mysql_query("SELECT * FROM ticket where $in2 like '%$value%' ");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>SLA</th>
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
                  $res = "Time Over Not Solve"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solved')){
                  $res = "Time Over And Solve"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solved'){
                  $res = "Solve On Time"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "On Process"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }


                echo $tr;
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>";
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

              $results1=mysql_query("SELECT * FROM ticket  where  date >= '".$_POST['idate']."' and date < '".$_POST['edate']."'");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>SLA</th>
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
                  $res = "Time Over Not Solve"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solved')){
                  $res = "Time Over And Solve"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solved'){
                  $res = "Solve On Time"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "On Process"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }

                echo $tr;
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>"; 
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
<script src="../js/new.js"></script>
<?php include 'footer.php';?>