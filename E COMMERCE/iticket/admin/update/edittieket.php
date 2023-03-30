<script src="../ck/ckeditor.js"></script>
<script type="text/javascript">
  function changeText3(str){
    document.getElementById('cc').value=document.getElementById('cc').value+","+document.getElementById('cclist').value;
  }
</script>
<style type="text/css">
  .brand {
    font-family: Georgia, "Times New Roman", Times, serif;
    font-style: oblique; font-weight: bolder; font-size: 30px;
    color:#333333;
    font-weight:bolder;
  }
  .form-consex{
    width:190px !important;
    height:30px;
    border:1px solid #999999;
    border-radius:3px;
    padding-left:5px;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:10px;
    font-weight:bolder;
  }
  .form-consex:focus{
    box-shadow: 0px 0px 8px #04124D;
  }
  .form-conarea{
    width:100% !important;
    border:1px solid #999999;
    border-radius:3px;
    padding-left:5px;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:10px;
    font-weight:bolder;
  }
  .form-conarea:focus{
    box-shadow: 0px 0px 8px #04124D;
  }
  .su_btn{
    border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;
  }
  .su_btn:hover{
    background-color:#6666FF;
  }
</style>


<?php
include '../../db.php';

if(isset($_POST['NP']))
{
  $order_id = $_GET['order_id'];
  $results=mysql_query("SELECT * FROM ticket where id=".$_POST['q1']);
  $data_array=mysql_fetch_row($results);
  $Global_id=$_POST['q1'];
}
else
{
  $order_id = $_GET['order_id'];
  $results=mysql_query("SELECT * FROM ticket where id=".$_GET['q1']);
  $data_array=mysql_fetch_row($results);
  $Global_id=$_GET['q1'];
}
?>

<div align="center" style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bolder;">
  Update <span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> id <?php print $Global_id;?>
</div>



