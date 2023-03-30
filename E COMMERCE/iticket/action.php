<?php
session_start();
require 'config.php';
if (isset($_GET['cartItem']) == 'cart_item') {
  $phone = $_GET['phone'];
  $psql = "SELECT * FROM cart WHERE `phone`='".$phone."'";
  $result = $conn->query($psql);
  $grand_total = 0;
  $sl = 0;
  while ($rows = $result->fetch_assoc()) {?>
    <tr>
      <td><?php echo ++$sl ?></td>
      <input type="hidden" class="pid" value="<?php echo $rows['id'] ?>">
      <td><img src="<?php echo $rows['product_image'] ?>" width="50"></td>
      <td><?php echo $rows['product_name'] ?></td>                      
      <td>
        <input type="number" class="form-control itemQty" id="qty<?php echo $rows['id']?>" onclick="calculate_quantity(<?php echo $rows['id']?>)" value="<?php echo $rows['qty'] ?>" style="width:75px;">
      </td>
      <td>
        <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?php echo $rows['vat']; ?>
      </td>
      <td>
        <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?php echo $rows['sd']; ?>
      </td>
      <td>
        <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?php echo number_format($rows['product_price'],2); ?>
      </td>
      <input type="hidden" class="pprice" value="<?php echo $rows['product_price'] ?>">
      <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?php echo number_format($rows['total_price'],2); ?></td>
      <td>
        <div onclick="delete_from_cart('<?php echo $rows['id'] ?>')" class="text-danger lead"><i class="fas fa-trash-alt"></i></div>
      </td>
    </tr>
    <?php 
    $grand_total += $rows['total_price'];
    $vat = $vat + $rows['vat'];
    $sd = $sd + $rows['sd'];
    $total_with_vat = $grand_total + $vat +$sd;
  }
  ?>
  <tr>
    <td colspan="5">
    </td>
    <td colspan="2"><b>Grand Total</b></td>
    <td>
      <b>
        <i class="fas fa-rupee-sign"></i>
        &nbsp;&nbsp;<span id="grand_total"><?= number_format($grand_total,2); ?></span>
      </b>
    </td> 
  </tr> 
  <tr> 
    <td colspan="7"><b style="margin-left: 387px;">VAT</b></td>
    <td>
      <b><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;
        <span id="vat"><?= number_format($vat,2); ?></span></b>
      </td> 
    </tr>
    <tr> 
      <td colspan="7"><b style="margin-left: 387px;">SD</b></td>
      <td>
        <b><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<span id="vat"><?= number_format($sd,2); ?></span></b>
      </td> 
    </tr>
    <tr>
     <td colspan="7"><b style="margin-left: 387px;">Grand Total with Vat</b></td>
     <td>
      <b><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;
        <span id="total_with_vat"><?= number_format($total_with_vat,2); ?></span></b>
      </td>
    </tr>
    <tr>
     <td colspan="14">
      <button class="btn btn-success" type="submit" name="Submit" id="place_order" style="margin-left:589px;">Place Order</button>
    </td>
  </tr>
  <?php
}
?>