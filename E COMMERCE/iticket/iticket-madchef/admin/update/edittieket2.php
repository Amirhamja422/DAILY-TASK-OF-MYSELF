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
include '../../db.php';

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
Update <span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> id <?php print $Global_id;?>
</div>



<form action="" method="post">
<input type="hidden" name="q1" value="<?php print $Global_id;?>">


<br>
<table align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">

<tr>
<td>Department</td>
<td>:</td>
<td>
<select name="group" class="form-consex" id="group" required>
                <option value="NO">-Select Department-</option>
				<?php
				$result1 = mysql_query("select id,group_name FROM user_group ");
				while($row=mysql_fetch_array($result1)) { 
				if($row['id']==$data_array[4]) print "<option value=\"".$row['id']."\" selected>".$row['group_name']."</option>";
                else print "<option value=\"".$row['id']."\">".$row['group_name']."</option>";
                } ?>
</select>
</td>

<td>Service</td>
<td>:</td>
<td>
<select name="type" class="form-consex" id="type" required>
                <?php
				$result1 = mysql_query("select type_name,id FROM ticket_type ");
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
<select name="to" class="form-consex" id="to" required>
                <?php
				$result1 = mysql_query("select id,user_name FROM users ORDER BY user_id DESC");
				while($row=mysql_fetch_array($result1)) { 
				if($row['id']==$data_array[3]) {print "<option value=\"".$row['id']."\" selected >".$row['user_name']."</option>";}
				else print "<option value=\"".$row['id']."\">".$row['user_name']."</option>";
                } ?>
</select>
</td>

<td>Product</td>
<td>:</td>
<td><input name="product" type="text" class="form-consex" id="product" readonly value="<?php print $data_array[9];?>"/></td>

</tr>

<tr>
<td>Account Number</td>
<td>:</td>
<td><input name="account_id" type="text" class="form-consex" readonly id="account_id" value="<?php print $data_array[8];?>"/></td>

<td>Card Number</td>
<td>:</td>
<td><input name="amount" type="text" class="form-consex" id="amount" readonly value="<?php print $data_array[10];?>"/></td>
</tr>

<tr>
<td>Customer Phone</td>
<td>:</td>
<td><input name="cus_phone" type="text" class="form-consex" id="cus_phone" readonly value="<?php print $data_array[6];?>"/></td>

<td>Customer Name</td>
<td>:</td>
<td><input name="cus_name" type="text" class="form-consex" id="cus_name" readonly value="<?php print $data_array[7];?>"/></td>
</tr>




<tr>

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
</tr>
<tr> -->

<td>Change Ticket Status</td>
<td>:</td>
<td colspan="4">
	<select name="status" class="form-consex" id="status"  required >
        <option value="">-Select Status-</option>
        <? include 'db.php';
			$result1 = mysql_query("select *FROM ticket_status where status_name NOT LIKE '%New%'  ");
			while($row=mysql_fetch_array($result1)) { ?>
                <option value="<?=$row['status_name']?>">
                <?=$row['status_name']?>
                </option>
         <? } ?>
    </select>
</td>
</tr>

<tr>

<td>Complain Details</td>
<td>:</td>
<td colspan="4">

<textarea class="form-conarea123" id="editor1" name="editor1" rows="4" required><?php print $data_array[12];?></textarea>
<script>CKEDITOR.replace( 'editor1',{uiColor:'#CCCCCC'});CKEDITOR.config.height = 90;</script></td>
</tr>

<tr>

<td>&nbsp;</td>
<td></td>
<td colspan="2">

<!-- <input type="checkbox" name="ishir" id="ishir">
			  <font style="font-weight:bold; color:#000099;">Maintain Hierarchy</font> -->

</td>

<td></td>
<td></td>
</tr>
</table>

<div align="center"><input type="submit" name="NP" id="NP" value="UPDATE" class="su_btn"></div>

</form>


