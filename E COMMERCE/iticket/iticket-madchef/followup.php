<?php
session_start();
include 'db.php';
// include 'header.php';?>
<link href="css-new/app.css" rel="stylesheet">
<script src="../ck/ckeditor.js"></script>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<main class="py-4">
  <div class="">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card" style="margin-top: -28px;">
          <div class="card-header">
            <div class="col-md-2 text-center" style="float: left;">
              <a href="create.php"><button class="btn btn-warning btn-sm" id="crt_btn"><i class="fas fa-plus-square"></i> Create Ticket</button></a>
            </div>
            <div class="col-md-2 text-center" style="float: right;">
              <a href="search_ticket.php"><button class="btn btn-info btn-sm" id="src_btn" ><i class="fas fa-eye"></i> Search ticket</button></a>
            </div>
          </div>
          <div class="card-body">
            <table width="700" height="98" border="0" align="center">
              <tr>
                <td width="700" valign="top">
                  <?php 
                  $rcv= $_GET["id"] ;
                  include 'db.php';
                  mysql_query("SET CHARACTER SET utf8");
                  mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
                  $results2=mysql_query("SELECT *  FROM ticket WHERE id='$rcv'");
                  while($row1 = mysql_fetch_array($results2))
                  {
                   $id=   $row1['id']  ; 
                   $from=   $row1['from']  ; 
                   $to=   $row1['assignd']  ; 
                   $group=   $row1['group']  ; 
                   $type=   $row1['ticket_type']  ; 
                   $date=   $row1['date']  ; 
                   $status=   $row1['status']  ; 
                   $details=   $row1['details']  ; 
                   $cus_name=   $row1['cus_name']  ; 
                   $cus_phone=   $row1['cus_contact']  ; 
                   $cus_id=   $row1['cus_ac']  ; 
                   $product=   $row1['cus_product']  ; 
                   $amount=   $row1['cus_amount']  ; 
                   $sub_group=   $row1['sub_group']  ; 
                   $superiors=   $row1['superiors']  ; 
                   $attachment=   $row1['attachment']  ; 
/////////////////////////////////////////////////////////////////////////
                   $results3=mysql_query("SELECT * FROM users WHERE id='$to'");
                   while($row2 = mysql_fetch_array($results3))
                   {
                    $to1=   $row2['user_name']  ;
    //echo $to1;
                  }
////////////////////////////////////////////////////////////////////

 ///////////////////////////////////////////////////////////////////
                  if($group=="NO") 
                  {
                   $group1="NO";
                 }
                 else
                 {
                   $results4=mysql_query("SELECT * FROM user_group WHERE id='$group'");
                   while($row4 = mysql_fetch_array($results4))
                   {
                    $group1=   $row4['group_name']  ;
    //echo $to1;
                  }
                }

                if ($row1[15] == 1) {
                  $priority = "General";
                } elseif ($row1[15] == 2) {
                  $priority = "Sensitive";
                } elseif ($row1[15] == 3) {
                  $priority = "Highly Sensitive";
                }
                $service=mysql_fetch_array(mysql_query("SELECT * FROM ticket_type WHERE id='$type'"));
                $issue=mysql_fetch_array(mysql_query("SELECT * FROM sub_group WHERE id='$sub_group'"));
 ////////////////////////////////////////////////////////////////////
              }
              ?>  
              <br><strong style="color:#006633">Ticket Field Definations</strong>
            </td>
          </tr>
          <tr>
            <td valign="top"><table width="90%" border="0">
              <tr>
                <td width="250" valign="top">Ticket ID :</td>
                <td width="300" valign="top"><?php echo $id; ?>&nbsp;</td>
                <td width="250" valign="top">Name :</td>
                <td width="300" valign="top"><?php echo $cus_name; ?></td>
              </tr>
              <tr>
                <td valign="top">From :</td>
                <td valign="top"><?php echo $from; ?></td>
                <td valign="top">Phone No:</td>
                <td valign="top"><?php echo $cus_phone; ?></td>
              </tr>
              <tr>
                <td valign="top">To :</td>
                <td valign="top"><?php echo $to1; ?></td>
                <td valign="top">Card No :</td>
                <td valign="top"><?php echo $amount; ?></td>
              </tr>
              <tr>
                <td valign="top">Department :</td>
                <td valign="top"><?php echo $group1; ?></td>
                <td valign="top">Account No :</td>
                <td valign="top"><?php echo $cus_id; ?></td>
              </tr>
              <tr>
                <td valign="top">Service :</td>
                <td valign="top"><?php echo $service['type_name']; ?></td>
                <td valign="top">Other Receivers :</td>
                <td valign="top">
                  <?php
                  $users = mysql_query("SELECT * FROM `users` WHERE `id` IN (".ltrim($superiors, ',').")");
                  while ($name = mysql_fetch_array($users)) { 
                    echo $name['user_name'].", "; 
                  }
                  ?>
                </td>
              </tr>
              <tr>
                <td valign="top">Complaint Type :</td>
                <td valign="top"><?php echo $issue['sub_group_name']; ?></td>
                <td valign="top">Status :</td>
                <td valign="top"><?php echo $status; ?></td>
              </tr>
              <tr>
        <!-- <td valign="top">Card No :</td>
          <td valign="top"><?php echo $amount; ?></td> -->

        </tr>
        <tr>
          <td valign="top">Date :</td>
          <td valign="top"><?php echo $date; ?></td>
          <td valign="top">Priority :</td>
          <td valign="top"><?php echo $priority; ?></td>
        </tr>

<!--       <tr>
        <td valign="top">Download :</td>
        <td style="height: 33px; color: red;"><b><a href="attcahment/<?php echo $attachment; ?>" download>Download Attachment</a></b></td>
      </tr> -->
    </table></td>
  </tr>
  <tr>
    <td valign="top"><form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" align="left">
      </table>
    </form></td>
  </tr>
  <tr>
    <td valign="top"><strong style="color:#006633">Ticket Cycle </strong></td>
  </tr>
  <tr>
    <td valign="top">

      <?php    include('db.php');  mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 



      $result = mysql_query("SELECT * FROM history where id='$rcv' ORDER BY date ASC ");

      echo "<table  align='center'  class='table table-hover' >
      <tr>
      <th align='center'>Date</th>
      <th align='center'>Status</th>
      <th align='center'>From</th>
      <th align='center'>Details</th>
      <th align='center'>Attachment</th>
      </tr>";


      while($row = mysql_fetch_array($result))
      {

        $user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` where id='".$row['from']."'"));

        echo "<tr style=\"font-size:10px;\">";

        echo "<td >" . $row['date'] . "</td>";
        echo "<td >" . $row['status'] . "</td>";
        echo "<td >" . $user['user_name'] . "</td>";
        echo "<td >" . $row['details'] . "</td>";
        if(!empty($row['attachment'])){ echo "<td style=\"height: 33px; color: red;\"><b><a href=\"attcahment/".$row['attachment']."\" download>Download</a></b></td>";}
        echo "</tr>";
      }
      echo "</table>";
      ?>&nbsp;</td>
    </tr>
    <tr>
      <td valign="top">      </td>
    </tr>
    <tr>
      <td valign="top"><script>
        CKEDITOR.replace( 'editor1');
        CKEDITOR.config.height = 90;
      </script>
    &nbsp;</td>
  </tr>
  <tr>


    <td valign="top">&nbsp;</td>
  </tr>
</table>
</div>
</div>
</div>
</div>
</main>
<script src="../js/new.js"></script>
<?php include 'footer.php';?>