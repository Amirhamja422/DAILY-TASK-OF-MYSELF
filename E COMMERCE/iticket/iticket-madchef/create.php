
<?php
session_start();
include 'db.php';
require 'PHPMailer/PHPMailerAutoload.php';
date_default_timezone_set('Asia/Dhaka');
include 'function.php';
?>
<link href="css-new/app.css" rel="stylesheet">
<script src="ck/ckeditor.js"></script>
<?php
$phone = "";
$customer_name = "";
$acc_no = "";
$product_tra = "";
$detail_tra = "";
$address_tra = "";
$msg= "";
// $agent89 = $_SESSION['agent_name'];
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


function sendSMS($phone, $message){ 
  // make sure passed string is url encoded
  $message = rawurlencode($message);
  $username = "kiron1985";
  $password = "Kiron@123";
  $originator = '01844016400';
  
  $url = "http://clients.muthofun.com:8901/esmsgw/sendsms.jsp?user=$username&password=$password&mobiles=$phone&sms=$message&unicode=1";     

  $c = curl_init(); 
  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($c, CURLOPT_URL, $url); 
  $response = curl_exec($c);
  return $response;
}

// function sendSMS($phone, $message){ 
//   $user = "abbl_cc";
//   $pass = "e<48M446";
//   $sid = "ABBLCC";
//   $url="http://sms.sslwireless.com/pushapi/dynamic/server.php";
//   $param="user=$user&pass=$pass&sms[0][0]=88".$phone."&sms[0][1]=".urlencode($message)."&sid=$sid";
  
//   // $url = "http://clients.muthofun.com:8901/esmsgw/sendsms.jsp?user=$username&password=$password&mobiles=$phone&sms=Test&unicode=1";     

//   $crl = curl_init();
//   curl_setopt($crl,CURLOPT_SSL_VERIFYPEER,FALSE);
//   curl_setopt($crl,CURLOPT_SSL_VERIFYHOST,2);
//   curl_setopt($crl,CURLOPT_URL,$url);
//   curl_setopt($crl,CURLOPT_HEADER,0);
//   curl_setopt($crl,CURLOPT_RETURNTRANSFER,1);
//   curl_setopt($crl,CURLOPT_POST,1);
//   curl_setopt($crl,CURLOPT_POSTFIELDS,$param);
//   $response = curl_exec($crl);
//   curl_close($crl);
//   return $response;
//   // print_r($response);
// }