<table align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px;">
  <tr>
    <td valign="top"><strong style="color:#006633">Ticket Cycle </strong></td>
  </tr>
  <tr>
    <td valign="top">	
	<?php 	 include('db.php');  mysql_query("SET CHARACTER SET utf8");     mysql_query("SET SESSION collation_connection =utf8_general_ci"); 	 
	 $result = mysql_query("SELECT * FROM history where id='$Global_id' ORDER BY date ASC ");
	 
     echo "<table  align='center'  class='table table-hover' >
     <tr>
	  <th align='center'>Date</th>
	  <th align='center'>Status</th>
	  <th align='center'>From</th>
	  <th align='center'>Details</th>	 
     </tr>";
while($row = mysql_fetch_array($result))
	{
  echo "<tr style=\"font-size:11px;\">";
  echo "<td >" . $row['date'] . "</td>";
  echo "<td >" . $row['status'] . "</td>";
  echo "<td >" . $row['from'] . "</td>";
  echo "<td >" . $row['details'] . "</td>"; 
  echo "</tr>";
 }
   echo "</table>";
   ?>&nbsp;</td>
  </tr>
  </table>

<!--<div class="close"><a href="#" class="simplemodal-close">x</a></div>-->
<!--<p><button class="simplemodal-close">Close</button> <span>(or press ESC or click the overlay)</span></p>-->


<?php
session_start();
$now_user = $_SESSION['usr01937417227'];
if(isset($_POST['NP']))
{
if(isset($_POST['ishir']))   //ishir Check
		{
		$results=mysql_query("UPDATE `ticket_dev`.`ticket` SET `ticket_type` = '".$_POST['type']."', `assignd` = '".$_POST['to']."', `group` = '".$_POST[	
		'group']."', `cus_contact` = '".$_POST['cus_phone']."',   				
		`cus_name` = '".$_POST['cus_name']."', `cus_ac` = '".$_POST['account_id']."', `cus_product` = '".$_POST['product']."', `cus_amount` = '".	
		$_POST['amount']."', `status` = '".$_POST['status']."', `superiors` = CONCAT((select superior_id from users where id=".$_POST['to']."),\"".	
		$_POST['cc']."\") WHERE `ticket`.`id` = $Global_id");
		
		$results=mysql_query("INSERT INTO `history` (`id`,`status`,`from`, `details`,`date`) VALUES ('$Global_id','".$_POST['status']."', '".$now_user."','".$_POST['editor1']."',NOW() )");
		
		print "<div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#003300\">
		Ticket Updated Successfully.</font></div>";		
		}
		else{                 // Same but no superior
		$results=mysql_query("UPDATE `ticket_dev`.`ticket` SET `ticket_type` = '".$_POST['type']."', `assignd` = '".$_POST['to']."', `group` = '".$_POST[	
		'group']."', `cus_contact` = '".$_POST['cus_phone']."',   				
		`cus_name` = '".$_POST['cus_name']."', `cus_ac` = '".$_POST['account_id']."', `cus_product` = '".$_POST['product']."', `cus_amount` = '".	
		$_POST['amount']."', `status` = '".$_POST['status']."', `superiors` = '".substr($_POST['cc'], 1)."' WHERE `ticket`.`id` = $Global_id");
		
		$results=mysql_query("INSERT INTO `history` (`id`,`status`,`from`, `details`,`date`) VALUES ('$Global_id','".$_POST['status']."', '".$now_user."','".$_POST['editor1']."',NOW() )");
		
		print "<div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#003300\">
		Ticket Updated Successfully.</font></div>";
		}
}
?>
<script src="../../js/new.js"></script>
<script type="text/javascript">
	$('#group').change(function(e){
		var id = $("#group").val();
		alert("ok");
		$.ajax({
			data: "id="+id,
			url: "../../kullu/change2.php",
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
			url: "../../kullu/change3.php",
			type: "GET",
			success: function(data){
				document.getElementById("sub_group").innerHTML = data;
			}
		});
		
		$.ajax({
			data: "id="+id+"&type_id="+type_id,
			url: "../../kullu/change.php",
			type: "GET",
			success: function(data){
				document.getElementById("to").innerHTML = data;
			}
		});
	});
</script>