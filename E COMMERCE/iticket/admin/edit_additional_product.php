<link href="bootstrap.min.css" rel="stylesheet">
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>
<link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />
<style type="text/css">
	.brand {
		font-family: Georgia, "Times New Roman", Times, serif;
		font-style: oblique; font-weight: bolder; font-size: 36px;
		color:#333333;
		font-weight:bolder;
		//position:absolute;
		//left:10px;
		//bottom:30px;
		//text-shadow:1px 0px 5px #000000;
	}
</style>
<?php
include '../db.php';

if(isset($_POST['NP']))
{
	$results=mysql_query("SELECT * FROM add_ons where id=".$_POST['q1']);
	$data_array=mysql_fetch_row($results);
	$Global_id=$_POST['q1'];
}
else
{
	$results=mysql_query("SELECT * FROM add_ons where id=".$_GET['q1']);
	$data_array=mysql_fetch_row($results);
	$Global_id=$_GET['q1'];
}
?>
<div align="center" style="font-size:24px; font-family:Verdana, Arial, Helvetica, sans-serif; font-weight:bolder;">
	Update &nbsp;&nbsp;&nbsp;<span class="brand"><span style="color:#FF0000;">i</span>Ticket</span> &nbsp;&nbsp;&nbsp;Product Details
</div>
<form action="edit_additional_product.php" method="post" id="form">
	<input type="hidden" name="q1" value="<?php print $Global_id;?>">
	<table align="center" style="color:#000000; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
		<tr>
			<td align="right">Product Name :</td>
			<td><input type="text" name="uname"   placeholder="New Price" class="form-control" value="<?php print $data_array[1];?>" readonly></td>
		</tr>
		<tr>
			<td align="right">New Price :</td>
			<td><input type="text" name="price" placeholder="New Price" class="form-control" value="<?php print $data_array[2];?>"></td>
		</tr>
		<tr>
			<td align="right">New Size :</td>
			<td><input type="text" name="designa" placeholder="New Size" class="form-control" value="<?php print $data_array[4];?>"></td>
		</tr>
		<tr>
			<?php $vat = $data_array[10]; ?>
			<td align="right">New VAT % :</td>
			<td><input class="form-control" style="width: 200px;" name="sd" type="text" id="type" value="<?php print $vat;?>"  placeholder="New VAT %" /></td>
			<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000;"> Enter only digit</td>
		</tr>
		<tr>
			<?php $sd = $data_array[10]; ?>
			<td align="right">New Sd % :</td>
			<td><input class="form-control" style="width: 200px;" name="sd" type="text" id="type" value="<?php print $sd;?>"  placeholder="New SD %" /></td>
			<td style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:10px; color:#990000;"> Enter only digit</td>
		</tr>
	</table>
	<div align="center"><input type="submit" name="NP" id="NP" value="UPDATE" style="border-radius:5px; color:#FFFFFF; background-color:#990033; border:none; height:34px; width:80px; cursor:pointer; margin-top:5px;"></div>
</form>
<?php
if(isset($_POST['NP']))
{
	$sd = $_POST['sd'];
	$results=mysql_query("UPDATE add_ons SET product_price='".$_POST['price']."', product_size='".$_POST['designa']."',sd='".$sd."' WHERE id=".$Global_id."");
	print "<div align=\"center\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" color=\"#003300\">Product Updated Successfully.</font></div>";
}
?>