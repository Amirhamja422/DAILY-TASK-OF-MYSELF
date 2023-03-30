<script src="../ck/ckeditor.js"></script>
<script type="text/javascript">
function changeText3(str){
document.getElementById('cc').value=document.getElementById('cc').value+","+document.getElementById('cclist').value;
}
</script>
<style type="text/css">
.brand {
font-family: Georgia, "Times New Roman", Times, serif;
font-style: oblique; font-weight: bolder; font-size: 30px;
color:#333333;
font-weight:bolder;
}
.form-consex{
width:190px !important;
height:30px;
border:1px solid #999999;
border-radius:3px;
padding-left:5px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
font-weight:bolder;
}
.form-consex:focus{
box-shadow: 0px 0px 8px #04124D;
}
.form-conarea{
width:100% !important;
border:1px solid #999999;
border-radius:3px;
padding-left:5px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:10px;
font-weight:bolder;
}
.form-conarea:focus{
box-shadow: 0px 0px 8px #04124D;
}
.su_btn{
border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;
}
.su_btn:hover{
background-color:#6666FF;
}
</style>


<?php
include '../db.php';

if(isset($_POST['NP']))
{
$results=mysql_query("SELECT * FROM ticket where id=".$_POST['q1']);
$data_array=mysql_fetch_row($results);
$Global_id=$_POST['q1'];
}
else
{
$results=mysql_query("SELECT * FROM ticket where id=".$_GET['q1']);
$data_array=mysql_fetch_row($results);
$Global_id=$_GET['q1'];
}
?>

<div align="center" style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bolder;">
View <span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> id <?php print $Global_id;?>
</div>



<form action="" method="post" enctype="multipart/form-data">
<input type="hidden" name="q1" value="<?php print $Global_id;?>">


<br>
<table align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">

<tr>
<td>Department</td>
<td>:</td>
<td>
<select name="group" class="form-consex" id="group" required disabled>
<!-- <option value="NO">-Select Department-</option> -->
<?php
$result1 = mysql_query("select id,group_name FROM user_group where `id`='".$data_array[4]."'");
while($row=mysql_fetch_array($result1)) { 
if($row['id']==$data_array[4]) print "<option value=\"".$row['id']."\" selected>".$row['group_name']."</option>";
else print "<option value=\"".$row['id']."\">".$row['group_name']."</option>";
} ?>
</select>
</td>

<td>Service</td>
<td>:</td>
<td>
<select name="type" class="form-consex" id="type" required disabled>
<?php
$result1 = mysql_query("select type_name,id FROM ticket_type where `group_id`='".$data_array[4]."'");
while($row=mysql_fetch_array($result1)) { 
if($row['id']==$data_array[1]) print "<option value=\"".$row['id']."\" selected>".$row['type_name']."</option>";
else print "<option value=\"".$row['id']."\">".$row['type_name']."</option>";
} ?>
</select></td>
</tr>

<tr>
<td>Assigned To</td>
<td>:</td>
<td>
<select name="to" class="form-consex" id="to" required disabled>
<?php
$result1 = mysql_query("select id,user_name FROM users where `user_group_id` LIKE '%".$data_array[4]."%' ORDER BY user_id DESC");
while($row=mysql_fetch_array($result1)) { 
if($row['id']==$data_array[3]) {print "<option value=\"".$row['id']."\" selected >".$row['user_name']."</option>";}
else print "<option value=\"".$row['id']."\">".$row['user_name']."</option>";
} ?>
</select>
</td>

<td>Complaint Type</td>
<td>:</td>
<td>
<select name="sub_group" class="form-consex" id="sub_group" required disabled>
<?php
$result1 = mysql_query("select * FROM  sub_group where `user_group_id`='".$data_array[4]."' ORDER BY sub_group_name DESC");
while($row=mysql_fetch_array($result1)) { 
if($row['id']==$data_array[5]) {print "<option value=\"".$row['id']."\" selected >".$row['sub_group_name']."</option>";}
else print "<option value=\"".$row['id']."\">".$row['sub_group_name']."</option>";
} ?>
</select>
</td>

</tr>

<tr>
<td>Card Number</td>
<td>:</td>
<td><input name="account_id" type="text" class="form-consex" disabled id="account_id" value="<?php print $data_array[8];?>"/></td>

<td>Account Number</td>
<td>:</td>
<td><input name="amount" type="text" class="form-consex" id="amount" disabled value="<?php print $data_array[10];?>"/></td>
</tr>

<tr>
<td>Customer Phone</td>
<td>:</td>
<td><input name="cus_phone" type="text" class="form-consex" id="cus_phone" disabled value="<?php print $data_array[6];?>"/></td>

<td>Customer Name</td>
<td>:</td>
<td><input name="cus_name" type="text" class="form-consex" id="cus_name" disabled value="<?php print $data_array[7];?>"/></td>
</tr>



