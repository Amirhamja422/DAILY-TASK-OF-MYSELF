<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />

  <script type="text/javascript">
    function Hamba_Java(str2)
    {
                /*if(str=="VODASAMA")
                 {
                 document.getElementById("pspan").innerHTML="<label class=\"glabel\">Select Product: <select name=\"product\" id=\"product\" style=\"width:120px;\" class=\"sdesign\"><option value=\"\">Select Product</option></select></label>";
                 return;
               }*/
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
                    document.getElementById("dishow").innerHTML = xmlhttp.responseText;
                  }
                }
                xmlhttp.open("GET", "supernova_dipu/plist.php?q=" + str2, true);
                xmlhttp.send();
              }
            </script>
            <script src="ck/ckeditor.js"></script>
            <script type="text/javascript">

              function changeText3(str) {
                document.getElementById('cc').value = document.getElementById('cc').value + "," + document.getElementById('cclist').value;
              }


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
            <style> 
              div.container {
                //width: 700px;
                width:100%;
                //-moz-box-shadow: 1px 3px 26px 9px #888888;
                //-webkit-box-shadow: 1px 3px 26px 9px #888888;
                //box-shadow: 1px 3px 26px 9px #888888;
              }
            </style>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1">
                    <!-- Bootstrap 
                      <link href="css/bootstrap.min.dipu.css" rel="stylesheet">-->
                      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                      <title>. : : i Tracker : : .</title>
                      <style type="text/css">
                        <!--
                        body {
                          //background-image: url(r2.jpg);
                          //background-repeat: repeat;
                        }
                        -->
                      </style></head>

                      <body background="admin/<?php include 'bg.php'; ?>">


                        <?php
                        $phone = "";
                        $customer_name = "";
                        $acc_no = "";
                        $product_tra = "";
                        $detail_tra = "";
                        $address_tra = "";
                        $agent89 = $_SESSION['agent_name'];
                        if (isset($_GET['phone_number']))
                          $phone = $_GET['phone_number'];
                        if (isset($_GET['customer_name']))
                          $customer_name = $_GET['customer_name'];
                        if (isset($_GET['acc_no']))
                          $acc_no = $_GET['acc_no'];
                        if (isset($_GET['agent_name']) != null)
                          $agent89 = $_GET['agent_name'];
                        if (isset($_GET['product']))
                          $product_tra = $_GET['product'];
                        if (isset($_GET['detail']))
                          $detail_tra = $_GET['detail'];
                        if (isset($_GET['address']))
                          $address_tra = $_GET['address'];
                        ?>



                        <div class="container" style="background-image: url('128-192.jpg'); color:white; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">

                          <!--    <div align="left" style="color:#0000FF;" id="dishow">&nbsp;</div> 
                            style="background-image: url('128-192.jpg'); color:yellow;-->
                            <table width="581" height="98" border="0" align="center">
                              <tr>
                                <td width="575" valign="top"><?php include'menu.php'; ?>
                              &nbsp;</td>
                            </tr>
                            <tr>
                              <td valign="top">
                                <form id="form1" name="form1" method="post" action="" style="margin-top: -14px;">
                                  <table width="300" height="220" border="0" style="margin-left: -27px;margin-bottom: -44px;">   


                                    <tr>
                                      <td width="75" height="32">Brand</td>

                                      <td valign="top"><select name="group" class="form-control" id="group" onchange="fetch_branchs(this.value);" required="required"style="width:217px; margin-top: 8px;">
                                        <option value="NO">-Select Brand-</option>
                                        <?
                                        include 'db.php';
                                        $result1 = mysql_query("select * FROM ticket_type");
                                        while ($row = mysql_fetch_array($result1)) {
                                          ?>
                                          <option value="<?= $row['type_name'] ?>">

                                            <?= $row['type_name'] ?>
                                          </option>
                                        <? } ?>
                                      </select></td> 
                                      <td valign="top">&nbsp;</td>

                                      <td>Branch</td>

                                      <td valign="top">
                                        <select name="branch_name" style="width: 195px; margin-top: 3px;" id="branch_name" class="form-control input" >
                                        </select>
                                      </td>
                                      <td valign="top">&nbsp;</td>
                                      <td valign="top">Customer Name </td>
                                      <td valign="top"><input name="cus_name" style="width: 195px;" type="text" class="form-control" id="cus_name" value="<?php print $customer_name; ?>"/></td>

                                    </tr>

                                    <tr>
                                      <td width="75" height="32">Order List</td>

                                      <td valign="top"><select name="search_text" class="form-control" id="search_text" style="width:217px; margin-top: 8px;">
                                       <option value="NO">-Select Order-</option>
                                       <?
                                       include 'db.php';
                                       $result1 = mysql_query("Select id, product_name , product_price, product_image from cart  ORDER BY id");
                                       while ($row = mysql_fetch_array($result1)) {
                                        ?>
                                        <option value="<?php echo $row['product_name']; ?>"><?php echo $row['product_name']."-".$row['product_price']."-".$row['product_image']; ?></option>   

                                      <? } ?>
                                    </select></td> 
                                    
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">Phone No</td>
                                    <td valign="top"><input name="cus_phone" style="width: 195px;" type="text" class="form-control" id="cus_phone" value="<?php print $phone; ?>" /></td>

                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">Add-ons </td>
                                    <td valign="top"><input name="cus_name" style="width: 195px;" type="text" class="form-control" id="cus_name" value="<?php print $customer_name; ?>"/></td>

                                  </tr>
                                  

                                  <tr>
                                    <td valign="top">Add reciever </td>

                                    <td valign="top"><select name="cclist" class="form-control"style="width: 218px; margin-top: 7px;" id="cclist" onchange="changeText3(this.value)">
                                      <option value="NO">-Select Reciever-</option>
                                      <?
                                      include 'db.php';
                                      $result1 = mysql_query("select *FROM users ");
                                      while ($row = mysql_fetch_array($result1)) {
                                        ?>
                                        <option value="<?= $row['id'] ?>">
                                          <?= $row['user_name'] ?>
                                        </option>
                                      <? } ?>
                                    </select>&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">Other reciever </td>
                                    <td valign="top"><input name="cc" type="text"style="width: 195px;" class="form-control" id="cc"/></td>  
                                    
                                  </tr>
                                  <tr>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top">&nbsp;</td>
                                    <td valign="top"><div align="right">
                                      <input type="submit" name="Submit" value="Create" class="btn btn-primary btn-sm" style="margin-right: -75px; margin-top: -62px;">  
                                    </div>
                                  </td>
                                </tr>
                              </table>



                              <?php
                              session_start();
                              ?>

                              

                              <div class="container">
                                <div class="row justify-content-center">
                                  <div style="display:<?php if (isset($_SESSION['showAlert'])) {
                                    echo $_SESSION['showAlert'];
                                  } else {
                                    echo 'none';
                                  } unset($_SESSION['showAlert']); ?>" class="alert alert-success alert-dismissible mt-3">
                                  <button type="button" class="close" data-dismiss="alert">&times;</button>
                                  <strong><?php if (isset($_SESSION['message'])) {
                                    echo $_SESSION['message'];
                                  } unset($_SESSION['showAlert']); ?></strong>
                                </div>
                                <div class="table-responsive">
                                  <table class="table table-bordered table-striped text-center" style="
                                  background: beige;
                                  ">    
                                  <thead>
                                    <tr>
                                      <td colspan="7">
                                      </td>
                                    </tr>
                                    <tr>
                                      <th>ID</th>
                                      <th>Image</th>
                                      <th>Product</th>
                                      <th>Price</th>
                                      <th>Quantity</th>
                                      <th>Total Price</th>
                                      <th>
                                        <a href="action2.php?clear=all" class="badge-danger badge p-1" onclick="return confirm('Are you sure want to clear your cart?');"><i class="fas fa-trash"></i>&nbsp;&nbsp;Clear Cart</a>
                                      </th>
                                    </tr>
                                  </thead>
                                  <tbody id="filter_data_container">
                                    <?php
                                    require 'config.php';
                                    $stmt = $conn->prepare('SELECT * FROM cart');
                                    $stmt->execute();
                                    $result = $stmt->get_result();
                                    $grand_total = 0;
                                    while ($row = $result->fetch_assoc()):
                                      ?>
                                      <tr>
                                        <td><?= $row['id'] ?></td>
                                        <input type="hidden" class="pid" value="<?= $row['id'] ?>">
                                        <td><img src="<?= $row['product_image'] ?>" width="50"></td>
                                        <td><?= $row['product_name'] ?></td>
                                        <td>
                                          <i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'],2); ?>
                                        </td>
                                        <input type="hidden" class="pprice" value="<?= $row['product_price'] ?>">
                                        <td>
                                          <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                                        </td>
                                        <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['total_price'],2); ?></td>
                                        <td>
                                          <a href="action2.php?remove=<?= $row['id'] ?>" class="text-danger lead" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                      </tr>
                                      <?php $grand_total += $row['total_price']; ?>
                                    <?php endwhile; ?>
                                    <tr>
                                      <td colspan="3">
                                      </td>
                                      <td colspan="2"><b>Grand Total</b></td>
                                      <td><b><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($grand_total,2); ?></b></td>
                                      
                                    </tr>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>

                        </form>       
                        <tr>
                          <td valign="top"><div align="center">
                            <?php
                            if (isset($_POST['Submit'])) {
                                                if (isset($_POST['ishir'])) {   //ishir Check
                                                  include 'db.php';
                                                  mysql_query("SET CHARACTER SET utf8");
                                                  mysql_query("SET SESSION collation_connection =utf8_general_ci");
                                                  $date = date("d-m-Y");
                                                  echo $date;
                                                  $t = time();
                                                  $stamp = $t + $date;
//$results=mysql_query("INSERT INTO `ticket` (`ticket_type`,`from`,`assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`,`date`,`stamp`,`priority`,`superiors`) VALUES ('".$_POST['type']."', 'agent1', '".$_POST['to']."', '".$_POST['group']."', '".$_POST['cus_phone']."', '".$_POST['cus_name']."',  '".$_POST['account_id']."',  '".$_POST['product']."',  '".$_POST['amount']."',  'New' ,'".$_POST['editor1']."',NOW(),'$stamp','1',(select superior_id from users where id=".$_POST['to']."))");
//$results=mysql_query("INSERT INTO `ticket`.`ticket` (`id`, `ticket_type`, `from`, `assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`) VALUES (NULL, '".$_POST['type']."', '".$agent89."', '".$_POST['to']."', '".$_POST['group']."', '".$_POST['cus_phone']."', '".$_POST['cus_name']."', '".$_POST['account_id']."', '".$_POST['product']."', '".$_POST['amount']."', 'New', '".$_POST['editor1']."', NOW(), '$stamp', '1', (select superior_id from users where id=".$_POST['to']."))");
                                                  $results = mysql_query("INSERT INTO `ticket`.`ticket` (`id`, `another_name`,`ticket_type`, `agent`, `assignd`, `group`, `total_amount`,`periority_type`,`quantity`,`branch_name`,`cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`) VALUES (NULL, '" . $_POST['another_name'] . "','" . $_POST['type'] . "', '" . $agent89 . "', '" . $_POST['to'] . "', '" . $_POST['group'] . "', '" . $_POST['total_amount'] . "','" . $_POST['quantity'] . "','" . $_POST['branch_name'] . "','" . $_POST['periority_type'] . "', '" . $_POST['cus_phone'] . "', '" . $_POST['cus_name'] . "', '" . $_POST['account_id'] . "', '" . $_POST['product'] . "', '" . $_POST['amount'] . "', 'New', '" . $_POST['editor1'] . "', NOW(), '$stamp', '1',CONCAT((select superior_id from users where id=" . $_POST['to'] . "),\"" . $_POST['cc'] . "\"))");


                                                  if ($results) {

//////////////

                                                    $result = mysql_query("SELECT id FROM ticket where stamp= '$stamp' ");



                                                    $id_no = mysql_result($result, 0);

                                                    $flag = '1';
                                                    $Aperson = mysql_fetch_row(mysql_query("select user_name from users where id = " . $_POST['to']));
                                                    echo "<font color='Blue'><h4>New Ticket ID number is $id_no. </h4></font>\n";
                                                    include 'MSdatabase.php';
                                                    /* INsert Into MSSQL DB */

                                                    $fresh_Milk = strip_tags($_POST['editor1']);

                                                    $ULTA = mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, [group],total_amount,quantity, branch_name,periority_type,cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors)           VALUES 
                                                      (
                                                      $id_no, 
                                                      '" . $_POST['type'] . "', 
                                                      '$agent89', 
                                                      '$Aperson[0]',
                                                      '0',
                                                      '" . $_POST['cus_phone'] . "', 
                                                      '" . $_POST['cus_name'] . "', 
                                                      'CUSTOMER ACCOUNT', 
                                                      '" . $_POST['product'] . "', 
                                                      '" . $_POST['amount'] . "', 
                                                      'New', 
                                                      '" . $fresh_Milk . "', 
                                                      GETDATE(), 
                                                      $stamp, 
                                                      '1', 
                                                      'Superiors')");
                                                  }
                                                } else {
                                                  include 'db.php';
                                                  mysql_query("SET CHARACTER SET utf8");
                                                  mysql_query("SET SESSION collation_connection =utf8_general_ci");
                                                  $date = date("d-m-Y");
//echo $date;
                                                  $t = time();
                                                  $stamp = $t + $date;


                                                  $results = mysql_query("INSERT INTO `ticket`.`ticket` (`id`, `another_name`,`ticket_type`, `agent`, `assignd`, `group`,`total_amount`,`quantity`,`branch_name`,`periority_type`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`) VALUES (NULL, '" . $_POST['another_name'] . "','" . $_POST['type'] . "', '" . $agent89 . "', '" . $_POST['to'] . "', '" . $_POST['group'] . "','" . $_POST['total_amount'] . "','" . $_POST['quantity'] . "','" . $_POST['branch_name'] . "','" . $_POST['periority_type'] . "', '" . $_POST['cus_phone'] . "', '" . $_POST['cus_name'] . "', '" . $_POST['account_id'] . "', '" . $_POST['product'] . "', '" . $_POST['amount'] . "', 'New', '" . $_POST['editor1'] . "', NOW(), '$stamp', '1', '" . substr($_POST['cc'], 1) . "')");

//$results=mysql_query("INSERT INTO `ticket` (`ticket_type`,`from`,`assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`,`date`,`stamp`,`priority`,`superiors`) VALUES ('".$_POST['type']."', '"."Hamba Faltu"."', '".$_POST['to']."', '".$_POST['group']."', '".$_POST['cus_phone']."', '".$_POST['cus_name']."',  '".$_POST['account_id']."',  '".$_POST['product']."',  '".$_POST['amount']."',  'New' ,'".$_POST['editor1']."',NOW(),'$stamp','1','')");


                                                  if ($results) {

//////////////

                                                    $result = mysql_query("SELECT id FROM ticket where stamp= '$stamp' ");



                                                    $id_no = mysql_result($result, 0);

                                                    $flag = '1';
                                                    $Aperson = mysql_fetch_row(mysql_query("select user_name from users where id = " . $_POST['to']));
                                                    echo "<font color='Blue'><h4>New Ticket ID number is $id_no. </h4></font>\n";
                                                    include 'MSdatabase.php';
                                                    /* INsert Into MSSQL DB */
                                                    $fresh_Milk = strip_tags($_POST['editor1']);
                                                    $ULTA = mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, [group], total_amount, quantity, branch_name,periority_type,cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors)             VALUES 
                                                      (
                                                      $id_no, 
                                                      '" . $_POST['type'] . "', 
                                                      '$agent89', 
                                                      '$Aperson[0]',
                                                      '0',
                                                      '" . $_POST['cus_phone'] . "', 
                                                      '" . $_POST['cus_name'] . "', 
                                                      'CUSTOMER ACCOUNT', 
                                                      '" . $_POST['product'] . "', 
                                                      '" . $_POST['amount'] . "', 
                                                      'New', 
                                                      '" . $fresh_Milk . "', 
                                                      GETDATE(), 
                                                      $stamp, 
                                                      '1', 
                                                      'Superiors')");
                                                  }
                                                }
                                              }
                                              ?>
                                            &nbsp;</div></td>
                                          </tr>
                                        </table>

                                        <p>&nbsp;</p>
                                      </div>
                                    </body>
                                    </html>


                                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>
                                    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/js/bootstrap.min.js'></script> 
                                    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>  
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>  

                                    <script type="text/javascript">
                                      $(document).ready(function() {



                                        $("#search_text").change(function(){
                                          var search_text = $(this).val();

                                          if(search_text == ""){
                                            $("#filter_data_container").html("");
                                          }else{
                                            $.ajax({
                                              url : "fetch.php",
                                              type : "POST",
                                              data : { search_text : search_text},
                                              success : function(data){
                                                //$("#madeshef").html(data);
                                                $("#filter_data_container").html(data);
                                                //alert(data);
                                              }
                                            });
                                                                                  }
                                                                                })

                                            // Change the item quantity
                                            $(".itemQty").on('change', function() {
                                              var el = $(this).closest('tr');

                                              var pid = el.find(".pid").val();
                                              var pprice = el.find(".pprice").val();
                                              var qty = el.find(".itemQty").val();
                                              //alert(qty+'-'+pprice+'-'+pid);
                                              location.reload(true);
                                              $.ajax({
                                                url: 'action2.php',
                                                method: 'post',
                                                cache: false,
                                                data: {

                                                  qty: qty,
                                                  pid: pid,
                                                  pprice: pprice
                                                },
                                                success: function(response) {
                                                  console.log(response);
                                                  // alert(response);
                                                  //alert(qty+'-'+pprice+'-'+pid);
                                                  
                                                }
                                              });
                                            });

                                            // Load total no.of items added in the cart and display in the navbar
                                            load_cart_item_number();

                                            function load_cart_item_number() {
                                              $.ajax({
                                                url: 'action.php',
                                                method: 'get',
                                                data: {
                                                  cartItem: "cart_item"
                                                },
                                                success: function(response) {
                                                  $("#cart-item").html(response);
                                                }
                                              });
                                            }

                                            //  $(".chosen").chosen();

                                          });




                                      function fetch_branchs(val)
                                      {

                                        $.ajax({
                                          type: 'post',
                                          url: 'fetch_branch.php',
                                          data: {
                                            get_option:val
                                          },
                                          success: function (response) {
                                            document.getElementById("branch_name").innerHTML=response; 

                                          }
                                        });
                                      };
                                    </script>





