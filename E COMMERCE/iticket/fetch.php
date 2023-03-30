<?php
//fetch.php
require 'config.php';
$output = '';


//########################################################################################################################
//########################################## Add Ons product Add to Cart Start ###########################################
if (isset($_POST['add_ons_product_id'])) {
  $product_id=$_POST['add_ons_product_id'];
  if($product_id != 'option_header'){
    $phone=$_POST['phone'];
    $brand=$_POST['brand'];
    $branch=$_POST['branch'];

    $sql = "SELECT * FROM `cart` WHERE `product_code`='$product_id' AND `phone`='".$phone."'";
    $product_count = $conn->query($sql)->num_rows;

    $sql1 = "SELECT * FROM `add_ons` WHERE `id`='".$product_id."'";
    $product = $conn->query($sql1)->fetch_assoc();


    if ($product_count > 0 ) {
      $chksql = "SELECT * FROM `cart` WHERE `product_code`='".$product_id."'  AND `phone`='".$phone."'";
      $cart_products = $conn->query($chksql)->fetch_assoc();


      $quantity    = $cart_products['qty'] + 1;
      $total_price = $product['product_price'] * $quantity;
      $product_vat = $product['vat'];
      
      $sd          = $product['product_price'] * ($product['sd']/100);
      $vat         = ($product_vat/100)*($total_price+$sd);


      $upsql = "UPDATE `cart` SET `qty`='$quantity',`total_price`='$total_price',`vat`='$vat',`sd`='$sd' WHERE `product_code`='$product_id'  AND `phone`='".$phone."'";
      $response = $conn->query($upsql);
      if($response){
        echo "success";
      }else{
        echo "failed";
      }

    }else{

      $product_vat = $product['vat'];
      $sd  = $product['product_price'] * ($product['sd']/100);
      $vat =($product_vat/100)*($product['product_price']+$sd);
      $total_price = $product['product_price'];


      $result = $conn->query("INSERT INTO `cart`(`phone`,`brand`,`branch`, `product_name`, `product_price`, `product_image`, `qty`,`product_code`,`vat`,`sd`, `total_price`,`product_from`) VALUES('".$phone."','".$brand."','".$branch."','".$product['product_name']."','".$product['product_price']."','".$product['product_image']."',
        '1','".$product['id']."','".$vat."','".$sd."','".$total_price."','ad_ons_product')");

      if($result){
        echo "success";
      }else{
        echo "failed";
      }
    }
  }
}
//########################################## Add Ons product Add to Cart End ###########################################
//######################################################################################################################

//######################################################################################################################
//########################################## Half And Half product cart start #########################################

