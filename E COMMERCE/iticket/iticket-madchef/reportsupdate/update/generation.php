<?php
include '../../db.php';

mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 




$q1 = $_GET['q1'];
$q2 = $_GET['q2'];
$q3 = $_GET['q3'];
$q4 = $_GET['q4'];
$brand = $_GET['brand'];
$branch = $_GET['branch'];
$user_id = $_GET['user_id'];
$skw = $_GET['skw'];



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



  $q3_query = "".$q3." like '%".$key."%' AND";

  

$results = mysql_query("SELECT * FROM ticket WHERE ".$q3_query." date >='".$q1." 00:00:00' AND date <='".$q2." 23:59:59' AND `group`='".$brand."' AND `branch_name`='".$branch."' ORDER BY `id` DESC");

 
?>
<div align="center" class="datagrid" style="width:99%; height:auto; overflow:auto;">
  <table class="anlepore">
    <thead align="center">
      <tr>

        <th>ID</th>
        <th>Order ID</th>
        <th>Initiator</th>
        <th>Customer Contact Number</th>
        <th>Name</th>
        <th>Address</th>
        <th>Note</th>
        <th>Status</th>
        <th>Create Date</th>
        <th>Invoice</th>
        <th title="UPDATE">
         Update
        </th>
      </tr>
    </thead>
    <tbody align="center">

       <?php
    $i = 1;
  while($ticket = mysql_fetch_assoc($results)){?>
      
      <tr>

        <td> <?php echo $ticket['id']; ?></td>
        <td> <?php echo $ticket['order_id']; ?></td>
        <td> <?php echo $ticket['agent']; ?></td>
        <td> <?php echo $ticket['cus_contact']; ?></td>
        <td> <?php echo $ticket['cus_name']; ?></td>
        <td> <?php echo $ticket['superiors']; ?></td>
        <td> <?php echo $ticket['note']; ?></td>
        <td> <?php echo $ticket['status']; ?></td>
        <td> <?php echo $ticket['date']; ?></td>
        <td>

        <a href="create_pdf/invoice.php?id=<?php echo $ticket['id'] ?>">
             Download Invoice</a>
        </td>
        <td>

          <button type="button" onclick="update_ticket_modal('<?php echo $ticket['id'];?>','<?php echo $ticket['order_id'];?>');" class="btn btn-success editbtn"> Update </button>

         <!-- <a onclick="smcollege('<?php echo $ticket['id'];?>')">
<img src="update/edit.png" width="15" height="15" style="cursor:pointer;" title="Update Ticket <?php echo $ticket['id'];?>">
</a>  -->

</td> 
      </tr>

  <?php } ?>
      

    </tbody>
</table>
</div>

<!--TICKET UPDATE MODAL START
 -->



<div class="modal fade"  id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        
</div>




<!-- MODAL END -->