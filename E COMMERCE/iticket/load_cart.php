<?php
session_start();
require 'config.php';
if (isset($_GET['cartItem']) == 'cart_item') {
  $phone = $_GET['phone'];
  if($phone == 'NO'){
    $phone = null;
  }
  $brand = $_GET['brand'];
  $branch = $_GET['branch'];
  if (isset($_GET['order_id'])) {
    $psql = "SELECT * FROM `order_list` WHERE `order_id`='".$_GET['order_id']."' AND `order_id` LIKE '%".$phone."%'";
    $discountsql = "SELECT `discount` FROM `discount` WHERE `order_id`='".$_GET['order_id']."'";
    $row = $conn->query($discountsql)->fetch_assoc();
    $discount = $row['discount'];
  }else{
    $psql = "SELECT * FROM cart WHERE `phone`='".$phone."' AND `brand`='$brand' AND `branch`='$branch'";
    $count = $conn->query($psql)->num_rows;
    $discount=0;
  }  
  $result = $conn->query($psql);
  $grand_total = 0;
  $vat =0;
  $sd=0;
  $sl = 0;
  $total_with_vat = 0;
  while ($rows = $result->fetch_assoc()) {?>
    <input type="hidden" id="product_id<?php echo $rows['id']?>" value="<?php echo $rows['product_code'] ?>">
    <input type="hidden" id="product_from<?php echo $rows['id']?>" value="<?php echo $rows['product_from'] ?>">
    <input type="hidden" id="brand" name="brand" value="<?php echo $brand ?>">
    <input type="hidden" id="branch" name="branch" value="<?php echo $branch ?>">
    <tr>
      <td><?php echo ++$sl ?></td>      
      <td><img src="<?php echo $rows['product_image'] ?>" width="50"></td>
      <td><?php echo $rows['product_name'] ?></td>
      <td><?php echo $rows['product_size'] ?></td>                       
      <td>
        <input type="number" class="form-control itemQty" id="qty<?php echo $rows['id'];?>" <?php if(isset($_GET['order_id'])){ echo 'readonly';}else{?> onclick="calculate_quantity(<?php echo $rows['id']?>)"<?php }?> value="<?php echo $rows['qty'] ?>" min="1" style="width:75px;">
      </td>
      <td>
        &#2547;&nbsp;<?php echo number_format($rows['product_price'],2); ?>
      </td>
      <input type="hidden" class="pprice" value="<?php echo $rows['product_price'] ?>">
      <td>&#2547;&nbsp;<span id="total_price<?php echo $rows['id']?>"><?php echo number_format($rows['total_price'],2); ?></span></td>

      <?php

      if (isset($_GET['order_id'])) {
        # code...
      }else{?>
        <td>
          <div onclick="delete_from_cart('<?php echo $rows['id'] ?>')" class="text-danger lead"><i class="fas fa-trash-alt"></i></div>
        </td>
        <?php
      }

      ?>
      
    </tr>
    <?php 
    $grand_total += $rows['total_price'];
    $sd += $rows['sd'];
    $vat += $rows['vat'];
  }
  // $vat = $grand_total * (10/100);    
  $total_with_vat = $grand_total + $vat +$sd-$discount;
  ?>
  <tr>
    <td colspan="5"></td>
    <td><b>Product Price </b></td>
    <td>
      <b>
        &#2547;&nbsp;<span id="grand_total"><?= number_format($grand_total,2); ?></span>
      </b>
    </td> 
  </tr>
  <tr>
    <td colspan="5"></td>
    <td>SD 10%</td>
    <td>
      <b>&#2547;&nbsp;<span id="vat"><?= number_format($sd,2); ?></span></b>
    </td> 
  </tr>
  <tr>
    <td colspan="5"></td>
    <td>VAT 10%</td>
    <td>
      <b>&#2547;&nbsp;
        <span id="vat"><?= number_format($vat,2); ?></span></b>
      </td> 
    </tr>
    <tr>
      <td colspan="5"></td>
      <td>Discount (-) </td>
      <td>
        <b>&#2547;&nbsp;<span id="discount_total"><?php echo $discount;?></span></b>
      </td> 
    </tr>
    <tr>
      <td colspan="5"></td>
      <td>Total Price</td>
      <td>
        <b>&#2547;&nbsp;
          <span id="total_with_vat"><?= round($total_with_vat); ?></span></b>
          <input type="hidden" name="total_price" id="total_price" value="<?php echo $total_with_vat?>">
        </td>
      </tr>
      <?php
      if (isset($_GET['order_id'])) {

      }else{
        ?>
        <tr>
         <td colspan="8">
          <button class="btn btn-success" type="submit" name="Submit" id="place_order" <?php if (($count <= 0) || ($phone == null)) { echo 'disabled';}?>  style="margin-left:589px; width: 120px;">Place Order</button>
        </td>
      </tr>
      <?php
    }
  }
  ?>