<tr>
<td>Priority</td>
<td>:</td>
<td>
<select class="form-consex" name="priority" id="priority" disabled>
    <option value="">-Select Priority-</option>
    <option value="1" <?php if($data_array[15] == '1'){echo "selected";}?> >-General-</option>
    <option value="2" <?php if($data_array[15] == '2'){echo "selected";}?> >-Sensitive-</option>
    <option value="3" <?php if($data_array[15] == '3'){echo "selected";}?> >-Highly Sensitive-</option>
</select>
</td>

<td>Additional Phone NO</td>
<td>:</td>
<td><input name="add_phone" type="text" class="form-consex" disabled id="add_phone" value="<?php print $data_array[19];?>"/></td>
</tr>

<tr>
<td>Nature</td>
<td>:</td>
<td><input name="nature" type="text" class="form-consex" id="nature" disabled value="<?php print $data_array[20];?>"/></td>

<td>Address</td>
<td>:</td>
<td><input name="address" type="text" class="form-consex" id="address" disabled value="<?php print $data_array[21];?>"/></td>
</tr>


<!-- <tr>
<td>Add More Recipient</td>
<td>:</td>
<td>
<select name="cclist" class="form-consex" id="cclist" onchange="changeText3(this.value)">
                <option value="NO">-Select Reciever-</option>
                <?php
                $result1 = mysql_query("select id,user_name FROM users ORDER BY user_id DESC");
                while($row=mysql_fetch_array($result1)) { 
                print "<option value=\"".$row['id']."\">".$row['user_name']."</option>";
                } ?>
</select></td>

<td>Other Receiver</td>
<td>:</td>
<td><input name="cc" type="text" class="form-consex" id="cc" placeholder="More Recipient(s)"/></td>
</tr> -->
<tr>

<td>Change Ticket Status</td>
<td>:</td>
<td>
    <select name="status" class="form-consex" id="status" required disabled>
        <option value="">-Select Status-</option>
        <? include 'db.php';
            $result1 = mysql_query("SELECT * FROM `ticket_dev`.`ticket_status` WHERE `status_name` = 'Closed' ORDER BY `status_name` ASC");
            while($row=mysql_fetch_array($result1)) { ?>
                <option value="<?=$row['status_name']?>" <?php if($row['status_name'] == $data_array[11]){echo "Selected";}?> >
                <?=$row['status_name']?>
                </option>
         <? } ?>
    </select>
</td>

<td>Email</td> 
<td>:</td>
<td><input name="product" type="text" class="form-consex" id="product" disabled value="<?php print $data_array[9];?>"/></td>
</tr>

<!-- <tr>
<td>Attachment</td>
<td>:</td>
<td style="height: 33px; color: red;"><input name="attachment" type="file"/></td>
</tr> -->

<!-- <tr>
<td>Remarks</td>
<td>:</td>
<td colspan="4">

<textarea class="form-conarea123" id="editor1" name="editor1" rows="4" required></textarea>
<script>CKEDITOR.replace( 'editor1',{uiColor:'#CCCCCC'});CKEDITOR.config.height = 90;</script></td>
</tr> -->

<tr>

<td>&nbsp;</td>
<td></td>
<td colspan="2">
</td>

<td></td>
<td></td>
</tr>
</table>

<!-- <div align="center"><input type="submit" name="NP" id="NP" value="UPDATE" class="su_btn"></div> -->

</form>

<style>
    #customers {
      font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #customers td, #customers th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #4CAF50;
      color: white;
    }
</style>

<table align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; width: 100%;" id="customers">
  <tr>
    <td valign="top"><strong style="color:#006633; margin-left: 336px;">Ticket Cycle </strong></td>
  </tr>
  <tr>
    <td valign="top">   
    <?php    include('db.php');  mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci");    
     $result = mysql_query("SELECT * FROM history where id='$Global_id' ORDER BY date ASC ");
     
     echo "<table  align='center' class='table table-hover' >
     <tr>
      <th align='center'>Date</th>
      <th align='center'>Status</th>
      <th align='center'>From</th>
      <th align='center'>Details</th>    
      <th align='center'>Attachment</th>     
     </tr>";
while($row = mysql_fetch_array($result))
    {

    $user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$row['from']."'"));
  echo "<tr style=\"font-size:11px;\">";
  echo "<td >" . $row['date'] . "</td>";
  echo "<td >" . $row['status'] . "</td>";
  echo "<td >" . $user['user_name'] . "</td>";
  echo "<td >" . $row['details'] . "</td>"; 
  if(!empty($row['attachment'])){ echo "<td style=\"height: 33px; color: red;\"><b><a href=\"../attcahment/".$row['attachment']."\" download>Download</a></b></td>";}
  echo "</tr>";
 }
   echo "</table>";
   ?>&nbsp;</td>
  </tr>
  </table>