<form action="" method="post">
  <input type="hidden" name="q1" value="<?php print $Global_id;?>">


  <br>
  <table align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">

    <tr>
      <td>Assigned To</td>
      <td>:</td>
      <td>
        <select name="to" class="form-consex" id="to" required>
          <?php
          $result1 = mysql_query("select id,user_name FROM users ORDER BY user_id DESC");
          while($row=mysql_fetch_array($result1)) { 
            if($row['id']==$data_array[3]) {print "<option value=\"".$row['id']."\" selected >".$row['user_name']."</option>";}
            else print "<option value=\"".$row['id']."\">".$row['user_name']."</option>";
          } ?>
        </select></td>

        <td>Brand</td>
        <td>:</td>
        <td>
          <select name="type" class="form-consex" id="type" required>
            <?php
            $result1 = mysql_query("select type_name FROM ticket_type ");
            while($row=mysql_fetch_array($result1)) { 
              if($row['type_name']==$data_array[1]) print "<option value=\"".$row['type_name']."\" selected>".$row['type_name']."</option>";
              else print "<option value=\"".$row['type_name']."\">".$row['type_name']."</option>";
            } ?>
          </select>
        </td>
      </tr>
      <tr>
      </tr>
      <tr>
        <td>Branch</td>
        <td>:</td>
        <td>
          <select name="branch_name" class="form-consex" id="branch_name" required>
            <option value="NO">-Select Branch-</option>
            <?php
            $result1 = mysql_query("select id,branch_name FROM user_group ");
            while($row=mysql_fetch_array($result1)) { 
              if($row['id']==$data_array[4]) print "<option value=\"".$row['id']."\" selected>".$row['branch_name']."</option>";
              else print "<option value=\"".$row['branch_name']."\">".$row['branch_name']."</option>";
            } ?>
          </select></td>

          <td>Customer Name</td>
          <td>:</td>
          <td><input name="cus_name" type="text" class="form-consex" id="cus_name" value="<?php print $data_array[6];?>"/></td>
        </tr>
        <tr>
          <td>Customer Phone</td>
          <td>:</td>
          <td><input name="cus_phone" type="text" class="form-consex" id="cus_phone" value="<?php print $data_array[5];?>"/></td>
        </tr>
        <tr>
          <td>Add More Recipient</td>
          <td>:</td>
          <td>
            <select name="cclist" class="form-consex" id="cclist" onchange="changeText3(this.value)">
              <option value="NO">-Select Reciever-</option>
              <?php
              $result1 = mysql_query("select id,user_name FROM users ORDER BY user_id DESC");
              while($row=mysql_fetch_array($result1)) { 
                print "<option value=\"".$row['id']."\">".$row['user_name']."</option>";
              } ?>
            </select></td>

            <td>Other Receiver</td>
            <td>:</td>
            <td><input name="cc" type="text" class="form-consex" id="cc" placeholder="More Recipient(s)"/></td>
          </tr>
          <tr>
            <td>Change Status</td>
            <td>:</td>
            <td>
             <select name="status" class="form-consex" id="status" required >
              <option value="">-Select Status-</option>
              <?php include 'db.php';
              $result1 = mysql_query("select *FROM ticket_status where status_name NOT LIKE '%New%'  ");
              while($row=mysql_fetch_array($result1)) { ?>
                <option value="<?=$row['status_name']?>">
                  <?php echo $row['status_name']?>
                </option>
              <?php } ?>
            </select>
          </td>
          <td>Another Name</td>
          <td>:</td>
          <td><input name="another_name" type="text" class="form-consex" id="another_name" value="<?php print $data_array[16];?>"/></td>
        </tr>
        <table class="table table-bordered table-striped text-center" style="background: beige;margin-left: 2px;">  
          <thead>
            <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total Price</th>
              <!-- <th>Action</th> -->
            </tr>
          </thead>
          <tbody id="filter_data_container">
            <?php
            include 'db.php';
            $psql = "SELECT * FROM `order_list` WHERE `order_id`= '$order_id'";
            $result = mysql_query($psql);
            $grand_total = 0;
            $sl = 0;
            while ($row = mysql_fetch_assoc($result)) {?>
              <tr>
                <td><?= ++$sl ?></td>
                <input type="hidden" class="pid" value="<?php echo $row['id'] ?>">
                <input type="hidden" name="strkey" id="strkey" value="<?php echo $order_id;?>">
                <input type="hidden" name="product_from" id="product_from<?php echo $row['id'] ?>" value="<?php echo $row['product_from'];?>">
                <td><img src="<?php echo $row['product_image'] ?>" width="50"></td>
                <td><?php echo $row['product_name'] ?></td>
                <td>
                  &#2547;&nbsp;&nbsp;<?php echo number_format($row['product_price'],2); ?>
                </td>
                <input type="hidden" class="pprice" value="<?php echo $row['product_price'] ?>">
                <!-- <td>
                  <input type="number" id="qty<?php echo $row['id']?>" class="form-control itemQty" value="<?php echo  $row['qty'] ?>" onchange="calculate_quantity(<?php echo $row['id'];?>)" style="width:75px;">
                </td> -->
                <td>
                  <?php echo $row['qty'];?>
                </td>

                <!-- <td>&#2547;&nbsp;&nbsp;<?php echo number_format($row['vat'],2)?></td>
                <td>&#2547;&nbsp;&nbsp;<?php echo number_format($row['sd'],2)?></td> -->
                <td>&#2547;&nbsp;&nbsp;<span id="total_price<?php echo $row['id']?>"><?php echo number_format($row['total_price'],2); ?></span></td>
                <!-- <td>
                  <div onclick="remove_item(<?php echo $row['id'] ?>)" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></div>
                </td> -->
              </tr>
              <?php
              $vat += $row['vat'];
              $sd += $row['sd'];
              $grand_total += $row['total_price'];
            }
            ?>
            <tr>
              <td colspan="3">
              </td>
              <td colspan="2"><b>product Price</b></td>
              <td><b>&#2547;&nbsp;&nbsp;<span id="grand_total"><?php echo number_format($grand_total,2); ?></span></b></td>
            </tr>
            <tr>
              <td colspan="3">
              </td>
              <td colspan="2"><b>VAT 10% </b></td>
              <td><b>&#2547;&nbsp;&nbsp;<span id="grand_total"><?php echo number_format($vat,2); ?></span></b></td>
            </tr>
            <tr>
              <td colspan="3">
              </td>
              <td colspan="2"><b>SD</b></td>
              <td><b>&#2547;&nbsp;&nbsp;<span id="grand_total"><?php echo number_format($sd,2); ?></span></b></td>
            </tr>

            <tr>
              <td colspan="3">
              </td>
              <td colspan="2"><b>Grand Total</b></td>
              <td><b>&#2547;&nbsp;&nbsp;<span id="grand_total"><?php echo number_format($grand_total+$vat+$sd,2); ?></span></b></td>
            </tr>
          </tbody>
        </table>
        <tr>
          <td>Complain Details</td>
          <td>:</td>
          <td colspan="4">
            <textarea class="form-conarea123" id="editor1" name="editor1" rows="4" required><?php print $data_array[11];?></textarea>
            <script>CKEDITOR.replace( 'editor1',{uiColor:'#CCCCCC'});CKEDITOR.config.height = 90;</script></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td></td>
            <td colspan="2">
              <input type="checkbox" name="ishir" id="ishir">
              <font style="font-weight:bold; color:#000099;">Maintain Hierarchy</font>
            </td>
            <td></td>
            <td></td>
          </tr>
        </table>
        <div align="center"><input type="submit" name="NP" id="NP" value="UPDATE" class="su_btn"></div>
      </form>


      <table align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
        <tr>
          <td valign="top"><strong style="color:#006633">Ticket Cycle </strong></td>
        </tr>
        <tr>
          <td valign="top">	
           <?php 	 include('db.php');  mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 	 
           $result = mysql_query("SELECT * FROM history where id='$Global_id' ORDER BY date ASC ");

           echo "<table  align='center'  class='table table-hover' >
           <tr>
           <th align='center'>Date</th>
           <th align='center'>Status</th>
           <th align='center'>From</th>
           <th align='center'>Details</th>	 
           </tr>";
           while($row = mysql_fetch_array($result))
           {
            echo "<tr style=\"font-size:11px;\">";
            echo "<td >" . $row['date'] . "</td>";
            echo "<td >" . $row['status'] . "</td>";
            echo "<td >" . $row['from'] . "</td>";
            echo "<td >" . $row['details'] . "</td>"; 
            echo "</tr>";
          }
          echo "</table>";
          ?>&nbsp;</td>
        </tr>
      </table>
      <?php
      session_start();
      $now_user = $_SESSION['usr01937417227'];
      if(isset($_POST['NP']))
      {
        if(isset($_POST['ishir']))
        {
          $results=mysql_query("UPDATE `ticket`.`ticket` SET `ticket_type` = '".$_POST['type']."',`another_name` = '".$_POST['another_name']."' `assignd` = '".$_POST['to']."', `	branch_name` = '".$_POST[	
            'branch_name']."', `cus_contact` = '".$_POST['cus_phone']."',   				
            `cus_name` = '".$_POST['cus_name']."', `cus_ac` = '".$_POST['account_id']."', `cus_product` = '".$_POST['product']."', `cus_amount` = '".	
            $_POST['amount']."', `status` = '".$_POST['status']."', `superiors` = CONCAT((select superior_id from users where id=".$_POST['to']."),\"".	
            $_POST['cc']."\") WHERE `ticket`.`id` = $Global_id");

          $results=mysql_query("INSERT INTO `history` (`id`,`status`,`from`, `details`,`date`) VALUES ('$Global_id','".$_POST['status']."', '".$now_user."','".$_POST['editor1']."',NOW() )");

          print "<div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#003300\">
          Ticket Updated Successfully.</font></div>";		
        }
        else{
          $results=mysql_query("UPDATE `ticket`.`ticket` SET `ticket_type` = '".$_POST['type']."', `another_name` = '".$_POST['another_name']."', `assignd` = '".$_POST['to']."', `branch_name` = '".$_POST[	
            'branch_name']."', `cus_contact` = '".$_POST['cus_phone']."',   				
            `cus_name` = '".$_POST['cus_name']."', `cus_ac` = '".$_POST['account_id']."', `cus_product` = '".$_POST['product']."', `cus_amount` = '".	
            $_POST['amount']."', `status` = '".$_POST['status']."', `superiors` = '".substr($_POST['cc'], 1)."' WHERE `ticket`.`id` = $Global_id");

          $results=mysql_query("INSERT INTO `history` (`id`,`status`,`from`, `details`,`date`) VALUES ('$Global_id','".$_POST['status']."', '".$now_user."','".$_POST['editor1']."',NOW() )");

          print "<div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#003300\">
          Ticket Updated Successfully.</font></div>";
        }
      }
      ?>
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
      <html xmlns="http://www.w3.org/1999/xhtml">
      <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="jquery-3.5.1.min.js"></script>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.js"></script>
        <script type="text/javascript">
          function calculate_quantity(product_id){
            var quantity = $('#qty'+product_id).val();
            var product_from = $('#product_from'+product_id).val();
            $.ajax({
              url: "order_action.php",
              type: "POST",
              data: {
                quantity:quantity,
                product_id:product_id,
                product_from:product_from   
              },
              cache: false,
              success: function(response){
                $('#total_price'+product_id).html(response);
                total_price();
                product_list();
              }
            });
          }

          function total_price(){
            var search_key = $('#strkey').val();
            $.ajax({
              url: "order_action.php",
              type: "POST",
              data: {
                search_key:search_key    
              },
              cache: false,
              success: function(response){
                $('#grand_total').html(response); 
              }
            });
          }

          function remove_item(product_id){
            $.ajax({
              url: "order_action.php",
              type: "POST",
              data: {
                delete_product_id:product_id    
              },
              cache: false,
              success: function(response){
                product_list();
              }
            });
          }

          function product_list(){
            var search_key = $('#strkey').val();
            $.ajax({
              url: "order_action.php",
              type: "POST",
              data: {
                searchkey:search_key    
              },
              cache: false,
              success: function(response){
                $("#filter_data_container").html(response);
              }
            });
          }
        </script>