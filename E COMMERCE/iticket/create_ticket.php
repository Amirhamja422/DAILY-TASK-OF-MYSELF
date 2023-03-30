<?php 
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
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




                        <div class="container" style="background:#CCCCCC; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">

                            <!--    <div align="left" style="color:#0000FF;" id="dishow">&nbsp;</div> -->
                            <table width="581" height="98" border="0" align="center">
                                <tr>
                                    <td width="575" valign="top"><?php include'menu.php'; ?>
                                        &nbsp;</td>
                                </tr>
                                <tr>
                                    <td valign="top"><form id="form1" name="form1" method="post" action="">
                                            <table width="626" height="220" border="0">
                                                <tr>
                                                    <td width="138" height="38" valign="top">To</td>
                                                    <td width="156" valign="top">
                                                        <select name="to" class="form-control" id="to" onchange="Hamba_Java(this.value);" required>

                                                            <option value="">-Select Reciever-</option>
                                                            <?
                                                            include 'db.php';
                                                            $result1 = mysql_query("select *FROM users order by user_name  DESC");
                                                            while ($row = mysql_fetch_array($result1)) {
                                                                ?>
                                                                <option value="<?= $row['id'] ?>">
                                                                    <?= $row['user_name'] ?>
                                                                </option>
                                                            <? } ?>
                                                        </select></td>
                                                    <td width="10" valign="top">&nbsp;</td>
                                                    <td width="151" valign="top">Group</td>
                                                    <td width="149" valign="top"><select name="group" class="form-control" id="group">
                                                            <option value="NO">-Select Group-</option>
                                                            <?
                                                            include 'db.php';
                                                            $result1 = mysql_query("select *FROM user_group ");
                                                            while ($row = mysql_fetch_array($result1)) {
                                                                ?>
                                                                <option value="<?= $row['id'] ?>">
                                                                    <?= $row['group_name'] ?>
                                                                </option>
                                                            <? } ?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td height="36" valign="top">Subject/Title</td>
                                                    <td valign="top"><select name="type" class="form-control" id="type" required="required">
                                                            <option value="">-Select Type-</option>
                                                            <?
                                                            include 'db.php';
                                                            $result1 = mysql_query("select *FROM ticket_type ");
                                                            while ($row = mysql_fetch_array($result1)) {
                                                                ?>
                                                                <option value="<?= $row['type_name'] ?>">
                                                                    <?= $row['type_name'] ?>
                                                                </option>
                                                            <? } ?>
                                                        </select></td>
                                                    <td valign="top">&nbsp;</td>
                                                    <td valign="top">Customer Name </td>
                                                    <td valign="top"><input name="cus_name" type="text" class="form-control" id="cus_name" value="<?php print $customer_name; ?>"/></td>
                                                </tr>
                                                <tr>
                                                     <td height="41" valign="top">User ID</td>
                                                    <td valign="top"><input name="account_id" type="text" class="form-control" id="account_id" value="<?php print $acc_no; ?>"/></td>
                                                    <td valign="top">&nbsp;</td>
                                                     <td valign="top">Customer Phone</td>
                                                    <td valign="top"><input name="cus_phone" type="text" class="form-control" id="cus_phone" value="<?php print $phone; ?>" required/></td>
                                                </tr>
                                                <tr>
                                                    <td height="39" valign="top">Customer Type</td>
                                                    <td valign="top"><input name="amount" type="text" class="form-control" id="amount" value="<?php print $address_tra; ?>"/></td>
                                                    <td valign="top">&nbsp;</td>
                                                    <td valign="top">Engaged ID</td>
                                                    <td valign="top"><input name="product" type="text" class="form-control" id="product"/></td>
                                                </tr>

                                                <tr>
                                                    <td height="26" valign="top">Add more reciever </td>
                                                    <td valign="top"><select name="cclist" class="form-control" id="cclist" onchange="changeText3(this.value)">
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
                                                    <td valign="top"><input name="cc" type="text" class="form-control" id="cc"/></td>
                                                </tr>
                                                <tr>
                                                    <td height="26" valign="top">Select Tamplate:</td>
                                                    <td valign="top">
                                                        <select name="templete" class="form-control" id="templete" onchange="changeText2(this.value)">
                                                            <!--<option value="">-Select massage-</option>-->
                                                            <?
                                                            include 'db.php';
                                                            $result1 = mysql_query("select * FROM template");
                                                            while ($row = mysql_fetch_array($result1)) {
                                                                ?>
                                                                <option value="<?= $row[0] ?>">
                                                                    <?= $row[1] ?>
                                                                </option>
                                                            <? } ?>
                                                        </select>
                                                    </td>
                                                    <td valign="top">&nbsp;</td>
                                                    <td valign="top">Another Field: </td>
                                                    <td valign="top"><input name="another_name" type="text" class="form-control" id="another_name"/></td>

                                                </tr>
                                                <tr>
                                                    <td valign="top">&nbsp;</td>
                                                    <td valign="top">&nbsp;</td>
                                                    <td valign="top">&nbsp;</td>
                                                    <td valign="top"><div align="right">
                                                            <input type="submit" name="Submit" value="Create" class="btn btn-primary btn-sm"/>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div align="left" style="margin-top:-10px;">Tamplates</div>

                                            <div id="kullu"><textarea class="form-control" id="editor1" name="editor1" rows="4" required> <?php print $detail_tra; ?>
			
                                                </textarea></div>


                                            <script>
                                                CKEDITOR.replace('editor1');
                                                CKEDITOR.config.height = 90;
                                            </script>


                                            </p>
                                        </form>        </td>
                                </tr>
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
                                                    $results = mysql_query("INSERT INTO `ticket`.`ticket` (`id`, `another_name`,`ticket_type`, `from`, `assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`) VALUES (NULL, '" . $_POST['another_name'] . "','" . $_POST['type'] . "', '" . $agent89 . "', '" . $_POST['to'] . "', '" . $_POST['group'] . "', '" . $_POST['cus_phone'] . "', '" . $_POST['cus_name'] . "', '" . $_POST['account_id'] . "', '" . $_POST['product'] . "', '" . $_POST['amount'] . "', 'New', '" . $_POST['editor1'] . "', NOW(), '$stamp', '1',CONCAT((select superior_id from users where id=" . $_POST['to'] . "),\"" . $_POST['cc'] . "\"))");


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

                                                        $ULTA = mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, [group], cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors) 			VALUES 
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


                                                    $results = mysql_query("INSERT INTO `ticket`.`ticket` (`id`, `another_name`,`ticket_type`, `from`, `assignd`, `group`, `cus_contact`, `cus_name`, `cus_ac`, `cus_product`, `cus_amount`, `status`, `details`, `date`, `stamp`, `priority`, `superiors`) VALUES (NULL, '" . $_POST['another_name'] . "','" . $_POST['type'] . "', '" . $agent89 . "', '" . $_POST['to'] . "', '" . $_POST['group'] . "', '" . $_POST['cus_phone'] . "', '" . $_POST['cus_name'] . "', '" . $_POST['account_id'] . "', '" . $_POST['product'] . "', '" . $_POST['amount'] . "', 'New', '" . $_POST['editor1'] . "', NOW(), '$stamp', '1', '" . substr($_POST['cc'], 1) . "')");

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
                                                        $ULTA = mssql_query("INSERT INTO tblComplain (id, ticket_type, [from], assignd, [group], cus_contact, cus_name, cus_ac, cus_product, cus_amount, staus, details, date, stamp, priority, superiors) 			VALUES 
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
