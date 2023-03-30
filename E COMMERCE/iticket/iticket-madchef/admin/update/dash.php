
<!-- <script type='text/javascript' src='./js/jquery.js'></script> -->
<link type='text/css' href=' https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js'></script>
<?php

include '../../db.php';
session_start();
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci");
$start = date('Y-m-d') . " 00:00:01";
$end = date('Y-m-d') . " 23:59:59";


if ($_SESSION['previlege'] == 3) {


  $sql = mysql_query("SELECT * FROM ticket WHERE  `date` >= '".$start."' AND `date` <= '".$end."' AND `group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."'  ORDER BY `id` DESC LIMIT 20");

  $time = "00:30:00";

  $sla_time =mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'time' FROM `ticket`.`ticket` WHERE (`status`='New' AND `branch_name`='".$_SESSION['branch']."' AND `group`='".$_SESSION['brand']."'AND `date`<NOW())"));

// $count = '';
// if(strtotime($sla['time']) + strtotime($time))


  $count = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'count' FROM `ticket`.`ticket` WHERE (`assignd`='".$_SESSION['id']."' OR `superiors` LIKE '%".$_SESSION['id']."%') AND `status` = 'New' AND `sla_8` < '".date("Y-m-d H:i:s")."'"));


  $total = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'total' FROM `ticket`.`ticket` WHERE (`group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."'  AND `date` >= '".$start."' AND `date` <= '".$end."')"));

  $open = mysql_num_rows(mysql_query("SELECT * FROM `ticket`.`ticket` WHERE (`group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."') AND `status`='Received' AND `date` >= '".$start."' AND `date` <= '".$end."' "));

  $solved = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'solved' FROM `ticket`.`ticket` WHERE (`group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."') AND (`status`='Completed') AND `date` >= '".$start."' AND `date` <= '".$end."'  "));

  $pending = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'pending' FROM `ticket`.`ticket` WHERE (`group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."') AND (  `status`='Cooking') AND `date` >= '".$start."' AND `date` <= '".$end."' "));

  $transfer = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'transfer' FROM `ticket`.`ticket` WHERE (`group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."') AND `status`='Transferred' AND `date` >= '".$start."' AND `date` <= '".$end."' "));

  $reject = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'reject' FROM `ticket`.`ticket` WHERE (`group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."') AND `status`='Cancelled' AND `date` >= '".$start."' AND `date` <= '".$end."' "));


  $shipped = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'shipped' FROM `ticket`.`ticket` WHERE (`group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."') AND `status`='Shipped' AND `date` >= '".$start."' AND `date` <= '".$end."' "));

  $pending_1 = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'pending' FROM `ticket`.`ticket` WHERE (`group`='".$_SESSION['brand']."' AND `branch_name`='".$_SESSION['branch']."') AND `status`='Pending' AND `date` >= '".$start."' AND `date` <= '".$end."' "));




}
else {
  $results = mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', `ticket`.`assignd` as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name', `cus_product` as 'Product Details', `date` as 'Create Date', `hour_time` as 'SLA', `status` AS 'Status' , `stat` AS 'STAT', `assignd` AS 'ASS_ID', `sub_group` AS 'ISSUE', `priority` AS 'PRIORITY', `group` AS 'GROUP', `details` AS 'details' FROM `ticket`.`ticket` WHERE `status` = 'Solved' OR `status` = 'Re-solved' ORDER BY `ticket`.`id` DESC LIMIT 10");

  $results1 = mysql_query("SELECT * FROM `ticket`.`ticket` WHERE `status` = 'Solved' OR `status` = 'Re-solved'");

  $num_rows = mysql_num_rows($results);

  $total = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'total' FROM `ticket`.`ticket` WHERE `status` = 'Solved'"));
  $closed = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 'closed' FROM `ticket_dev`.`ticket` WHERE `status` = 'Closed'"));
  $open = mysql_num_rows(mysql_query("SELECT * FROM `ticket`.`ticket` WHERE `status`='Solved' OR `status`='Re-solved'"));
  $re_route = mysql_num_rows(mysql_query("SELECT * FROM `ticket`.`ticket` WHERE `status`='Re-route'"));
  $t_closed = mysql_fetch_assoc(mysql_query("SELECT count(*) AS 't_closed' FROM `ticket`.`ticket` WHERE `status`='Closed' AND `update_at` >= '".$start."' AND `update_at` <= '".$end."'"));
  $count = '';
  while ($row = mysql_fetch_assoc($results1)) {
    $create = strtotime($row['date']);
    $today = strtotime(date('Y-m-d H:i:s'));
    $calculation = $today - $create;
    $exit = $row['hour_time'];
    $tat = number_format((($calculation/60)/60), 2, '.', '');

    if (($calculation > $exit) && ($row['status'] != 'Closed')) {
     $count = $count + 1;
   }
 }
}

?>
<style type="text/css">
  .span{
   float: left;
   margin-top: 33px;
   margin-left: 13px;
   font-size: 26px;
   font-weight: bold;
 }

 .h4{
  margin-top: 40px;
  margin-left: -2px;
  float: left;
  font-weight: bold;
  font-size: 20px;
}
</style>
<div class="card-body" style="width: 100%;margin: 0;padding: 0;">
  <div class="row w-100" style="margin-top: -13px; height: 291px; margin-left: 47px;">
    <?php  if($_SESSION['previlege'] == 3){?>
      <div class="col-md-3" style="background-image: url('../admin/update/img/image/total.png'); background-repeat: no-repeat; background-size: 65% 75%;color: white;">
        <div class="text-center mt-3"><h4 class="h4">Total Order </h4><span class="span"><?php echo $total['total']; ?></span></div>
      </div>
      <div class="col-md-3" style="background-image: url('../admin/update/img/image/new.png'); background-repeat: no-repeat; background-size: 65% 75%; color: black;">
        <div class="text-center mt-2"><h4 class="h4">Received  </h4><span class="span"><?php echo $open; ?></span></div>
      </div>

      <div class="col-md-3" style="background-image: url('../admin/update/img/Resolution_SLA_failed.png'); background-repeat: no-repeat; background-size: 65% 75%; color: black;">
        <div class="text-center mt-3"><h4 class="h4" style="font-size: 20px; margin-top: 41px;">Pending </h4><span class="span" style="margin-left: 15px;margin-top: 34px;"><?php echo $pending_1['pending']; ?></span></div>
      </div>


      <div class="col-md-3" style="background-image: url('../admin/update/img/image/cooking.png'); background-repeat: no-repeat; background-size: 65% 75%;color: black;">
        <div class="text-center mt-3"><h4 class="h4" style="margin-top: 38px;">Cooking  </h4><span class="span" style="margin-left: 19px;"><?php echo $pending['pending']; ?></span></div>
      </div>

      <div class="col-md-3" style="background-image: url('../admin/update/img/image/shipped.png'); background-repeat: no-repeat; background-size: 65% 75%; color: black;">
        <div class="text-center mt-3"><h4 class="h4" style="font-size: 20px; margin-top: 41px;"> Shipped  </h4><span class="span" style="margin-left: 15px;margin-top: 34px;"><?php echo $shipped['shipped']; ?></span></div>
      </div>


      <div class="col-md-3" style="background-image: url('../admin/update/img/image/completed.png'); background-repeat: no-repeat; background-size: 65% 75%;color: black;">
        <div class="text-center mt-3"><h4 class="h4">Completed  </h4><span class="span" style="margin-left: 15px;"><?php echo $solved['solved']; ?></span></div>
      </div>




      <div class="col-md-3" style="background-image: url('../admin/update/img/image/cancel.png'); background-repeat: no-repeat; background-size: 65% 75%; color: black;">
        <div class="text-center mt-3"><h4 class="h4">Cancelled</h4><span class="span" style="margin-left: 24px;"><?php echo $reject['reject']; ?></span></div>
      </div>



     <!--  <div class="col-md-3" style="background-image: url('../admin/update/img/sla_failed.png'); background-repeat: no-repeat; background-size: 65% 75%; color: white;">
        <div class="text-center mt-3"><h4 class="h4">SLA Expired </h4><span class="span" style="margin-left: 20px;"><?php echo '0' ; ?></span></div>
      </div> -->



    <?php }  ?>

  </div>

  <div align="center" style="margin-top: 10px;">
    <div class="card">
      <div class="card-header">Ticket</div>

      <div class="card-body">


        <table class="table table-bordered" id="content" style="font-size: 12px;">
          <thead align="center">
            <tr>
              <th>ID</th>
              <th>Order ID</th>
              <th>Initiator</th>
              <th>Customer Contact Number</th>
              <th>Name</th>
              <th>Address</th>
              <th>Notes</th>
              <th>Status</th>
              <th>Create Date</th>
              <th>Invoice</th>
<!--               <th>Update Ticket</th>
 -->            </tr>
          </thead>
          <tbody align="center">
            <?php
            $i = 1;
            while($ticket = mysql_fetch_assoc($sql)){?>

              <tr>
                <td> <?php echo $ticket['id']; ?></td>
                <td> <?php echo $ticket['order_id']; ?></td>
                <td> <?php echo $ticket['agent']; ?></td>
                <td> <?php echo $ticket['cus_contact']; ?></td>
                <td> <?php echo $ticket['cus_name']; ?></td>
                <td> <?php echo $ticket['superiors']; ?></td>
                <td> <?php echo $ticket['note']; ?></td>
                
                <!-- <td><?php echo  $ticket['status']; ?></td> -->
                <td>
                  <select class="form-control" style="height: 32px; width: 160px;" <?php echo $disabled;?> id="change_status<?php echo $ticket['id'];?>" onchange="modify('<?php echo $ticket['id'];?>')">
                    <option selected ><?php echo $ticket['status']; ?></option>
                    <?php
                    if ($_SESSION['previlege'] == 3) {
                      $ticket_status = mysql_query("SELECT * FROM `ticket`.`ticket_status` ORDER BY `status_name` ASC");
                    } else {
                      $ticket_status = mysql_query("SELECT * FROM `ticket`.`ticket_status` ORDER BY `status_name` ASC");
                    }
                    while ($status_row = mysql_fetch_assoc($ticket_status)) {
                      if (($_SESSION['previlege'] != 3) && ($_SESSION['previlege'] != 3)) {
                        $status_disabled = "";
                        if ($status_row['status_name'] == "Closed") {$status_disabled = "disabled";}
                        if ($status_row['status_name'] == "Extended") {$status_disabled = "disabled";}
                        if ($status_row['status_name'] == "Re-route") {$status_disabled = "disabled";}
                      }
                      ?>

                      <option
                      <?php
                      if ($status_row['status_name'] == $ticket['status']) {
                        echo "selected";
                      }
                      echo $status_disabled;?>
                      value="<?php echo $status_row['status_name'];?>"><?php echo $status_row['status_name'];?></option>
                      <?php

                    }?>
                  </select>
                </td>
                <td> <?php echo $ticket['date']; ?></td>
                <td>
                  <?php
                  if($ticket['order_id'] != ''){?>
                    <a target="_blank" href="create_pdf/invoice.php?id=<?php echo $ticket['id'] ?>">
                    Print Invoice</a>
                    <?php
                  }
                  ?>                  
                </td>
             <!--    <td>
                 <button type="button" onclick="update('<?php echo $ticket['id'];?>','<?php echo $ticket['order_id'];?>' );" class="btn btn-success editbtn" style="float: left;"> Edit </button>
               </td> -->

             </tr>
             <?php
           }
           ?>
         </tbody>
       </table>
       <!--TICKET UPDATE MODAL START-->
       <div class="modal fade"  id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true"></div>
       <div class="modal fade"  id="invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
       aria-hidden="true"></div>
       <!-- MODAL END -->
     </div>
   </div>
 </div>
</div>
</div>
<!-- <script>
  $(document).ready(function() {
    $('#content').DataTable({order:[]});
  } );
</script> -->
