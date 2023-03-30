<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <script src="ck/ckeditor.js"></script>
  <script type="text/javascript">
    function changeText2(str){
      if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
     document.getElementById('kullu').innerHTML = "<textarea class=\"form-control\" id=\"editor1\" name=\"editor1\" rows=\"4\" required>"+xmlhttp.responseText+"</textarea>";
     CKEDITOR.replace('editor1');
     CKEDITOR.config.height = 90;
   }
 }
 xmlhttp.open("GET","tem.php?q="+str,true);
 xmlhttp.send();
}
</script>
<style> 
  div.container {
    width: 70%;
    height: 580px;
    -moz-box-shadow: 1px 3px 26px 9px #888888;
    -webkit-box-shadow: 1px 3px 26px 9px #888888;
    box-shadow: 1px 3px 26px 9px #888888;
  }
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>. : : i Ticket : : .</title>
<style type="text/css">
  <!--
  body {
   //background-image: url(r2.jpg);
   //background-repeat: repeat;
 }
 -->
</style></head>
<?php include'session.php'; ?>
<body background="../admin/<?php include '../bg.php';?>">
  <?php include'session.php'; ?>
  <p>&nbsp;</p>
  <div class="container" style="background:#FFFFFF; border-radius:15px;">

    <p>&nbsp;</p>
    <table width="100%" height="98" border="0" align="center">
      <tr>
        <td width="575" valign="top"><?php include'menu.php';?>
      &nbsp;</td>
    </tr>
    <tr>
      <td valign="top"><form id="form1" name="form1" method="post" action="">
        <table width="626" height="192" border="0">
          <tr>
             <td width="143" valign="top">Department</td>
              <td width="149" valign="top"><select name="group" class="form-control" id="group">
                <option value="NO">-Select department-</option>
                <? //include 'db.php';
                $result1 = mysql_query("select *FROM user_group ");
                while($row=mysql_fetch_array($result1)) { ?>
                  <option value="<?=$row['id']?>">
                    <?=$row['group_name']?>
                  </option>
                <? } ?>
              </select></td>

           

          <!--   <td width="138" height="38" valign="top">To</td>
            <td width="161" valign="top"><select name="to" class="form-control" id="to" required>
              <option value="">-Select Reciever-</option>
                <? //include 'db.php';
                $result1 = mysql_query("select *FROM users ");                                           ///////////// TO IS NOT REQUIRED FOR THIS TICKET 
                while($row=mysql_fetch_array($result1)) { ?>
                  <option value="<?=$row['id']?>">
                    <?=$row['user_name']?>
                  </option>
                <? } ?>
              </select></td>   -->




              <td valign="top">&nbsp;</td>
              <td valign="top">Customer Name </td>
              <td valign="top"><input name="cus_name" type="text" class="form-control" id="cus_name"/></td>
            </tr>
            <tr>
              <td height="36" valign="top">Service</td>
              <td valign="top"><select name="type" class="form-control" id="type" onchange="fetch_select(this.value);" required="required">
                <option value="">-Select Type-</option>
                <? //include 'db.php';
                $result1 = mysql_query("select *FROM ticket_type ");
                while($row=mysql_fetch_array($result1)) { ?>
                  <option value="<?=$row['type_name']?>">
                    <?=$row['type_name']?>
                  </option>
                <? } ?>
              </select></td>
              <td width="10" valign="top">&nbsp;</td>
              <td width="151" valign="top">Issue type</td>
              <td valign="top">
                <select name="issue_type" id="issue_type" class="form-control input" >


                                                    </select></td>
            </tr>


            <tr>
                 
               <td height="41" valign="top">Order ID</td>
              <td valign="top"><input name="account_id" type="text" class="form-control" id="account_id"/></td>
              <td valign="top">&nbsp;</td>

              <td width="138" height="38" valign="top">Order Status</td>
              <td valign="top"><select name="order_status" class="form-control" id="order_status" required="required">
                <option value="">-Select status-</option>
                <?
                include 'db.php';
                $result1 = mysql_query("select *FROM  order_status ");
                while ($row = mysql_fetch_array($result1)) {
                  ?>
                  <option value="<?= $row['order_status'] ?>">
                    <?= $row['order_status'] ?>
                  </option>
                <? } ?>
              </select></td>

             

              
            </tr>

            <tr>
              <td height="41" valign="top">KAM Manager</td>
              <td valign="top"><input name="camp_manager" type="text" class="form-control" id="camp_manager"/></td>
              <td valign="top">&nbsp;</td>
              <td valign="top">Customer Mobile No</td>
              <td valign="top"><input name="cus_phone" type="text" class="form-control" id="cus_phone"/></td>
            </tr>
            <tr>
              <td height="39" valign="top">Product Name</td>
              <td valign="top"><input name="amount" type="text" class="form-control" id="amount"/></td>
              <td valign="top">&nbsp;</td>
              <td valign="top">Reg No</td>
              <td valign="top"><input name="product" type="text" class="form-control" id="product"/></td>
            </tr>

            <tr>
              <td height="26" valign="top">Template</td>
              <td valign="top"><select name="templete" class="form-control" id="templete" onchange="changeText2(this.value)">
                <option value="">-Select massage-</option>
                <? //include 'db.php';
                $result1 = mysql_query("select * FROM template");
                while($row=mysql_fetch_array($result1)) { ?>
                  <option value="<?=$row[0]?>">
                    <?=$row[1]?>
                  </option>
                <? } ?>
              </select></td>

               
              <td valign="top">&nbsp;</td>
               <td height="26" valign="top">Priority </td>
              <td valign="top"><select name="periority_type" class="form-control" id="periority_type">
               <option value="">-Select Periority-</option>
               <?
               include 'db.php';
               $result1 = mysql_query("select *FROM  periority_type ");
               while ($row = mysql_fetch_array($result1)) {
                ?>
                <option value="<?= $row['periority _type'] ?>">
                  <?= $row['periority _type'] ?>
                </option>
              <? } ?>
              </select></td> 


            </tr>
                     
              <td valign="top">&nbsp;</td>
              <td valign="top">&nbsp;</td>
              <td valign="top"><div align="left">
               
              </div></td>       

              
              <td valign="top">&nbsp;</td>
              <td valign="top"><div align="right">
                <input type="submit" name="Submit" value="Create" class="btn btn-primary btn-sm"/>
              </div></td>

            <tr>
              

            </tr>
          </table>
          <div align="left" style="margin-top:-10px;">Details</div>

          <div id="kullu"><textarea class="form-control" id="editor1" name="editor1" rows="4" required>

          </textarea></div>


          <script>
            CKEDITOR.replace( 'editor1');
            CKEDITOR.config.height = 90;
          </script>


        </p>
      </form>        </td>
    </tr>
    <tr>
      <td valign="top"><div align="center">
        <?php	
        if(isset($_POST['Submit']))
        {

//$input=$_POST['myInput'];
//$key='qJB0rGtIn5UB1xG03efyCp';


//encryptIt( $str,$key );
//cus_phone

//include 'db.php';  

     // from $row222[0]

          mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
          $date = date("d-m-Y");
          $t=time();
          $stamp=$t+$date;
          $results=mysql_query("INSERT INTO `ticket` (`ticket_type`, `group`, `order_status`,`issue_type`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`,`date`,`stamp`,`priority`,`camp_manager`, `periority_type`) VALUES ('".$_POST['type']."', '".$_POST['group']."','" . $_POST['order_status'] . "','" . $_POST['issue_type'] . "', '".$_POST['cus_phone']."', '".$_POST['cus_name']."',  '".$_POST['account_id']."',  '".$_POST['product']."',  '".$_POST['amount']."',  'New' ,'".$_POST['editor1']."',NOW(),'$stamp','1','".$_POST['camp_manager']."','".$_POST['periority_type']."' )");

          if ($results) {

//////////////

            $result = mysql_query("SELECT id FROM ticket where stamp= '$stamp' ");

//echo 'Your Registration id is ';echo 

            $id_no=mysql_result($result,0);

            $flag='1';



//echo "$id_no";

////////////alert('{$Text}');

/*echo "<script type='text/javascript'>alert('Congratulation, you have successfully registered !!! your id no is {$id_no},password{$pass} please keep your ID number.  ');</script>";
*/

//echo"$new_file_name";

//echo"$new_file_name2";

//echo "<font color='blue'><h6>Please check your mail to active this account</h3></font>\n";

echo "<font color='Blue'><h4>New Ticket ID number is $id_no. </h4></font>\n";

//echo " <h3> <script type='text/javascript'>alert('New ticket id no is $id_no !!! ');</script></h3>";
}


}
?>
&nbsp;</div></td>
</tr>
</table>

<p>&nbsp;</p>
</div>
<?php include '../footer.php';?>
</body>
</html>




                        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 

                        <script type="text/javascript">

                           

                            function fetch_select(val)
                            {

                                $.ajax({
                                    type: 'post',
                                    url: 'fetch_service.php',
                                    data: {
                                        get_option:val
                                    },
                                    success: function (response) {
                                        document.getElementById("issue_type").innerHTML=response; 
                                    }
                                });
                            };

                        </script>