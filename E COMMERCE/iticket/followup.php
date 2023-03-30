<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php
  $rcv1= $_GET["id"] ;
  //echo $rcv1."</br>";
  $order_id= $_GET["order_id"];
  $phone= $_GET["phone_number"];
  if(isset($_POST['follow']))
  {

    include 'db.php';  mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
    $date = date("d-m-Y");
    $results=mysql_query("INSERT INTO `history` (`id`,`status`,`from`, `details`,`date`) VALUES ('$rcv1','".$_POST['status']."', '".$_POST['agent']."','".$_POST['editor1']."',NOW() )");
    $results5=mysql_query("UPDATE `ticket` SET  status= '".$_POST['status']."' where id= '$rcv1' ");
  }
  ?>


  <script src="ck/ckeditor.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

  <script type="text/javascript">


    function changeText2(str) {
      if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
    } else
    {// code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function ()
    {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
      {
        document.getElementById('kullu').innerHTML = "<textarea class=\"form-control\" id=\"editor1\" name=\"editor1\" rows=\"4\" required>" + xmlhttp.responseText + "</textarea>";
        CKEDITOR.replace('editor1');
        CKEDITOR.config.height = 90;
      }
    }
    xmlhttp.open("GET", "kullu/tem.php?q=" + str, true);
    xmlhttp.send();
  }
</script>

<script>


  function fetch_product(branch){
    var brand = $('#brand').val();
    var product_type = $('#product_type').val();
    var product_list = 'productlists';
    var from ='order_update';
    $.ajax({
      type: 'post',
      url: 'fetch_product.php',
      data: {
        brand:brand,
        branch:branch,
        product_type:product_type,
        product_list:product_list,
        from:from
      },
      success: function (response) {
        $("#product_sections").html(response);
        $("#product_sections").trigger("chosen:updated");
      }
    });
  };

  function productlists(product_type){
    var product_container = document.getElementById('product_sections');
    if(product_type == 'All'){
      var branch = $('#branch').val();
      fetch_product(branch);
    }else{
      select_primary_product(product_type);
    }     
  }


  function select_primary_product(product_type){
    var brand  = $('#brand').val();
    var branch = $('#branch').val();
    var product_list = 'productlists';
    var from ='order_update';
    $.ajax({
      type: 'post',
      url: 'fetch_product.php',
      data: {
        brand:brand,
        branch:branch,
        product_type:product_type,
        product_list:product_list,
        from:from
      },
      success: function (response) {  
        $("#product_sections").html(response);
        $("#product_sections").trigger("chosen:updated");
      }
    });

  }


  function select_secoundary_product(primary_product){
    var brand  = $('#brand').val();
    var branch = $('#branch').val();
    var product_type = $('#product_type').val();
    var from ='order_update';
    $.ajax({
      type: 'post',
      url: 'fetch_product.php',
      data: {
        brand:brand,
        branch:branch,
        primary_product:primary_product,
        product_type:product_type,
        from:from
      },
      success: function (response) {
        $("#secondary_product_list").html(response);
        $("#secondary_product_list").trigger("chosen:updated");
      }
    });

  }



  function load_cart_item_number() {
    var phone = $('#cus_phone').val();
    var order_id = $('#order_id').val();
    $.ajax({
      url: 'load_cart.php',
      method: 'GET',
      data: {
        phone:phone,
        cartItem: "cart_item",
        order_id:order_id
      },
      success: function(response) {
        $("#cart_item").html(response);
      }
    });
  }

  function add_to_order(){
    var productid = $('#search_text').val();
    var phone     = $('#cus_phone').val();
    var order_id  = $('#order_id').val();
    var primaryproduct = $('#primary_product').val();
    var secoundaryproduct = $('#secoundary_product').val();
    $.ajax({
      url : "fetch.php",
      type : "POST",
      data : { 
        phone:phone,
        productid : productid,
        order_id:order_id,
        primaryproduct:primaryproduct,
        secoundaryproduct:secoundaryproduct
      },
      success : function(data){
        load_cart_item_number();
      }
    });
  }



  function add_ons_to_order(){
    var productid = $('#add_ons').val();
    var phone      = $('#cus_phone').val();
    var order_id  = $('#order_id').val();    
    $.ajax({
      url : "fetch.php",
      type : "POST",
      data : { 
        phone:phone,
        add_ons_productid : productid,
        order_id:order_id
      },
      success : function(data){
        load_cart_item_number();
      }
    });
  }


  function update_discount(){
    var discount = $('#discount').val();
    var order_id  = $('#order_id').val();
    $.ajax({
      url : "fetch.php",
      type : "POST",
      data : {
        discount:discount,
        order_id:order_id
      },
      success : function(data){
        load_cart_item_number();
      }
    });
  }
