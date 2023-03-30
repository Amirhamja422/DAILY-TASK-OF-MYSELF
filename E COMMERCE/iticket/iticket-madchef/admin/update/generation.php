<?php
include '../../db.php';
include '../../function.php';
session_start();
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$q1 = $_GET['q1'];
$q2 = $_GET['q2'];
$q3 = $_GET['q3'];
$q4 = $_GET['q4'];
$skw = $_GET['skw'];
$sub = $_GET['sub'];
$dept = $_GET['dept'];

$key = '';
if (!empty($q4)) {
    $key = $q4;
} elseif (!empty($skw)) {
    $key = $skw;
} elseif (!empty($sub)) {
    $key = $sub;
} elseif (!empty($dept)) {
    $key = $dept;
}
  
  $user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$_SESSION['id']."'"));

  if ($q3 == 'cus_amount') {
    $q3_query = "SUBSTRING(".$q3.", -4 ) = ".$key." AND";
  } else {
    $q3_query = "`".$q3."` like '%".$key."%' AND";
  }

  if ($_SESSION['previlege'] == 4) {
    $results=mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', `assignd` as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name',  `cus_product` as 'Product Details', `date` as 'Create Date', `hour_time` as 'SLA', `status` AS 'Status', `stat` AS 'STAT', `assignd` AS 'ASS_ID', `sub_group` AS 'ISSUE', `priority` AS 'PRIORITY',`group` AS 'GROUP', `total_sla` AS 'total_sla' FROM `ticket_dev`.`ticket` WHERE (`status` = 'Solved' OR `status` = 'Closed') AND ".$q3_query." date >='".$q1." 00:00:00'  AND date <='".$q2." 23:59:59' ORDER BY `ticket`.`id` DESC");
  } else if($_SESSION['previlege'] == 2){
    $results=mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', `assignd` as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name',  `cus_product` as 'Product Details', `date` as 'Create Date', `hour_time` as 'SLA', `status` AS 'Status', `stat` AS 'STAT', `assignd` AS 'ASS_ID', `sub_group` AS 'ISSUE', `priority` AS 'PRIORITY',`group` AS 'GROUP', `total_sla` AS 'total_sla' FROM `ticket_dev`.`ticket` WHERE ".$q3_query." date >='".$q1." 00:00:00'  AND date <='".$q2." 23:59:59' AND `group` IN (".ltrim($user['user_group_id'], ',').") ORDER BY `ticket`.`id` DESC");
  } else if($_SESSION['previlege'] == 5){
    $results=mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', `assignd` as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name',  `cus_product` as 'Product Details', `date` as 'Create Date', `hour_time` as 'SLA', `status` AS 'Status', `stat` AS 'STAT', `assignd` AS 'ASS_ID', `sub_group` AS 'ISSUE', `priority` AS 'PRIORITY',`group` AS 'GROUP', `total_sla` AS 'total_sla' FROM `ticket_dev`.`ticket` WHERE `status` = 'Reject' AND ".$q3_query." date >='".$q1." 00:00:00'  AND date <='".$q2." 23:59:59' ORDER BY `ticket`.`id` DESC");
  } else {
    $results=mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', `assignd` as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name',  `cus_product` as 'Product Details', `date` as 'Create Date', `hour_time` as 'SLA', `status` AS 'Status', `stat` AS 'STAT', `assignd` AS 'ASS_ID', `sub_group` AS 'ISSUE', `priority` AS 'PRIORITY',`group` AS 'GROUP', `total_sla` AS 'total_sla' FROM `ticket_dev`.`ticket` WHERE ".$q3_query." date >='".$q1." 00:00:00'  AND date <='".$q2." 23:59:59' ORDER BY `ticket`.`id` DESC");
  }