if (isset($_POST['Submit'])) {

    mysql_query("SET CHARACTER SET utf8");
    mysql_query("SET SESSION collation_connection = utf8_general_ci");
    $date = date("d-m-Y");
    $create = date("Y-m-d H:i:s");
    $t = time();
    $stamp = $t + $date;
    $new_name = '';
    if($_POST['account_id'] == ''){$account_id = "Not Applicable";}else{$account_id = $_POST['account_id'];}
    if($_POST['amount'] == ''){$amount = "Not Applicable";}else{$amount = $_POST['amount'];}
    if (!empty($_FILES['attachment']['name'])) {
      $attachment  = $_FILES['attachment'];
      $attach_name = $_FILES['attachment']['name'];
      $attach_tmp  = $_FILES['attachment']['tmp_name'];
      $attach_type = $_FILES['attachment']['type'];
      $temp = explode(".", $attach_name);
      $new_name = $agent89.'_'.round(microtime(true)) . '.' . end($temp);
      move_uploaded_file($attach_tmp, "attcahment/$new_name");
    }

   $create_time = date("H:i:s", strtotime($create));
   $create_date = date("Y-m-d", strtotime($create));
   $create_date_time = $create;

   $currentTime = $create_date_time;   //Current Date time when ticket will create
   $dayStart = '10,00'; //Working Start as bangladesh working time 10am ,00mnt
   $dayEnd = '18,00';  //Working end as bangladesh working time 10am ,00mnt
   $data = mysql_fetch_assoc(mysql_query("SELECT * FROM `sub_group` WHERE `id`='".$_POST['sub_group']."'")); 

   $sla_8 = addRollover($currentTime, 8, $dayStart, $dayEnd, true);
   $sla_total = addRollover($currentTime, ($data['hour_time']/3600), $dayStart, $dayEnd, true);

    $results = mysql_query("INSERT INTO `ticket_dev`.`ticket` (`id`, `sub_group`,`hour_time`, `ticket_type`, `from`, `assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`, `add_phone`, `address`, `nature`, `sla_8`, `total_sla`) VALUES (NULL, '".$_POST['sub_group']."','".$data['hour_time']."', '" . $_POST['type'] . "', '" . $agent89 . "', '" . $_POST['to'] . "', '" . $_POST['group'] . "', '" . $_POST['cus_phone'] . "', '" . $_POST['cus_name'] . "', '" . $account_id . "', '" . $_POST['product'] . "', '" . $amount . "', 'New', '" . addslashes($_POST['editor1']) . "', '".$create."', '$stamp', '".$_POST['priority']."', '" . substr($_POST['cc'], 1) . "', '".$_POST['add_phone']."', '".$_POST['address']."', '".$_POST['nature']."', '".$sla_8->format('Y-m-d H:i:s')."', '".$sla_total->format('Y-m-d H:i:s')."')");

    $id_qry = mysql_fetch_assoc(mysql_query("SELECT * FROM `ticket_dev`.`ticket` WHERE `from` = '".$agent89."' ORDER BY id DESC LIMIT 1"));

    $results1 = mysql_query("INSERT INTO `ticket_dev`.`history` (`id`,`date`,`status`,`from`,`details`, `attachment`) VALUES ('".$id_qry["id"]."',NOW(),'New', '" . $agent89 . "', '" . addslashes($_POST['editor1']) . "', '".$new_name."')");
    $group_ad = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `user_group_id`='".$_POST['group']."' AND `previlege`='2'"));
    echo $list = $_POST['to'].",".$group_ad['id'];
    $user_email = mysql_query("SELECT `user_email`,`user_name` FROM `users` WHERE `id` IN ($list)");
    $result = mysql_query("SELECT id FROM ticket where stamp= '$stamp' ");
    $id_no = mysql_result($result, 0);
    $msg = "<center><font color='Blue'><h3 style=\"font-size: 17px;\">New Ticket ID number is $id_no. </h3></font></center>\n";
    // sendSMS($_POST['cus_phone'], "New Ticket ID number is - ". $id_no);

    if ($results) {

      $mail = new PHPMailer;
      $mail->SMTPDebug = 0;                                 // Enable verbose debug output
      $mail->isHTML(true);                                  // Set email format to HTML
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'host13.registrar-servers.com';          // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'test@ihelpbd.com';             // SMTP username
      $mail->Password = '-&hnqNWIdL8Q';                     // SMTP password   
      $mail->Port = 26;                                    // TCP port to connect to
      $mail->setFrom('test@ihelpbd.com', 'IFIC');   // Sender email address
 
      // while ($row = mysql_fetch_assoc($user_email)) {
      //     $mail->addAddress($row['user_email'], $row['user_name']);
      // }

      // $mail->Subject = "This Is Subject";
      $mail_body = "Your Ticket Id-". $id_qry["id"];
      $mail->Body    =  stripslashes ($mail_body);

      if(!$mail->send()) {
          echo "Not Ok";
      } else {
          // echo "Email Send Successfully!!";
      }

    //   // sendSMS($_POST['cus_phone'], $mail_body);
     

    //   $result = mysql_query("SELECT id FROM ticket where stamp= '$stamp' ");
    //   $id_no = mysql_result($result, 0);

    //   $flag = '1';
    //   $Aperson = mysql_fetch_row(mysql_query("select user_name from users where id = " . $_POST['to']));
    //   $msg = "<center><font color='Blue'><h3>New Ticket ID number is $id_no. </h3></font></center>\n";
    // }
}
}

?>
<script src="js/jquery.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("#tcontent").load("ticket_generation.php").fadeIn("slow");
    $.ajaxSetup({ cache: false });
  });