</script> 


<title>. : : i Tracker : : .</title>
</head>
<body background="admin/<?php include 'bg.php';?>">

  <div class="container" style="background:#CCCCCC; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
    <?php //include'menu.php';?>
    <form id="form1" name="form1" method="post" action="">
     <?php
     $psql = "SELECT * FROM `order_list` WHERE `order_id`= '".$order_id."'";
     $result = mysql_query($psql);
     $row=mysql_fetch_assoc($result);

     $discount_data = mysql_fetch_assoc(mysql_query("SELECT `discount` FROM `discount` WHERE `order_id`='".$row['order_id']."'"));
     $discount = $discount_data['discount'];

     ?>

     <input type="hidden" name="id" value="<?php echo $row['id'] ?>">     
     <input type="hidden" name="cus_phone" id="cus_phone" value="<?php echo $phone?>">
     <input type="hidden" name="product_name " id="product_name" value="<?php echo $row['product_name '] ?>">
     <input type="hidden" name="product_image" id="product_image" value="<?php echo $row['product_image'] ?>">
     <input type="hidden" name="product_price" id="product_price" value="<?php echo $row['product_price'] ?>">
     <input type="hidden" name="qty" id="qty" value="<?php echo $row['qty'] ?>">
     <input type="hidden" name="total_price" id="total_price" value="<?php echo number_format($row['total_price'],2); ?>">

     <table width="660" height="98" border="0" align="center">
      <tr>
        <td width="550" valign="top">    
         <?php 
         $rcv= $_GET["id"] ;
         include 'db.php';
         mysql_query("SET CHARACTER SET utf8");
         mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
         $results2=mysql_query("SELECT *  FROM ticket WHERE id='$rcv'");
         while($row1 = mysql_fetch_array($results2))
         {
           $id=   $row1['id']  ; 
           $agent=   $row1['agent']  ; 
           $superiors=   $row1['superiors']  ; 
           $branch_name =   $row1['branch_name']  ; 
           $type=   $row1['ticket_type']  ; 
           $date=   $row1['date']  ; 
           $status=   $row1['status']  ; 
           $group=   $row1['group']  ; 
           $cus_name=   $row1['cus_name']  ; 
           $cus_phone=   $row1['cus_contact']  ; 
           $cus_id=   $row1['cus_ac']  ; 
           $product=   $row1['cus_product']  ; 
           $amount=   $row1['cus_amount']  ;
           $order_id = $row1['order_id']; 
           $note = $row1['note']; 
           $results3=mysql_query("SELECT * FROM users WHERE id='$to'");
           while($row2 = mysql_fetch_array($results3))
           {
             $to1=   $row2['user_name']  ;
           }
           if($group=="NO") 
           {
             $group1="NO";
           }
           else
           {
             $results4=mysql_query("SELECT * FROM user_group WHERE id='$branch_name '");
             while($row4 = mysql_fetch_array($results4))
             {
               $group1=   $row4['branch_name'];
             }
           }
         }
         ?>

         <input type="hidden" name="order_id" id="order_id" value="<?php echo $order_id ?>">     
         <input type="hidden" name="brand" id="brand" value="<?php echo $group ?>">
         <input type="hidden" name="branch" id="branch" value="<?php echo $branch_name ?>">
         <input type="hidden" name="agent" id="agent" value="<?php echo $agent?>">
         <br><strong style="color:#006633">Ticket Field Definations</strong>
       </td>
     </tr>
     <tr>
      <td valign="top">
        <table width="548" border="0">
          <tr>
            <td width="82" valign="top">Oreder Serial </td>
            <td valign="top"> : </td>
            <td width="157" valign="top"><?php echo $id; ?>&nbsp;</td>
            <input type="hidden" name="ticket_id" id="ticket_id" value="<?php echo $id; ?>">
            <td width="106" valign="top">Customer name </td>
            <td valign="top"> : </td>
            <td width="185" valign="top"><?php echo $cus_name; ?></td>
          </tr>
          <tr>
            <td valign="top">Branch</td>
            <td valign="top"> : </td>
            <td valign="top"><?php echo $branch_name; ?></td>
            <td valign="top">Customer phone </td>
            <td valign="top"> : </td>
            <td valign="top"><?php echo $cus_phone; ?></td>
          </tr>
          <tr>
           <td valign="top">Brand</td>
           <td valign="top"> : </td>
           <td valign="top"><?php echo $group; ?></td>

           <td valign="top"></td>
           <td valign="top"></td>
           <td valign="top"></td>
         </tr>
         <tr>
          <td valign="top">Agent</td>
          <td valign="top"> : </td>
          <td valign="top"><?php echo $agent; ?></td>
          <td valign="top">Orde ID </td>
          <td valign="top"> : </td>
          <td valign="top"><?php echo $order_id; ?></td>
        </tr>
        <tr>
          <td valign="top">Status</td>
          <td valign="top"> : </td>
          <td valign="top"><?php echo $status; ?></td>
          <td valign="top">Address</td>
          <td valign="top"> : </td>
          <td valign="top"><?php echo $superiors; ?></td>
        </tr>
        <tr>
          <td valign="top">Date</td>
          <td valign="top"> : </td>
          <td valign="top"><?php echo $date; ?></td>
          <td valign="top">Note</td>
          <td valign="top"> : </td>
          <td valign="top"><?php echo $note; ?></td>
        </tr>

        <!-- <tr>
          <td valign="top">Product Type</td>
          <td valign="top"> : </td>
          <td valign="top">
            <select name="product_type" id="product_type" onclick="productlists(this.value);" style="width: 120px;">
              <option value="All">All</option>
              <option value="half&half">Half & Half</option>
            </select>
          </td>
        </tr>
        <tr id="product_sections"></tr> -->
