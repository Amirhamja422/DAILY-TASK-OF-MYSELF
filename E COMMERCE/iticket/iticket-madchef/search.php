<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script language="javascript" type="text/javascript" src="supernova_dipu/tcal.js"></script>
  <link rel="stylesheet" type="text/css" href="supernova_dipu/tcal.css" />
  <title>. : : i Tracker : : .</title>
  <style> 
    div.container {
      width: 100%;

      //-moz-box-shadow: 1px 3px 26px 9px #888888;
      //-webkit-box-shadow: 1px 3px 26px 9px #888888;
      //box-shadow: 1px 3px 26px 9px #888888;
    }
    body {
     //background-image: url(r2.jpg);
   }
 </style>
</head>
<body background="admin/<?php include 'bg.php';?>">
  <div class="container" style="background:#CCCCCC; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px; ">

    <table width="519" height="440" border="0" align="center" class="">
      <tr>
        <td valign="top"><?php include'menu.php';?>&nbsp;</td>
      </tr>
      <tr>
        <td height="66" valign="top">
          <table width="100%" border="0" align="center">
            <tr>
              <td width="662" valign="top">
                <form id="form1" name="form1" method="post" action="">
                  <table width="100%" border="0">
                    <tr style="font-size:9px;">
                      <td >
                        Start Date
                      </td>
                      <td colspan="2"> 
                        <input type="text" id="idate" name="idate" class="tcal" value="<?php echo date("Y-m-d"); ?>" required>

                        <input type="text" name="ihour" value="00" class="chotoTime" required>:
                        <input type="text" name="imin" value="00" class="chotoTime" required>:
                        <input type="text" name="isec" value="00" class="chotoTime" required>	
                      </td>	  
                      <td align="right">
                        End Date
                      </td>
                      <td colspan="2">
                        <input type="text" id="edate" name="edate" class="tcal" value="<?php echo date("Y-m-d"); ?>" required>

                        <input type="text" name="ehour" value="23" class="chotoTime" required>:
                        <input type="text" name="emin" value="59" class="chotoTime" required>:
                        <input type="text" name="esec" value="59" class="chotoTime" required>
                      </td>
                    </tr>
                    <tr>
                      <td colspan="6">&nbsp;</td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>
                        <select name="status" class="form-control" id="status" >
                          <option value="">-Select Status-</option>
                          <option value="New">New</option>
                          <? include 'db.php';
                          $result1 = mysql_query("select *FROM ticket_status ");
                          while($row=mysql_fetch_array($result1)) { ?>
                            <option value="<?=$row['status_name']?>">
                              <?=$row['status_name']?>
                            </option>
                          <? } ?>
                        </select>
                      </td>
                      <td>
                        <input type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm"/>
                        <input name="all" type="submit" class="btn btn-success btn-sm" id="all" value="All"/>
                      </td>
                      <td align="right">Type</td>
                      <td>
                        <select name="type" class="form-control" id="type" >
                          <option value="">-Select Type-</option>
                          <? include 'db.php';
                          $result11 = mysql_query("select *FROM ticket_type ");
                          while($row=mysql_fetch_array($result11)) { ?>
                            <option value="<?=$row['type_name']?>">
                              <?=$row['type_name']?>
                            </option>
                          <? } ?>
                        </select>
                      </td>
                      <td>
                        <input type="submit" name="Submit3" value="Submit" class="btn btn-primary btn-sm" />
                      </td>
                    </tr>
                    <tr>
                      <td width="48">Search</td>
                      <td width="119">
                        <select name="search" class="form-control" id="search">
                          <option>--Select--</option>
                          <option value="id">Ticket ID</option>
                          <option value="cus_contact">Phone</option>
                          <option value="cus_ac">Account Number</option>
                          <option value="cus_amount">Card Number</option>
                          <!-- <option value="cus_product">Product</option>			
                            <option value="ticket_type">Type</option>  -->
                        </select>
                      </td>
                      <td width="111" align="center" style="font-size:8px;">( Empty Value Return's All )</td>
                      <td width="51" align="right">Value</td>
                      <td width="144">
                        <input name="value" type="text" class="form-control" id="value"/>
                      </td>
                      <td width="56">
                        <input type="submit" name="Submit2" value="Submit" class="btn btn-primary btn-sm" />
                      </td>
                    </tr>
                  </table>
                </form>
              </td>
            </tr>

          </table>
        </td>
      </tr>
      <tr>
        <td height="345" valign="top">&nbsp;
          <div style="overflow-x:hidden; overflow-y:hidden;  height: auto; font-size:10px; "  >
            <?php

            if(isset($_POST['Submit'])){
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['status'];

              $results1=mysql_query("SELECT * FROM ticket where status='$in' and date >= '".$_POST['idate']." ".$_POST['ihour'].":".$_POST['imin'].":".$_POST['isec']."' and date < '".$_POST['edate']." ".$_POST['ehour'].":".$_POST['emin'].":".$_POST['esec']."'");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>
              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>SLA (Hours)</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>SLA</th>
              <!-- <th align='center'>Email</th>	--> 
              <th align='center'>Check</th>
              <th align='center'>SMS</th>
              </tr>";


              while($row = mysql_fetch_array($results1)){

                $create = strtotime($row['date']);
                $today = strtotime(date('Y-m-d H:i:s'));
                $calculation = $today - $create;

                $exit = $row['hour_time'];

                if (($calculation > $exit) && ($row['status'] != 'Solve')) { 
                  $res = "Time Over Not Solve"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solve')){
                  $res = "Time Over And Solve"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solve'){
                  $res = "Solve On Time"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "On Process"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }


                echo $tr;
                echo "<td >" . $row['id'] . "</td>";
                echo "<td >" . $row['date'] . "</td>";  
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>";
                echo "<td >" . $res . "</td>"; 
            // echo "<td >" . "<a href=\"sms_kobla_baba_mona_kobi_vabi_Gudi_begum.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";


            // echo "<td ><a href=\"reminder.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a></td>"; 
            // echo "<td >"<a href='followup.php' >".$row['id']. Check</a>"</td>";
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";
            //echo '<td ><<a href=followup.php?id='. $row['id'] .'>Check </a></td>';
              }
              echo "</table>";

            }

        /////////////////////////////////
            if(isset($_POST['Submit3'])){
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['type'];

              $results1=mysql_query("SELECT * FROM ticket where ticket_type='$in' and date >= '".$_POST['idate']." ".$_POST['ihour'].":".$_POST['imin'].":".$_POST['isec']."' and date < '".$_POST['edate']." ".$_POST['ehour'].":".$_POST['emin'].":".$_POST['esec']."'");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>SLA</th>
              <!-- <th align='center'>Email</th>	-->
              <th align='center'>Check</th>
              <th align='center'>SMS</th>
              </tr>";


              while($row = mysql_fetch_array($results1)){

                $create = strtotime($row['date']);
                $today = strtotime(date('Y-m-d H:i:s'));
                $calculation = $today - $create;

                $exit = $row['hour_time'];

                if (($calculation > $exit) && ($row['status'] != 'Solve')) { 
                  $res = "Time Over Not Solve"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solve')){
                  $res = "Time Over And Solve"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solve'){
                  $res = "Solve On Time"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "On Process"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }

                echo $tr;
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>"; 
                echo "<td >" . $calculation . "</td>"; 
            // echo "<td >" . "<a href=\"sms_kobla_baba_mona_kobi_vabi_Gudi_begum.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";


            // echo "<td ><a href=\"reminder.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a></td>"; 
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";
              }
              echo "</table>";

            }
        /////////////////////////////

            if(isset($_POST['Submit2'])){
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in2=$_POST['search'];
              $value=$_POST['value'];
          //echo $in2;
          //echo $value;

              $results1=mysql_query("SELECT * FROM ticket where $in2 like '%$value%' ");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>SLA</th>
              <!-- <th align='center'>Email</th>	--> 
              <th align='center'>Check</th>
              <th align='center'>SMS</th>
              </tr>";


              while($row = mysql_fetch_array($results1)){

                $create = strtotime($row['date']);
                $today = strtotime(date('Y-m-d H:i:s'));
                $calculation = $today - $create;

                $exit = $row['hour_time'];

                if (($calculation > $exit) && ($row['status'] != 'Solve')) { 
                  $res = "Time Over Not Solve"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solve')){
                  $res = "Time Over And Solve"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solve'){
                  $res = "Solve On Time"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "On Process"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }

                echo $tr;
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>";
                echo "<td >" . $res . "</td>";
             // echo "<td >" . "<a href=\"sms_kobla_baba_mona_kobi_vabi_Gudi_begum.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";

             // echo "<td ><a href=\"reminder.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a></td>";  
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";
              }
              echo "</table>";

            }
        //////////////////////////////////

            if(isset($_POST['all']))
            {
              include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['type'];

              $results1=mysql_query("SELECT * FROM ticket  where date >= '".$_POST['idate']." ".$_POST['ihour'].":".$_POST['imin'].":".$_POST['isec']."' and date < '".$_POST['edate']." ".$_POST['ehour'].":".$_POST['emin'].":".$_POST['esec']."'");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>SLA</th>
              <!-- <th align='center'>Email</th>	--> 
              <th align='center'>Check</th>
              <th align='center'>SMS</th>
              </tr>";


              while($row = mysql_fetch_array($results1)){

                $create = strtotime($row['date']);
                $today = strtotime(date('Y-m-d H:i:s'));
                $calculation = $today - $create;

                $exit = $row['hour_time'];

                if (($calculation > $exit) && ($row['status'] != 'Solve')) { 
                  $res = "Time Over Not Solve"; 
                  $tr  = "<tr style=\"background-color: #F9245E;\">";
                } else if(($calculation > $exit) && ($row['status'] == 'Solve')){
                  $res = "Time Over And Solve"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                } else if($row['status'] == 'Solve'){
                  $res = "Solve On Time"; 
                  $tr  = "<tr style=\"background-color: #789CFA;\">";
                }
                else { 
                  $res = "On Process"; 
                  $tr  = "<tr style=\"background-color: #CCCCCC;\">";
                }

                echo $tr;
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>"; 
                echo "<td >" . $res . "</td>"; 
            // echo "<td >" . "<a href=\"sms_kobla_baba_mona_kobi_vabi_Gudi_begum.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a>" . "</td>";

            // echo "<td ><a href=\"reminder.php?to=".$row['cus_contact']."&tid=".$row['id']."&cname=".$row['cus_name']."&cproduct=".$row['cus_product']."&address=".$row['cus_amount']."\">Send</a></td>"; 
                echo '<td ><div align=""> <a href="followup.php?id='. $row['id'] .' ">Check</div></td>'; 
                echo "<td >" . "<a href=\"sms.php?to=".$row['cus_contact']."&ticket_id=".$row['id']."\">Send</a>" . "</td>";
              }
              echo "</table>";
            }
        ////////////////////////

            ?>
          </div>
        </td>
      </tr>
    </table>
  </div>
</body>
</html>