$num_rows = mysql_num_rows($results);
?>
<div align="center" class="datagrid" style="width:99%; height:auto; overflow:auto;">
  <table class="anlepore">
    <thead align="center">
      <tr>
        <th>ID</th>
        <th>SERVICE</th>
        <th>COMPLAIN TYPE</th>
        <th>Initiator</th>
        <th>Assigned To</th>
        <th>Customer Contact Number</th>
        <th>Status</th>
        <th>Create Date</th>
        <th>SLA End</th>
        <th>SLA Status</th>
        <th title="UPDATE">
          <img src="update/update.png" width="20" height="20">
        </th>
      </tr>
    </thead>
    <tbody align="center">
      <?php
      $i=0;
      $opt = ' ';
      $assignd = '';
      $status = '';

      while($data_array=mysql_fetch_row($results)){

        $assignd = $data_array[3];
        $status = $data_array[9];
        $history_last = mysql_fetch_assoc(mysql_query("SELECT * FROM `history` WHERE `id`='".$data_array[0]."' AND `status`='Solved' ORDER BY `date` DESC LIMIT 1"));
        $history_first = mysql_fetch_assoc(mysql_query("SELECT * FROM `history` WHERE `id`='".$data_array[0]."' ORDER BY `date` ASC LIMIT 1"));
        $history_count = mysql_num_rows(mysql_query("SELECT * FROM `history` WHERE `id`='".$data_array[0]."'"));

        $today = date('Y-m-d H:i:s');
        $exit = $data_array[15];
        $last_closed = $history_last['date'];

        if (($today > $exit) && ($status != 'Solved')) {  
          $res = "Not Resolved & SLA Expired"; 
          $tr  = "<tr style=\"background-color: #EC981F;\">";
          $tr2  = "<tr class=\"altav\" style=\"background-color: #EC981F;\">";
        } else if (($last_closed > $exit) && ($status == 'Solved')) {
          $res = "Resolved After SLA Expired"; 
          $tr  = "<tr style=\"background-color: #789CFA;\">";
          $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
        } else if(($last_closed < $exit) && ($status == 'Solved')) {
          $res = "Solved within SLA"; 
          $tr  = "<tr style=\"background-color: #789CFA;\">";
          $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
        } else if(($today < $exit) && ($status != 'Solved')) { 
          $res = "Not Resolved & SLA Not Expired"; 
          $tr  = "<tr>";
          $tr2  = "<tr class=\"altav\">";
        }

        // if (($today > $exit) && ($status != 'Solved')) { 
        //   $res = "Not Resolved Within SLA"; 
        //   $tr  = "<tr style=\"background-color: #EC981F;\">";
        //   $tr2  = "<tr class=\"altav\" style=\"background-color: #EC981F;\">";
        // } else if(($calculation > $exit) && ($data_array[9] == 'Solved')) {
        //   $res = "Resolved  & SLA Not Met"; 
        //   $tr  = "<tr style=\"background-color: #789CFA;\">";
        //   $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
        // } else if($data_array[9] == 'Solved') {
        //   $res = "Solved within SLA"; 
        //   $tr  = "<tr style=\"background-color: #789CFA;\">";
        //   $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
        // } else if($data_array[9] == 'Closed') {
        //   $res = "Closed within SLA"; 
        //   $tr  = "<tr style=\"background-color: #789CFA;\">";
        //   $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
        // }
        // else { 
        //   $res = "Not Resolved & SLA Not Met"; 
        //   $tr  = "<tr>";
        //   $tr2  = "<tr class=\"altav\">";
        // }


        if ($data_array[13] == 1) {
            $priority = "General";
        } elseif ($data_array[13] == 2) {
            $priority = "Sensitive";
        } elseif ($data_array[13] == 3) {
            $priority = "Highly Sensitive";
        }

        $disabled = "";
        if ($status == "Closed") {
            $disabled = "disabled";
        }

        // $opt2 = $data_array[3];

        $type=mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$data_array[1]."'"));
        $issue=mysql_fetch_row(mysql_query("SELECT * FROM `sub_group` WHERE `id`='".$data_array[12]."'"));
      ?>
          <tr>
           <td><?php echo $data_array[0];?></td>
           <td><?php echo $type[1];?></td>
           <td><?php echo $issue[3];?></td>
           <td><?php echo $data_array[2];?></td>
           <td>
            <select class="form-control" style="height: 32px; width: 120px;" <?php echo $disabled;?>  id="change_assign<?php echo $data_array[0];?>">
              <?php 
              $agent = mysql_query("SELECT * FROM `ticket_dev`.`users` WHERE `user_group_id` LIKE '%".$data_array[14]."%' ");
              while ($agent_row = mysql_fetch_assoc($agent)) {?>

                <option  <?php if ($agent_row['id'] == $assignd) {echo "selected";}?> value="<?php echo $agent_row['id'];?>"><?php echo $agent_row['user_name'];?></option>
                <?php

              }?>
            </select>
          </td>
          <td><?php echo $data_array[4];?></td>
          <!-- <td><?php echo $priority;?></td> -->
          <td>
            <select class="form-control" style="height: 32px; width: 111px;" <?php echo $disabled;?>  id="change_status<?php echo $data_array[0];?>">
              <?php 
              if ($_SESSION['previlege'] == 4) {
                $ticket_status = mysql_query("SELECT * FROM `ticket_dev`.`ticket_status` WHERE `status_name` != 'New' AND `status_name` != 'Work in progress' ORDER BY `status_name` ASC");
              } else {
                $ticket_status = mysql_query("SELECT * FROM `ticket_dev`.`ticket_status` ORDER BY `status_name` ASC");
              }
              
              while ($status_row = mysql_fetch_assoc($ticket_status)) {

                if (($_SESSION['previlege'] != 4) && ($_SESSION['previlege'] != 5)) {
                  $status_disabled = "";
                  if ($status_row['status_name'] == "Closed") {$status_disabled = "disabled";}
                  if ($status_row['status_name'] == "Extended") {$status_disabled = "disabled";}
                  if ($status_row['status_name'] == "Re-route") {$status_disabled = "disabled";}
                }

                ?>

                <option  <?php if ($status_row['status_name'] == $status) {echo "selected";}?> <?php echo $status_disabled;?> value="<?php echo $status_row['status_name'];?>"><?php echo $status_row['status_name'];?></option>
                <?php

              }?>
            </select>
          </td>
          <td><?php echo $data_array[7];?></td>
          <td><?php echo $data_array[15];?></td>
          <td><?php echo $res;?> - <?php echo slaSTatus($data_array[0]); ?></td>
          <td>
            <?php if ($status == "Closed") { ?>
              <br><button type="button" onclick="view('<?php echo $data_array[0];?>')" class="btn btn-danger btn-sm">View</button>
            <?php } else { ?>
            <span>
              <a onclick="smcollege('<?php echo $data_array[0];?>')">
                <img src="update/edit.png" width="15" height="15" style="cursor:pointer;" title="Update Ticket <?php echo $data_array[0];?>">
              </a><br><br>
              <button type="button" onclick="modify('<?php echo $data_array[0];?>')" class="btn btn-primary btn-sm">Update</button></span>
              <?php } ?>
          </td>
        </tr>
        <?php }
unset($assignd);
unset($status);
?>
</tbody>
</table>
</div>