<!--         <tr>
          <td>Add-ons </td>
          <td valign="top"> : </td>
          <td valign="top">
            <select name="add_ons" class="chosen" required  id="add_ons" style="max-width: 120px; margin-top: 8px;" onchange="add_ons_to_order()">
              <option value="option_header">Add ons Product</option>
              <?php
              include 'db.php';
              $result1 = mysql_query("SELECT `id`,`product_name`, `product_price`, `product_image` FROM `ticket`.`add_ons` ORDER BY id");
              while ($row1 = mysql_fetch_array($result1)) {?>
                <option value="<?php echo $row1['id']; ?>"><?php echo $row1['product_name']." TK - ".$row1['product_price']; ?></option>   

                <?php
              } 
              ?>
            </select>
          </td>

          <td>Discount </td>
          <td valign="top"> : </td>
          <td valign="top">
            <input name="discount" type="number" id="discount" value="<?php print $discount; ?>" placeholder="Price discount" onchange="update_discount()" />
          </td>
        </tr> -->

      </table>

      <table class="table table-bordered table-striped text-center" style="background: beige;">
        <thead>
          <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Product</th>
            <th>Size</th>       
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Total Price</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="cart_item"></tbody>
      </table>
    </td>
  </tr>
  <tr>
    <td valign="top">    
      <table width="100%" border="0" align="left">
        <tr>
          <td width="523" >
            <strong style="color:#006633">Change Order Status</strong>
            <select name="status" class="form-control" id="status" style="width:200px !important;" required >
              <option value="">-Select Status-</option>
              <?php include 'db.php';
              $result1 = mysql_query("select *FROM ticket_status where status_name NOT IN ('New','Shipped','Cooking','Pending','Completed')  ");
              while($row=mysql_fetch_array($result1)) { ?>
                <option value="<?=$row['status_name']?>" <?php if($row['status_name'] == $status){echo 'selected';}?>>
                  <?=$row['status_name']?>
                </option>
                <?php 
              } 
              ?>
            </select>
          </td>
        </tr>


        <tr>
          <td width="523" >
            <strong style="color:#006633"> Order Status Template</strong>
            <select name="templete" class="form-control" id="templete" style="width:200px !important;" onchange="changeText2(this.value)">
              <option value="">-Select order-</option>
              <?php include 'db.php';
              $result1 = mysql_query("select * FROM  template");
              while($row=mysql_fetch_array($result1)) { ?>
                <option value="<?php echo $row[0]?>"><?php echo $row[1] ?></option>
                <?php 
              } 
              ?>
            </select>
          </td>
        </tr>
        <tr>
          <td height="150" valign="top"><p style="background-color:#FFFFFF;">
           <div id="kullu">
            <textarea class="form-control" id="editor1" name="editor1" rows="4" required> <?php print $detail_tra; ?></textarea>
          </div>
        </p>
        <p>
          <input name="follow" type="submit" class="btn btn-primary btn-sm" id="follow" value="Update"/>
        </p>
        <p>&nbsp; </p></td>
      </tr>
    </table>
  </td>
