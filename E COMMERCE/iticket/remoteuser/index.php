<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/tcal.css" />
  <script language="javascript" type="text/javascript" src="css/tcal.js"></script>	
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>. : i Tracker : : .</title>
  <style> 
    div.container {
      width: 70%;
      height: 580px;
      -moz-box-shadow: 1px 3px 26px 9px #888888;
      -webkit-box-shadow: 1px 3px 26px 9px #888888;
      box-shadow: 1px 3px 26px 9px #888888;
    }
    body {
     //background-image: url(r2.jpg);
   }
 </style>
</head>
<?php include'session.php'; ?>
<?php $who= $_GET['i'];?>
<?php
include '../db.php';
//$user =3;
//mysql_query("SET CHARACTER SET utf8");
//mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
//$results9=mysql_query("SELECT COUNT(status) FROM  `ticket` WHERE  `status` =  'New' AND assigned='$who'");
//$count = mysql_fetch_array($results9);
//echo $count[0];
?>
<body background="../admin/<?php include '../bg.php';?>">
  <p>&nbsp;</p>
  <div class="container" style="background:#CCCCCC; border-radius:15px;">
    <p>&nbsp;</p>
    <table width="100%" height="440" border="0" align="center" class="">
      <tr>
        <td width="655" valign="top"><?php include'menu.php';?>&nbsp;
        </td>
      </tr>
      <tr>
        <td height="66" valign="top"><table width="644" border="0" align="center">
          <tr>
            <td width="638" valign="top"><form id="form1" name="form1" method="post" action="">
              <table width="638" border="0">
                <tr>
                  <td colspan="6" align="center" >
                   Start Date &nbsp;
                   <input type="text" id="idate" name="idate" class="tcal" value="<?php echo date("Y-m-d"); ?>" required>
                   End Date &nbsp;
                   <input type="text" id="edate" name="edate" class="tcal" value="<?php echo date("Y-m-d"); ?>" required>



                 </td>
               </tr>
               <tr>
                <td>Status</td>
                <td><select name="status" class="form-control" id="status" >
                  <option value="">-Select Status-</option>
                <? //include 'db.php';
                $result1 = mysql_query("select *FROM ticket_status ");
                while($row=mysql_fetch_array($result1)) { ?>
                  <option value="<?=$row['status_name']?>">
                    <?=$row['status_name']?>
                  </option>
                <? } ?>
              </select></td>
              <td><input type="submit" name="Submit" value="Submit" class="btn btn-primary btn-sm"/>
                <input name="my" type="submit" class="btn btn-warning btn-sm" id="my" value="My Ticket"/>	 <input name="my1" type="submit" class="btn btn-warning btn-sm" id="my" value="All Ticket" style="
                margin-left: 141px;
                float: left;
                margin-top: -29px;
                ">  			</td>
                <td>Type</td>
                <td><select name="type" class="form-control" id="type" >
                  <option value="">-Select Type-</option>
                <? //include 'db.php';
                $result11 = mysql_query("select *FROM ticket_type ");
                while($row=mysql_fetch_array($result11)) { ?>
                  <option value="<?=$row['type_name']?>">
                    <?=$row['type_name']?>
                  </option>
                <? } ?>
              </select></td>
              <td><input type="submit" name="Submit3" value="Submit" class="btn btn-primary btn-sm"/></td>
            </tr>
            <tr>
              <td width="45">Search</td>
              <td width="139"><select name="search" class="form-control" id="search">
                <option>--Select--</option>
                <option value="id">Ticket ID</option>
                <option value="cus_contact">Phone</option>
                <option value="cus_ac">Order ID</option>
                  <!-- <option value="cus_product">Product</option>			
                    <option value="ticket_type">Type</option> -->	  
                    <option value="cus_amount">Address</option>
                  </select></td>
                  <td width="193">
                   <div align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:9px;">
                   ( Empty Value Return's All )			  </div>			  </td>
                   <td width="35">Value</td>
                   <td width="144"><input name="value" type="text" class="form-control" id="value"/></td>
                   <td width="56"><input type="submit" name="Submit2" value="Submit" class="btn btn-primary btn-sm"/></td>
                 </tr>
               </table>
             </form>        </td>
           </tr>

         </table></td>
       </tr>
       <tr>
        <td height="345" valign="top">&nbsp;
          <div style="overflow:auto;  height: 305px; "  >
            <?php

            if(isset($_POST['Submit']))
            {
//include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['status'];


              $idate 	= $_POST['idate'];
              $edate 	= $_POST['edate'];
              $results1=mysql_query("SELECT * FROM ticket where status='".$in."' and ( `group`=(select CAST(user_group_id as CHAR(50)) from users where id= ".$who.") or FIND_IN_SET(".$who.",`superiors`) or assignd='".$who."' ) and date > '$idate 00:00:00' and date < '$edate 23:59:59'");





//$results1=mysql_query("SELECT * FROM ticket where status='$in' and (assignd='$who' || `group`=(select user_group_id from users where id='$who') || FIND_IN_SET('".$who."', superiors) > 0))");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>
              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>Check</th>



              </tr>";


              while($row = mysql_fetch_array($results1))
              {

                echo "<tr>";
                echo "<td >" . $row['id'] . "</td>";
                echo "<td >" . $row['date'] . "</td>";  
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>"; 
  //echo "<td >"<a href=followup.php?id='9900'>Check </a>"</td>"; 
   // echo "<td >"<a href='followup.php' >".$row['id']. Check</a>"</td>";
                echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='.$_GET['i'].' ">Check</div></td>'; 
//echo '<td ><<a href=followup.php?id='. $row['id'] .'>Check </a></td>';
              }
              echo "</table>";

            }
////////////////////////////////


            if(isset($_POST['my']))
            {
              include '../db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['status'];

// Last Edited --- SELECT * FROM `ticket` where (FIND_IN_SET($who,`superiors`) || assignd='$who') &&  `group`=(select user_group_id from users where id=$who)

              $idate 	= $_POST['idate'];
              $edate 	= $_POST['edate'];
              $results1=mysql_query("SELECT * FROM ticket where ( `group`=(select CAST(user_group_id as CHAR(50)) from users where id= ".$who.") or FIND_IN_SET(".$who.",`superiors`) or assignd='".$who."'  ) and date > '$idate 00:00:00' and date < '$edate 23:59:59'");



// $results1=mysql_query("SELECT * FROM ticket where  date > '$idate 00:00:00' and date < '$edate 23:59:59'");




//SELECT * FROM ticket where assignd=3 || `group`=(select user_group_id from users where id=3)

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>
              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>Check</th>



              </tr>";


              while($row = mysql_fetch_array($results1))
              {

                echo "<tr>";
                echo "<td >" . $row['id'] . "</td>";
                echo "<td >" . $row['date'] . "</td>";  
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>"; 
  //echo "<td >"<a href=followup.php?id='9900'>Check </a>"</td>"; 
   // echo "<td >"<a href='followup.php' >".$row['id']. Check</a>"</td>";
                echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='.$_GET['i'].' ">Check</div></td>'; 
//echo '<td ><<a href=followup.php?id='. $row['id'] .'>Check </a></td>';
              }
              echo "</table>";

            }
            if(isset($_POST['my1']))
            {
              include '../db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['status'];

// Last Edited --- SELECT * FROM `ticket` where (FIND_IN_SET($who,`superiors`) || assignd='$who') &&  `group`=(select user_group_id from users where id=$who)

              $idate  = $_POST['idate'];
              $edate  = $_POST['edate'];
              $results1=mysql_query("SELECT * FROM ticket where  date > '$idate 00:00:00' and date < '$edate 23:59:59'");



// $results1=mysql_query("SELECT * FROM ticket where  date > '$idate 00:00:00' and date < '$edate 23:59:59'");




//SELECT * FROM ticket where assignd=3 || `group`=(select user_group_id from users where id=3)

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>
              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>Check</th>



              </tr>";


              while($row = mysql_fetch_array($results1))
              {

                echo "<tr>";
                echo "<td >" . $row['id'] . "</td>";
                echo "<td >" . $row['date'] . "</td>";  
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>"; 
  //echo "<td >"<a href=followup.php?id='9900'>Check </a>"</td>"; 
   // echo "<td >"<a href='followup.php' >".$row['id']. Check</a>"</td>";
                echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='.$_GET['i'].' ">Check</div></td>'; 
//echo '<td ><<a href=followup.php?id='. $row['id'] .'>Check </a></td>';
              }
              echo "</table>";

            }

/////////////////////////////////
            if(isset($_POST['Submit3']))
            {
//include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in=$_POST['type'];
              $idate 	= $_POST['idate'];
              $edate 	= $_POST['edate'];
              $results1=mysql_query("SELECT * FROM ticket where `ticket_type`='".$in."' and ( `group`=(select CAST(user_group_id as CHAR(50)) from users where id= ".$who.") or FIND_IN_SET(".$who.",`superiors`) or assignd='".$who."' ) and date > '$idate 00:00:00' and date < '$edate 23:59:59'");






//$results1=mysql_query("SELECT * FROM ticket where ticket_type='$in'  AND (assignd='$who' || `group`=(select user_group_id from users where id='$who') || FIND_IN_SET('".$who."', superiors) > 0))  ");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>Check</th>


              </tr>";


              while($row = mysql_fetch_array($results1))
              {

                echo "<tr>";
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>"; 
                echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='.$_GET['i'].' ">Check</div></td>'; 

              }
              echo "</table>";

            }
/////////////////////////////

            if(isset($_POST['Submit2']))
            {
//include 'db.php';
              mysql_query("SET CHARACTER SET utf8");
              mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
              $in2=$_POST['search'];
              $value=$_POST['value'];
//echo $in2;
//echo $value;
              $idate 	= $_POST['idate'];
              $edate 	= $_POST['edate'];

              
              $results1=mysql_query("SELECT * FROM ticket where ".$in2." ='".$value."' and  date > '$idate 00:00:00' and date < '$edate 23:59:59'");



              // $results1=mysql_query("SELECT * FROM ticket where ".$in2." like '%".$value."%' and ( `group`=(select CAST(user_group_id as CHAR(50)) from users where id= ".$who.") or FIND_IN_SET(".$who.",`superiors`) or assignd='".$who."' ) and date > '$idate 00:00:00' and date < '$edate 23:59:59'");






//$results1=mysql_query("SELECT * FROM ticket where  $in2='$value' AND (assignd='$who' || `group`=(select user_group_id from users where id='$who') || FIND_IN_SET('".$who."', superiors) > 0)) ");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>Check</th>


              </tr>";


              while($row = mysql_fetch_array($results1))
              {

                echo "<tr>";
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>";
                echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='.$_GET['i'].' ">Check</div></td>'; 

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

              $results1=mysql_query("SELECT * FROM ticket where  ");

              echo "<table  align='center' class='table table-hover' id='one-column-emphasis' >
              <tr>

              <th align='center'>ID</th>
              <th align='center'>Opening date</th>
              <th align='center'>Status</th>
              <th align='center'>Type</th>
              <th align='center'>Check</th>


              </tr>";


              while($row = mysql_fetch_array($results1))
              {

                echo "<tr>";
                echo "<td >" . $row['id'] . "</td>"; 
                echo "<td >" . $row['date'] . "</td>"; 
                echo "<td >" . $row['status'] . "</td>"; 
                echo "<td >" . $row['ticket_type'] . "</td>"; 
                echo '<td ><div align="center"> <a href="followup.php?id='. $row['id'] .'&i='.$_GET['i'].' ">Check</div></td>'; 

              }
              echo "</table>";

            }

////////////////////////

            ?>
          </div></td>
        </tr>
      </table>
    </div>

    <?php include '../footer.php';?>
  </body>
  </html>