if (isset($_POST['primary_product']) && isset($_POST['secoundary_product'])) {
  $primary_product=$_POST['primary_product'];
  $secoundary_product=$_POST['secoundary_product'];
  $phone=$_POST['phone'];
  $brand=$_POST['brand'];
  $branch=$_POST['branch'];

  $psql = "SELECT * FROM `product` WHERE `id`='".$primary_product."'";
  $primary_products = $conn->query($psql)->fetch_assoc();

  $ssql = "SELECT * FROM `product` WHERE `id`='".$secoundary_product."'";
  $secoundary_products = $conn->query($ssql)->fetch_assoc();


  if ($primary_products['product_price'] >= $secoundary_products['product_price']) {

    $product_size = $primary_products['product_size'];
    $product_price = $primary_products['product_price'];
    
    $sd  = $primary_products['product_price'] * ($primary_products['sd']/100);
    $vat = (10/100)*($primary_products['product_price']+$sd);
    $total_price = $primary_products['product_price'];
    $product_image = $primary_products['product_image'];
    $product_id = $primary_products['id'];

  }else{

    $product_size = $secoundary_products['product_size'];
    $product_price =$secoundary_products['product_price'];    
    $sd  = $secoundary_products['product_price'] * ($secoundary_products['sd']/100);
    $vat = (10/100)*($secoundary_products['product_price']+$sd);
    $total_price = $secoundary_products['product_price'];
    $product_image = $secoundary_products['product_image'];
    $product_id = $secoundary_products['id'];

  }

  $product_name = $primary_products['product_name']."+".$secoundary_products['product_name'];

  $chksql = "SELECT * FROM `cart` WHERE `product_code`='$product_id' AND `phone`='".$phone."' AND `product_name`='$product_name'";
  $product_count = $conn->query($chksql)->num_rows;

  if($product_count > 0){
    $chk_sql = "SELECT * FROM `cart` WHERE `product_code`='".$product_id."'  AND `phone`='".$phone."'";
    $cart_products = $conn->query($chk_sql)->fetch_assoc();


    $quantity    = $cart_products['qty'] + 1;
    $total_price = $cart_products['product_price'] * $quantity;    
    $sd          = $total_price * ($product['sd']/100);
    $vat         = (10/100)*($total_price+$sd);


    $upsql = "UPDATE `cart` SET `qty`='$quantity',`total_price`='$total_price',`vat`='$vat',`sd`='$sd' WHERE `product_code`='$product_id'  AND `phone`='".$phone."'";
    $response = $conn->query($upsql);
    if($response){
      echo "success";
    }else{
      echo "failed";
    }
  }else{
    $result = $conn->query("INSERT INTO `cart`(`phone`,`brand`, `branch`, `product_name`, `product_price`,`product_size`,`product_image`, `qty`,`product_code`,`vat`,`sd`, `total_price`,`product_from`) VALUES('".$phone."','".$brand."','".$branch."','".$product_name."','".$product_price."','".$product_size."','".$product_image."','1','".$product_id."','".$vat."','".$sd."','".$total_price."','main_product')");

    if($result){
      echo "success";
    }else{
      echo "failed";
    }
  }
}
//########################################## Half And Half product cart End ##############################################
//########################################################################################################################


//########################################################################################################################
//########################################## main product Add to Cart Start ###############################################
if(isset($_POST["product_id"])){
  $product_id=$_POST['product_id'];
  if($product_id != 'option_header'){
    $phone=$_POST['phone'];
    $brand=$_POST['brand'];
    $branch=$_POST['branch'];
    $sql = "SELECT * FROM `cart` WHERE `product_code`='$product_id' AND `phone`='".$phone."'";
    $product_count = $conn->query($sql)->num_rows;

    $sql1 = "SELECT * FROM `product` WHERE `id`='".$product_id."'";
    $product = $conn->query($sql1)->fetch_assoc();


    if ($product_count > 0 ) {
      $chksql = "SELECT * FROM `cart` WHERE `product_code`='".$product_id."'  AND `phone`='".$phone."'";
      $cart_products = $conn->query($chksql)->fetch_assoc();


      $quantity    = $cart_products['qty'] + 1;
      $total_price = $product['product_price'] * $quantity;      
      $sd          = $total_price * ($product['sd']/100);
      $vat         = ($total_price+$sd)*(10/100);





      $upsql = "UPDATE `cart` SET `qty`='$quantity',`total_price`='$total_price',`vat`='$vat',`sd`='$sd' WHERE `product_code`='$product_id'  AND `phone`='".$phone."'";

      echo $upsql;
      $response = $conn->query($upsql);
      if($response){
        echo "success";
      }else{
        echo "failed";
      }

    }else{
      $sd  = $product['product_price'] * ($product['sd']/100);
      $vat = (10/100)*($product['product_price']+$sd);
      $total_price = $product['product_price'];


      $result = $conn->query("INSERT INTO `cart`(`phone`,`brand`, `branch`,`product_name`, `product_price`,`product_size`, `product_image`, `qty`,`product_code`,`vat`,`sd`, `total_price`,`product_from`) VALUES('".$phone."','".$brand."','".$branch."','".$product['product_name']."','".$product['product_price']."','".$product['product_size']."','".$product['product_image']."',
        '1','".$product['id']."','".$vat."','".$sd."','".$total_price."','main_product')");

      if($result){
        echo "success";
      }else{
        echo "failed";
      }
    }
  }
}

//##################################### main Product Add to cart End ##############################################
//#################################################################################################################