</tr>
<tr>
  <td valign="top"><strong style="color:#006633">Ticket Cycle </strong></td>
</tr>
<tr>
  <td valign="top">

   <?php
   include('db.php');  mysql_query("SET CHARACTER SET utf8");
   mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
   $result = mysql_query("SELECT * FROM history where id='$rcv' ORDER BY date DESC ");
   echo "<table  align='center'  class='table table-hover' >
   <tr>
   <th align='center'>Date</th>
   <th align='center'>Status</th>
   <th align='center'>From</th>
   <th align='center'>Details</th>
   </tr>";

   while($row = mysql_fetch_array($result)){
    echo "<tr style=\"font-size:10px;\">";
    echo "<td >" . $row['date'] . "</td>";
    echo "<td >" . $row['status'] . "</td>";
    echo "<td >" . $row['from'] . "</td>";
    echo "<td >" . $row['details'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
  ?>&nbsp;</td>
</tr>
<tr>
  <td valign="top"></td>
</tr>
<tr>
  <td valign="top">
    <script>
      CKEDITOR.replace( 'editor1');
      CKEDITOR.config.height = 90;
    </script>
    &nbsp;
  </td>
</tr>
<tr>
  <td valign="top">&nbsp;</td>
</tr>
</table>
</form>
</div>
<script type="text/javascript">
  $( document ).ready(function() {
    load_cart_item_number();
    var product_type = $('#product_type').val();
    productlists(product_type);
  });
  
  function calculate_quantity(cart_id){
    var quantity = $('#qty'+cart_id).val();
    var product_id = $('#product_id'+cart_id).val();
    var product_from  =$('#product_from'+cart_id).val();
    $.ajax({
      url: "order_action.php",
      type: "POST",
      data: {
        quantity:quantity,
        product_id:product_id,
        cart_id:cart_id,
        product_from:product_from    
      },
      cache: false,
      success: function(response){
        load_cart_item_number();
      }
    });
  }

  function delete_from_cart(order_id){
    $.ajax({
      url: "order_action.php",
      type: "POST",
      data: {
        delete_order_id:order_id    
      },
      cache: false,
      success: function(response){
        load_cart_item_number();
      }
    });
  }
</script>
</body>
</html>
