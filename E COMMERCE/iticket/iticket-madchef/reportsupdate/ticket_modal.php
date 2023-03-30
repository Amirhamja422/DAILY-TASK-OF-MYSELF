    <?php
    include '../db.php';


    if (isset($_REQUEST['id'])) {
      $id = $_REQUEST['id'];
      $sql = "SELECT * FROM ticket  WHERE id = '". $id."'";
      $ticket =  mysql_query($sql);

      $sql_history = "SELECT * FROM history  WHERE id = '". $id."'";
      $history = mysql_query( $sql_history);

    }



    if (isset($_REQUEST['order_id'])) {
      $order_id = $_REQUEST['order_id'];
      $sql = "SELECT * FROM order_list  WHERE order_id = '". $order_id."'";
      $order =  mysql_query($sql);

    }

    ?>


    <div class="modal-dialog" role="document">
      <div class="modal-content"  style="width: 650px; float: center;background-color: #F8F8FF;">
        <div class="modal-header">
         <strong><h5 class="modal-title" id="exampleModalLabel"> Update Ticket   <p style="color:red;" ><?php echo $id; ?></p> </h5></strong>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <?php while ($row= mysql_fetch_assoc($ticket)) { ?>

       <div class="modal-body">

        <div class="form-group">
          <div class="row">
            <div class="col-md-2" style="font-size: 12px;"><label> Customer Name </label></div>
            <div class="col-md-4">

              <input type="text" name="customer_name" id="customer_name" class="form-control" value="<?php echo $row['cus_name']?>"
              placeholder="" readonly>

            </div>
            <div class="col-md-2" style="font-size: 12px;"><label> Customer Phone </label></div>
            <div class="col-md-4">

             <input type="text" name="customer_phone" id="customer_phone" class="form-control" value="<?php echo $row['cus_contact'] ?>"
             placeholder="" readonly>

           </div>

         </div>
       </div>


       <div class="form-group">
        <div class="row">
          <div class="col-md-2" style="font-size: 12px;"><label> Brand </label></div>
          <div class="col-md-4">

           <input type="text" name="brand" id="brand" class="form-control"    value="<?php echo $row['group'] ?>"
           placeholder="" readonly>

         </div>
         <div class="col-md-2" style="font-size: 12px;"><label> Branch </label></div>
         <div class="col-md-4">

           <input type="text" name="branch" id="branch" class="form-control"   value="<?php echo $row['branch_name'] ?>"
           placeholder="" readonly>

         </div>
       </div>
     </div>
     <div class="form-group">
      <div class="row">
        <div class="col-md-2" style="font-size: 12px;"><label> Change Status </label></div>
        <div class="col-md-4">
         <select class="form-control" id="status" name="status" value="<?php echo $row['status']; ?>" aria-label="Default select example">
          <option selected ><?php echo $row['status']; ?></option>
          <?php
          include '../db.php';
          $sql = mysql_query("SELECT status_name FROM ticket_status ");
          while ($status = mysql_fetch_assoc($sql)) {?>
           <option value="<?php echo $status['status_name'];?>"><?php echo $status['status_name'];?>

           </option>

           <?php
         }


         ?>
       </select>
     </div>


        <div class="col-md-2" style="font-size: 12px;"><label>Order Note </label></div>

        <div class="col-md-4">
       <input type="text" name="note" id="note" class="form-control"   value="<?php echo $row['note'] ?>"
       placeholder=""  readonly >
      </div>

   </div>
 </div>

  <div class="form-group">
      <div class="row">

      <div class="col-md-2" style="font-size: 12px;"> <label> Address </label></div>
     <div class="col-md-10">
       <input type="text" name="address" id="address" class="form-control"   value="<?php echo $row['superiors'] ?>"
       placeholder="" readonly>
     </div>

   </div>
 </div>




</div>
<?php }   ?>
<center> <strong><p style="color: green;">Order Details</p></strong> </center>
<div class="modal-body">
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">SL</th>
        <th scope="col">Product Name</th>
        <th scope="col">Price</th>
          <th scope="col">Size</th>
        <th scope="col">Quantity</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i =1;
      while ($order_details = mysql_fetch_assoc($order)) {?>
       <tr>
        <th scope="row"><?php echo $i++; ?></th>
        <td><?php echo $order_details['product_name']; ?></td>
        <td><?php echo $order_details['product_price']; ?></td>
        <td><?php echo $order_details['product_size']; ?></td>
        <td><?php echo $order_details['qty']; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>

</div>

<div class="modal-body">
  <div class="row">
    <div class="col-md-6">
       <label style="color: green;"><strong>Update Details</strong>  </label>
      <textarea  type="text" name="update_details" id="update_details" class="form-control"   value=""
       placeholder="" ></textarea>


    </div>
    <div class="col-md-6">
      <div class="card bg-light mb-3" id="card" style="max-width: 15rem; ">
        <div class="card-body" style="background-color:#F5FFFA; text-align: left;">
         <?php
         $sql = mysql_query("SELECT SUM(qty * product_price) as total FROM order_list WHERE order_id = '". $order_id."' ");
         $sum = mysql_fetch_assoc($sql);

         $vat_calculation = mysql_query("SELECT SUM(vat) as vat FROM order_list WHERE order_id = '". $order_id."' ");
         $vat = mysql_fetch_assoc($vat_calculation);

         $sd_calculation = mysql_query("SELECT SUM(sd) as sd FROM order_list WHERE order_id = '". $order_id."' ");
         $sd = mysql_fetch_assoc($sd_calculation);


         $discount = mysql_fetch_assoc(mysql_query("SELECT `discount` FROM `discount` WHERE `order_id`='". $order_id."' "));


         ?>
         <strong><h6 style="color: red;">Sub Total : <?php echo $sum['total']; ?></h6></strong>         
         <strong><h6 style="color: red;">  SD : <?php echo round($sd['sd'],2); ?></h6></strong>
         <strong><h6 style="color: red;">  VAT : <?php echo round($vat['vat'],2); ?></h6></strong>
         <strong><h6 style="color: red;">  Discount : <?php echo round($discount['discount'],2); ?></h6></strong>
         <h5 style="color: red;"> Total with VAT & SD  : <?php echo round($vat['vat'] +$sum['total']+$sd['sd']); ?> BDT</h5>
         <h5 style="color: red;"> Net Payable(After Discount)  : <?php echo round($vat['vat'] +$sum['total']+$sd['sd']-$discount['discount']); ?> BDT</h5>
       </div>
     </div>
   </div>
 </div>
</div>
<div class="modal-footer">
 <h4 id="update_message" style="color: green;"></h4>
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="button" name="updatedata"  onclick="update_ticket('<?php echo $id; ?>');"   class="btn btn-primary">Update Ticket</button>
</div>

 <div class="modal-body">

<center> <strong><p style="color: green;">Ticket Cycle</p></strong> </center>
   <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Date</th>
        <th scope="col">Status</th>
        <th scope="col">From</th>
        <th scope="col">Details</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $i =1;
      while ($order_history = mysql_fetch_assoc($history)) {?>
       <tr>
        <td><?php echo $order_history['date']; ?></td>
        <td><?php echo $order_history['status']; ?></td>
        <td><?php echo $order_history['from']; ?></td>
        <td><?php echo $order_history['details']; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>

</div>
</div>
</div>
<script type="text/javascript"></script>
