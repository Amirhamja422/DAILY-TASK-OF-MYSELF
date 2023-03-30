<?php
  session_start();
  require 'config.php';

  // Set total price of the product in the cart table
  if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $pid = $_POST['pid'];
    $pprice = $_POST['pprice'];

    $tprice = $qty * $pprice;

    $stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
    //$stmt->bind_param('isi',$qty,$tprice,$pid);
    $stmt->bind_param('isi',$qty,$tprice,$pid);
    $stmt->execute();
    //echo "OK";
  }



  // Remove single items from cart
  if (isset($_GET['cart_id'])) {
    $id = $_GET['cart_id'];

    $stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
    $stmt->bind_param('i',$id);
    if($stmt->execute()){
      echo "Item removed from the cart!";
    }else{
      echo "failed to delete from cart";
    }
  }

  // Remove all items at once from cart
  if (isset($_GET['clear'])) {
    $stmt = $conn->prepare('DELETE FROM cart');
    $stmt->execute();
    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Item removed from the cart!';
    header('location:agent_ticket_create.php');
  }




  ?>