//#################################################################################################################
//#################################### Main product add to order ####################################################
if(isset($_POST["productid"])){
  $product_id=$_POST['productid'];
  if($product_id != 'option_header'){
    $phone=$_POST['phone'];
    $order_id = $_POST['order_id'];
    $sql = "SELECT * FROM `order_list` WHERE `product_code`='$product_id' AND `phone`='".$phone."' AND `order_id`='$order_id'";
    $product_count = $conn->query($sql)->num_rows;

    $sql1 = "SELECT * FROM `product` WHERE `id`='".$product_id."'";
    $product = $conn->query($sql1)->fetch_assoc();


    if ($product_count > 0 ) {
      $chksql = "SELECT * FROM `order_list` WHERE `product_code`='".$product_id."'  AND `phone`='".$phone."' AND `order_id`='$order_id'";
      $order_products = $conn->query($chksql)->fetch_assoc();


      $quantity    = $order_products['qty'] + 1;
      $total_price = $product['product_price'] * $quantity;
      $sd          = $total_price * ($product['sd']/100);
      $vat         = (10/100)*($total_price+$sd);
      


      $upsql = "UPDATE `order_list` SET `qty`='$quantity',`total_price`='$total_price',`vat`='$vat',`sd`='$sd' WHERE `product_code`='$product_id'  AND `phone`='".$phone."' AND `order_id`='$order_id'";
      $response = $conn->query($upsql);
      if($response){
        echo "success";
      }else{
        echo "failed";
      }

    }else{

      
      $sd =$product['product_price'] * ($product['sd']/100);
      $vat =(10/100)*($product['product_price']+$sd);
      $total_price = $product['product_price'];

      $new_order_sql ="INSERT INTO `order_list`(`phone`,`order_id`,`product_code`,`product_name`, `product_price`,`product_size`, `product_image`, `qty`,`vat`,`sd`, `total_price`,`product_from`) VALUES('".$phone."','".$order_id."','".$product['id']."','".$product['product_name']."','".$product['product_price']."','".$product['product_size']."','".$product['product_image']."',
      '1','".$vat."','".$sd."','".$total_price."','main_product')";
      echo $new_order_sql;
      $result = $conn->query($new_order_sql);
      if($result){
        echo "success";
      }else{
        echo "failed";
      }
    }
  }
}
//#################################### Main product add to order End ####################################################



//########################################## Half And Half product order start #########################################

if (isset($_POST['primaryproduct']) && isset($_POST['secoundaryproduct'])) {
  $primary_product=$_POST['primaryproduct'];
  $secoundary_product=$_POST['secoundaryproduct'];
  $phone=$_POST['phone'];
  $order_id = $_POST['order_id'];


  $psql = "SELECT * FROM `product` WHERE `id`='".$primary_product."'";
  $primary_products = $conn->query($psql)->fetch_assoc();

  $ssql = "SELECT * FROM `product` WHERE `id`='".$secoundary_product."'";
  $secoundary_products = $conn->query($ssql)->fetch_assoc();


  if ($primary_products['product_price'] >= $secoundary_products['product_price']) {

    $product_price = $primary_products['product_price'];
    $sd  = $primary_products['product_price'] * ($primary_products['sd']/100);
    $vat = (10/100)*($primary_products['product_price']+$sd);
    
    $total_price = $primary_products['product_price'];
    $product_image = $primary_products['product_image'];
    $product_id = $primary_products['id'];
    $product_size = $primary_products['product_size'];

  }else{

    $product_price =$secoundary_products['product_price'];
    $sd  = $secoundary_products['product_price'] * ($secoundary_products['sd']/100);
    $vat = (10/100)*($secoundary_products['product_price']+$sd);
    
    $total_price = $secoundary_products['product_price'];
    $product_image = $secoundary_products['product_image'];
    $product_id = $secoundary_products['id'];
    $product_size = $secoundary_products['product_size'];

  }

  $product_name = $primary_products['product_name']."+".$secoundary_products['product_name'];

  $chksql = "SELECT * FROM `order_list` WHERE `product_code`='$product_id' AND `phone`='".$phone."' AND `product_name`='$product_name' AND `order_id`='$order_id'";
  $product_count = $conn->query($chksql)->num_rows;


  if($product_count > 0){
    $chk_sql = "SELECT * FROM `order_list` WHERE `product_code`='".$product_id."'  AND `phone`='".$phone."' AND `order_id`='$order_id'";
    $cart_products = $conn->query($chk_sql)->fetch_assoc();


    $quantity    = $cart_products['qty'] + 1;
    $total_price = $cart_products['product_price'] * $quantity;    
    $sd          = $total_price * ($product['sd']/100);
    $vat         = (10/100)*($total_price+$sd);


    $upsql = "UPDATE `order_list` SET `qty`='$quantity',`total_price`='$total_price',`vat`='$vat',`sd`='$sd' WHERE `product_code`='$product_id'  AND `phone`='".$phone."' AND `order_id`='$order_id'";
    $response = $conn->query($upsql);
    if($response){
      echo "success";
    }else{
      echo "failed";
    }
  }else{

    $new_order_sql ="INSERT INTO `order_list`(`phone`,`order_id`,`product_code`,`product_name`, `product_price`,`product_size`, `product_image`, `qty`,`vat`,`sd`, `total_price`,`product_from`) VALUES('".$phone."','".$order_id."','".$product_id."','".$product_name."','".$product_price."','".$product_size."','".$product_image."','1','".$vat."','".$sd."','".$total_price."','main_product')";

    $result = $conn->query($new_order_sql);

    if($result){
      echo "success";
    }else{
      echo "failed";
    }
  }
}
//########################################## Half And Half product order End #########################################




