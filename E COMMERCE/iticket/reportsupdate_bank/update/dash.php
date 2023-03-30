<?php
include '../../db.php';
session_start();
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 

  
$results = mysql_query("SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised', `ticket`.`assignd` as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name',  `cus_product` as 'Product Details',   `date` as 'Create Date', `hour_time` as 'SLA', `status` AS 'Status' , `stat` AS 'STAT', `assignd` AS 'ASS_ID', `sub_group` AS 'ISSUE', `priority` AS 'PRIORITY', `group` AS 'GROUP', `details` AS 'details' FROM `ticket_dev`.`ticket` WHERE `assignd`='".$_SESSION['id']."' AND `status` != 'Solved' AND `status` != 'Closed' ORDER BY `ticket`.`id` ASC");

$num_rows = mysql_num_rows($results);
?>
<div align="center" class="datagrid" id="datagrid" style="width:99%; height:auto; overflow:auto;">
  <table class="anlepore">
    <thead align="center">
      <tr>
        <th>ID</th>
        <th>SERVICE</th>
        <th>COMPLAIN TYPE</th>
        <th>Initiator</th>
        <!-- <th>Assigned</th> -->
        <th>Customer Contact Number</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Create Date</th>
        <th>SLA (Hours)</th>
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
        $history_last = mysql_fetch_assoc(mysql_query("SELECT * FROM `history` WHERE `id`='".$data_array[0]."' ORDER BY `date` DESC LIMIT 1"));
        $history_first = mysql_fetch_assoc(mysql_query("SELECT * FROM `history` WHERE `id`='".$data_array[0]."' ORDER BY `date` ASC LIMIT 1"));
        $history_count = mysql_num_rows(mysql_query("SELECT * FROM `history` WHERE `id`='".$data_array[0]."'"));


        $create = strtotime($data_array[7]);
        $today = strtotime(date('Y-m-d H:i:s'));
        $calculation = $today - $create;
        $exit = $data_array[8];
        $tat = number_format((($calculation/60)/60), 2, '.', '');

        if (($calculation > $exit) && ($data_array[9] != 'Solved')) { 
          $res = "Not Resolved Within SLA"; 
          $tr  = "<tr style=\"background-color: #EC981F;\">";
          $tr2  = "<tr class=\"altav\" style=\"background-color: #EC981F;\">";
        } else if(($calculation > $exit) && ($data_array[9] == 'Solved')) {
          $res = "Resolved  & SLA Not Met"; 
          $tr  = "<tr style=\"background-color: #789CFA;\">";
          $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
        } else if($data_array[9] == 'Solved'){
          $res = "Solved within SLA"; 
          $tr  = "<tr style=\"background-color: #789CFA;\">";
          $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
        } else if($data_array[9] == 'Closed'){
          $res = "Closed within SLA"; 
          $tr  = "<tr style=\"background-color: #789CFA;\">";
          $tr2  = "<tr class=\"altav\" style=\"background-color: #789CFA;\">";
        }
        else { 
          $res = "Not Resolved & SLA Not Met"; 
          $tr  = "<tr>";
          $tr2  = "<tr class=\"altav\">";
        }

        if ($data_array[13] == 1) {
            $priority = "General";
        } elseif ($data_array[13] = 2) {
            $priority = "Sensitive";
        } elseif ($data_array[13] = 3) {
            $priority = "Highly Sensitive";
        }

        $disabled = "";
        if ($status == "Closed") {
            $disabled = "disabled";
        }

        $type=mysql_fetch_row(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$data_array[1]."'"));
        $issue=mysql_fetch_row(mysql_query("SELECT * FROM `sub_group` WHERE `id`='".$data_array[12]."'"));
        ?>
          <tr>
           <td><?php echo $data_array[0];?></td>
           <td><?php echo $type[1];?></td>
           <td><?php echo $issue[3];?></td>
           <td><?php echo $data_array[2];?></td>
          <td><?php echo $data_array[4];?></td>
          <td><?php echo $priority;?></td>
          <td>
            <select class="form-control" style="height: 32px; width: 160px;" <?php echo $disabled;?> id="change_status<?php echo $data_array[0];?>">
              <?php 
              $ticket_status = mysql_query("SELECT * FROM `ticket_dev`.`ticket_status` WHERE `status_name` != 'Closed'");
              while ($status_row = mysql_fetch_assoc($ticket_status)) {

                if (($status == "Closed") && ($_SESSION['previlege'] != 4)) {
                    $admin_stat = "Solved";
                } else {
                    $admin_stat = $status;
                }
                ?>

                <option  <?php if ($status_row['status_name'] == $admin_stat) {echo "selected";}?> value="<?php echo $status_row['status_name'];?>"><?php echo $status_row['status_name'];?></option>
                <?php

              }?>
            </select>
          </td>
          <input type="hidden" id="change_assign<?php echo $data_array[0];?>" value="<?php echo $data_array[3]; ?>">
          <input type="hidden" id="details<?php echo $data_array[0];?>" value="<?php echo $data_array[15]; ?>">
          <td><?php echo $data_array[7];?></td>
          <td><?php echo $tat;?></td>
          <td><?php echo $res;?></td>
          <td>
            <?php if ($status == "Closed") { ?>
              <br><h6><span class="badge badge-danger">Closed</span></h6>
            <?php } else { ?>
            <span><a onclick="smcollege('<?php echo $data_array[0];?>')">
              <img src="update/edit.png" width="15" height="15" style="cursor:pointer;" title="Update Ticket <?php echo $data_array[0];?>">
            </a><br><br>
            <button type="button" onclick="modify('<?php echo $data_array[0];?>')" class="btn btn-primary btn-sm">Update</button></span>
          </td>
          <?php } ?>
        </tr>
        <?php
}
unset($assignd);
unset($status);
?>
</tbody>
</table>
</div>
