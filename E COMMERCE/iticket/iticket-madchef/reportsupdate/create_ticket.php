
<?php
session_start();
include '../db.php';
include 'header.php';?>
<script src="../ck/ckeditor.js"></script>
<?php
if (isset($_POST['Submit'])) {
  if (isset($_POST['ishir'])) {
    mysql_query("SET CHARACTER SET utf8");
    mysql_query("SET SESSION collation_connection =utf8_general_ci");
    $date = date("d-m-Y");
    echo $date;
    $t = time();
    $stamp = $t + $date;
    //$results=mysql_query("INSERT INTO `ticket` (`ticket_type`,`from`,`assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`,`date`,`stamp`,`priority`,`superiors`) VALUES ('".$_POST['type']."', 'agent1', '".$_POST['to']."', '".$_POST['group']."', '".$_POST['cus_phone']."', '".$_POST['cus_name']."',  '".$_POST['account_id']."',  '".$_POST['product']."',  '".$_POST['amount']."',  'New' ,'".$_POST['editor1']."',NOW(),'$stamp','1',(select superior_id from users where id=".$_POST['to']."))");

    //$results=mysql_query("INSERT INTO `ticket`.`ticket` (`id`, `ticket_type`, `from`, `assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`) VALUES (NULL, '".$_POST['type']."', '".$agent89."', '".$_POST['to']."', '".$_POST['group']."', '".$_POST['cus_phone']."', '".$_POST['cus_name']."', '".$_POST['account_id']."', '".$_POST['product']."', '".$_POST['amount']."', 'New', '".$_POST['editor1']."', NOW(), '$stamp', '1', (select superior_id from users where id=".$_POST['to']."))");

    $data = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$_POST['type']."'"));

    $results = mysql_query("INSERT INTO `ticket_dev`.`ticket` (`id`, `sub_group`,`hour_time`, `ticket_type`, `from`, `assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`) VALUES (NULL, '".$_POST['sub_group']."','".$data['hour_time']."','" . $_POST['type'] . "', '" . $agent89 . "', '" . $_POST['to'] . "', '" . $_POST['group'] . "', '" . $_POST['cus_phone'] . "', '" . $_POST['cus_name'] . "', '" . $_POST['account_id'] . "', '" . $_POST['product'] . "', '" . $_POST['amount'] . "', 'New', '" . $_POST['editor1'] . "', NOW(), '$stamp', '1',CONCAT((select superior_id from users where id=" . $_POST['to'] . "),\"" . $_POST['cc'] . "\"))");


    $id_qry = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE `from` = '".$agent89."' ORDER BY id DESC LIMIT 1"));

    $results1 = mysql_query("INSERT INTO `ticket_dev`.`history` (`id`,`date`,`status`,`from`,`details`) VALUES ('".$id_qry["id"]."',NOW(),'New', '" . $agent89 . "', '" . $_POST['editor1'] . "')");


    if ($results) {
      $result = mysql_query("SELECT id FROM ticket where stamp= '$stamp' ");
      $id_no = mysql_result($result, 0);

      $flag = '1';
      $Aperson = mysql_fetch_row(mysql_query("select user_name from users where id = " . $_POST['to']));
      echo "<font color='Blue'><h4>New Ticket ID number is $id_no. </h4></font>\n";
      include 'MSdatabase.php';
      /* INsert Into MSSQL DB */

      $fresh_Milk = strip_tags($_POST['editor1']);

      $ULTA = mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, [group], cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors)          VALUES 
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
  }else {
    mysql_query("SET CHARACTER SET utf8");
    mysql_query("SET SESSION collation_connection = utf8_general_ci");
    $date = date("d-m-Y");
    //echo $date;
    $t = time();
    $stamp = $t + $date;
    $data = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_type` WHERE `id`='".$_POST['type']."'"));

    $results = mysql_query("INSERT INTO `ticket_dev`.`ticket` (`id`, `sub_group`,`hour_time`, `ticket_type`, `from`, `assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`) VALUES (NULL, '".$_POST['sub_group']."','".$data['hour_time']."', '" . $_POST['type'] . "', '" . $agent89 . "', '" . $_POST['to'] . "', '" . $_POST['group'] . "', '" . $_POST['cus_phone'] . "', '" . $_POST['cus_name'] . "', '" . $_POST['account_id'] . "', '" . $_POST['product'] . "', '" . $_POST['amount'] . "', 'New', '" . $_POST['editor1'] . "', NOW(), '$stamp', '1', '" . substr($_POST['cc'], 1) . "')");

    // $results1 = mysql_query("INSERT INTO `ticket`.`history` (`id`, `from`,`status`, `details`, `date`) VALUES ("1000", '" . $agent89 . "', 'New', '" . $_POST['editor1'] . "', NOW()");

    $id_qry = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE `from` = '".$agent89."' ORDER BY id DESC LIMIT 1"));

    $results1 = mysql_query("INSERT INTO `ticket_dev`.`history` (`id`,`date`,`status`,`from`,`details`) VALUES ('".$id_qry["id"]."',NOW(),'New', '" . $agent89 . "', '" . $_POST['editor1'] . "')");
    //$results=mysql_query("INSERT INTO `ticket` (`ticket_type`,`from`,`assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`,`date`,`stamp`,`priority`,`superiors`) VALUES ('".$_POST['type']."', '"."Hamba Faltu"."', '".$_POST['to']."', '".$_POST['group']."', '".$_POST['cus_phone']."', '".$_POST['cus_name']."',  '".$_POST['account_id']."',  '".$_POST['product']."',  '".$_POST['amount']."',  'New' ,'".$_POST['editor1']."',NOW(),'$stamp','1','')");


    if ($results) {
      $result = mysql_query("SELECT id FROM ticket where stamp= '$stamp' ");
      $id_no = mysql_result($result, 0);

      $flag = '1';
      $Aperson = mysql_fetch_row(mysql_query("select user_name from users where id = " . $_POST['to']));
      echo "<font color='Blue'><h4>New Ticket ID number is $id_no. </h4></font>\n";
      include 'MSdatabase.php';
      /* INsert Into MSSQL DB */
      $fresh_Milk = strip_tags($_POST['editor1']);
      $ULTA = mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, [group], cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors)          VALUES 
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
<script type="text/javascript">
  $(document).ready(function(){
    $("#tcontent").load("ticket_generation.php").fadeIn("slow");
    $.ajaxSetup({ cache: false });
  });
</script>
<main class="py-4">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <div class="col-md-2 text-center" style="float: left;">
              <button class="btn btn-warning" id="crt_btn" onclick="location.href='create_ticket.php'"><i class="fas fa-plus-square"></i> Create Ticket</button>
            </div>
            <div class="col-md-2 text-center" style="float: right;">
              <button class="btn btn-success text-white">
                New Ticket <span class="badge"><?php
                include 'db.php';
                mysql_query("SET CHARACTER SET utf8");
                mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
                $results9=mysql_query("SELECT COUNT(status) FROM  `ticket` WHERE  `status` =  'New'");
                $count = mysql_fetch_array($results9);
                echo $count[0];
                ?></span>
              </button>
            </div>
            <div class="col-md-2 text-center" style="float: right;">
              <button class="btn btn-info" id="src_btn" onclick="location.href='search_ticket.php'"><i class="fas fa-eye"></i> Search ticket</button>
            </div>
            
          </div>
          <div class="card-body">
            <div id="create">
              <div class="col-md-12">
                <form class="form-horizontal" action="#" >
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4 control-label" style="float: left;">Department:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="group" id="group">
                        <option>Select Department</option>
                        <?php
                        $result1 = mysql_query("select *FROM user_group ORDER BY group_name ASC");
                        while ($row = mysql_fetch_array($result1)) {
                          ?>
                          <option value="<?= $row['id'] ?>">
                            <?= $row['group_name'] ?>
                          </option>
                        <? } ?>
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Service:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="type" id="type">
                        <option>-Select Service-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Assigned To:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="to" id="to">
                        <option>-Select A Reciever-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Issue:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="sub_group" id="sub_group">
                        <option>-Select an issue-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Account:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="number" class="form-control" id="account_id" placeholder="Enter Account Number" name="account_id" value="<?php print $acc_no; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Customer Phone:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input name="cus_phone" type="text" class="form-control" id="cus_phone" placeholder="Enter email" value="<?php print $phone; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Card/CIF:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" id="amount" name="amount"placeholder="Enter CIF/Card Number" value="<?php print $address_tra; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Email Address:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" name="product" placeholder="Enter email" id="product" value="<?php print $product_tra; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Add more reciever:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="cclist" id="cclist">
                        <option value="NO">-Select Reciever-</option>
                        <?php
                        $sql = mysql_query("SELECT * FROM `users` WHERE `previlege`!='0' AND `previlege`!='2'");
                        while ($row = mysql_fetch_row($sql)) {
                          ?>
                          <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Other reciever:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="email" class="form-control" name="cc" placeholder="Enter Other receiver email" id="cc">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Message:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="templete" id="templete">
                        <option>-Select Message-</option>
                        <?php
                        $result1 = mysql_query("select * FROM template ORDER BY title ASC");
                        while ($row = mysql_fetch_array($result1)) {
                          ?>
                          <option value="<?= $row[0] ?>">
                            <?= $row[1] ?>
                          </option>
                        <? } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Customer Name:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" name="cus_name" id="cus_name" placeholder="Enter Customer Name" value="<?php print $customer_name; ?>">
                    </div>
                  </div>
                  <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">Attachment:</div>
                    <div class="col-sm-10" style="float: left;">
                      <input class="form-control" type="file" name="attachment" id="attachment">
                    </div>
                  </div>
                  <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">Tamplates:</div>
                    <div class="col-sm-10" style="float: left;">
                      <textarea class="form-control" id="editor1" name="editor1" style="color: black; " rows="4" required><?php print $detail_tra; ?></textarea>
                      <script>
                        CKEDITOR.replace('editor1');
                        CKEDITOR.config.height = 90;
                      </script>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left; visibility: hidden;">Button</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="submit" name="Submit" value="Create" class="btn btn-success">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>


        <div class="card">
          <div class="card-header">Ticket</div>
          <div class="card-body">
            <table class="table table-bordered" id="tcontent" style="font-size: 12px;"></table>
          </div>
        </div>


      </div>
    </div>
  </div>
</main>
<script src="../js/new.js"></script>
<script type="text/javascript">
  $('#group').change(function(e){
    var id = $("#group").val();

    $.ajax({
      data: "id="+id,
      url: "../kullu/change2.php",
      type: "GET",
      success: function(data){
        document.getElementById("type").innerHTML = data;
      }
    });                                
  });

  $('#type').change(function(e){
    var id = $("#group").val();
    var type_id = $("#type").val();

    $.ajax({
      data: "id="+id+"&type="+type_id,
      url: "../kullu/change3.php",
      type: "GET",
      success: function(data){
        document.getElementById("sub_group").innerHTML = data;
      }
    });

    $.ajax({
      data: "id="+id+"&type_id="+type_id,
      url: "../kullu/change.php",
      type: "GET",
      success: function(data){
        document.getElementById("to").innerHTML = data;
      }
    });
  });
</script>
<?php include 'footer.php';?>