//########################################## Add Ons product order start #########################################

if(isset($_POST["add_ons_productid"])){
  $add_ons_productid=$_POST['add_ons_productid'];
  if($add_ons_productid != 'option_header'){
    $phone=$_POST['phone'];
    $order_id = $_POST['order_id'];
    $sql = "SELECT * FROM `order_list` WHERE `product_code`='$add_ons_productid' AND `phone`='".$phone."' AND `order_id`='$order_id'";
    $product_count = $conn->query($sql)->num_rows;

    $sql1 = "SELECT * FROM `add_ons` WHERE `id`='".$add_ons_productid."'";
    $product = $conn->query($sql1)->fetch_assoc();


    if ($product_count > 0 ) {
      $chksql = "SELECT * FROM `order_list` WHERE `product_code`='".$add_ons_productid."'  AND `phone`='".$phone."'  AND `order_id`='$order_id'";
      $order_products = $conn->query($chksql)->fetch_assoc();


      $quantity    = $order_products['qty'] + 1;
      $total_price = $product['product_price'] * $quantity;
      $product_vat = $product['vat'];
      $sd          = $total_price * ($product['sd']/100);
      $vat         = ($total_price+$sd)* ($product_vat/100);
      


      $upsql = "UPDATE `order_list` SET `qty`='$quantity',`total_price`='$total_price',`vat`='$vat',`sd`='$sd' WHERE `product_code`='$add_ons_productid'  AND `phone`='".$phone."' AND `order_id`='$order_id'";
      $response = $conn->query($upsql);
      if($response){
        echo "success";
      }else{
        echo "failed";
      }

    }else{
      $product_vat = $product['vat'];
      
      $sd  = $product['product_price'] * ($product['sd']/100);
      $vat = ($product['product_price'] +$sd)*($product_vat/100);
      $total_price = $product['product_price'];


      $new_order_sql ="INSERT INTO `order_list`(`phone`,`order_id`,`product_code`,`product_name`, `product_price`, `product_image`, `qty`,`vat`,`sd`, `total_price`,`product_from`) VALUES('".$phone."','".$order_id."','".$product['id']."','".$product['product_name']."','".$product['product_price']."','".$product['product_image']."',
      '1','".$vat."','".$sd."','".$total_price."','ad_ons_product')";
      echo $new_order_sql;
      $result = $conn->query($new_order_sql);
      if($result){
        echo "success";
      }else{
        echo "failed";
      }
    }
  }
}
//########################################## Add Ons product order END #########################################
//##############################################################################################################


//########################################## Price Discount Start ##############################################
if (isset($_POST['discount'])) {
  $conn->query("UPDATE `discount` SET `discount`='".$_POST['discount']."' WHERE `order_id`='".$_POST['order_id']."'");
}
//########################################### Price Discount End ###############################################
?>