</script>
<main class="py-4">
  <div class="">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" style="margin-top: -28px;">
          <div class="card-header">
            <div class="col-md-2 text-center" style="float: left;">
              <button class="btn btn-warning btn-sm" id="crt_btn" onclick="location.href='create.php'"><i class="fas fa-plus-square"></i> Create Ticket</button>
            </div>
            
            <div class="col-md-2 text-center" style="float: right;">
              <button class="btn btn-info btn-sm" id="src_btn" onclick="location.href='search_ticket.php'"><i class="fas fa-eye"></i> Search ticket</button>
            </div>

            <div class="col-md-6 col-md-offset-1 text-center" style="margin-left: 171px;">
              <center><?php echo $msg; ?></center>
            </div>
            
          </div> 
          <div class="card-body">
            <div id="create">
              <div class="col-md-12">
                <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                  <div class="col-md-6" style="float: left; padding-top: 10px;">
                    <div class="col-sm-4" style="float: left;">Complain type:<span style="color: red;">*</span></div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="sub_group" id="sub_group" required>
                        <option value="">-Select Complaint Type-</option>
                        <?php
                        $result1 = mysql_query("SELECT * FROM sub_group ORDER BY sub_group_name ASC");
                        while ($row = mysql_fetch_array($result1)) {
                          ?>
                          <option value="<?= $row['id'] ?>">
                            <?= $row['sub_group_name'] ?>
                          </option>
                        <? } ?>
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Service:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="type" id="type" required readonly>
                        <option value="">-Select Issue-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4 control-label" style="float: left;">Department:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="group" id="group" required readonly>
                        <option value="">Select Issue</option>
                        
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Assigned To:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="to" id="to" required>
                        <option value="">-Select A Reciever-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Complaint Nature:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="nature" id="nature" required readonly>
                        <option value="">-Select Issue-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Customer Name: <span style="color: red;">*</span></div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" name="cus_name" id="cus_name" required placeholder="Enter Customer Name" value="<?php print $customer_name; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Account No: <span style="color: red;">*</span></div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" id="account_id" placeholder="Enter Account Number" name="account_id" value="<?php print $acc_no; ?>" >
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Customer Phone Number: <span style="color: red;">*</span></div>
                    <div class="col-sm-8" style="float: left;">
                      <input name="cus_phone" type="text" required class="form-control" required id="cus_phone" placeholder="Enter Phone" value="<?php print $phone; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Card No: <span style="color: red;">*</span></div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Card Number" value="<?php print $address_tra; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Email Address: <span style="color: red;">*</span></div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" name="product" placeholder="Enter email" id="product" value="<?php print $product_tra; ?>">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Add more reciever:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="cclist" id="cclist" onchange="changeText3(this.value)">
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
                      <input type="text" class="form-control" name="cc" placeholder="Enter Other receiver" id="cc">
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Template:</div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="templete" id="templete" onchange="changeText2(this.value)" >
                        <option value="">-Select Template-</option>
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
                    <div class="col-sm-4" style="float: left;">Customer Address:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" id="address" placeholder="Enter Address" name="address" value="<?php print $address; ?>" >
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Priority: <span style="color: red;">*</span></div>
                    <div class="col-sm-8" style="float: left;">
                      <select class="form-control" name="priority" id="priority" required>
                        <option value="">-Select Priority-</option>
                        <option value="1">-General-</option>
                        <option value="2">-Sensitive-</option>
                        <option value="3">-Highly Sensitive-</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6" style="float: left; padding: 10px;">
                    <div class="col-sm-4" style="float: left;">Additional Phone No:</div>
                    <div class="col-sm-8" style="float: left;">
                      <input type="text" class="form-control" name="add_phone" id="add_phone" placeholder="Additional Phone No" value="<?php print $add_phone; ?>">
                    </div>
                  </div>
                  <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">Attachment:</div>
                    <div class="col-sm-10" style="float: left;">
                      <input class="form-control" type="file" name="attachment" id="attachment">
                    </div>
                  </div>
                  <div class="col-md-12" style="float: left; padding: 10px;">
                    <div class="col-sm-2" style="float: left;">Remarks:</div>
                    <div class="col-sm-10" style="float: left;" id="kullu">
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
      </div>
    </div>
  </div>
</main>
<script src="js/new.js"></script>
<script type="text/javascript">

  $('#sub_group').change(function(e){
    var sub_group = $("#sub_group").val();
    $.ajax({
      data: "sub_group="+sub_group,
      url: "kullu/change3.php",
      type: "GET",
      success: function(data){
        document.getElementById("type").innerHTML = data;
      }
    });

    $.ajax({
      data: "sub_group="+sub_group,
      url: "kullu/change2.php",
      type: "GET",
      success: function(data){
        document.getElementById("group").innerHTML = data;
      }
    });

    $.ajax({
      data: "sub_group="+sub_group,
      url: "kullu/change.php",
      type: "GET",
      success: function(data){
        document.getElementById("to").innerHTML = data;
      }
    });

    var issue = $("#sub_group option:selected").text();

    $.ajax({
      data: "sub_group="+issue,
      url: "kullu/sub_change.php",
      type: "GET",
      success: function(data){
        document.getElementById("nature").innerHTML = data;
      }
    }); 
  });


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
<?php include 'footer.php';?>