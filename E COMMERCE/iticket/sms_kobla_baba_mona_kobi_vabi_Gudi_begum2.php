<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style> 
div.container {
width: 100%;
height: 445px;
}
</style>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>. : : i Tracker : : .</title>
<script type="text/javascript">
function showSend(to,msg,mask)
{
/*document.getElementById("suc_res").innerHTML = "<img src=\"mail/image/gear.gif\" width=\"100\" height=\"70\">";
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("suc_res").innerHTML= xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","https://vas.banglalinkgsm.com/sendSMS/sendSMS?msisdn="+to+"&message="+msg+"&userID=PRANRFL&passwd=e4bf9fabf2cf0b004dc84960f141e49f&sender="+mask,true);

xmlhttp.send();*/


document.getElementById("suc_res").src = "https://vas.banglalinkgsm.com/sendSMS/sendSMS?msisdn="+to+"&message="+msg+"&userID=PRANRFL&passwd=e4bf9fabf2cf0b004dc84960f141e49f&sender="+mask;

//document.getElementById("suc_res").src = "http://192.168.100.30/KOBI_DIPU.php";

}
</script>
<script language="JavaScript">
       function GetInventory()
       {
         var InvForm = document.getElementById("usersconlist"); 
         var SelBranchVal = "";
         var x = 0;

         for (x=0;x<InvForm.length;x++)
         {
            if (InvForm[x].selected)
            {
             
             SelBranchVal = SelBranchVal + ";88" + InvForm[x].value;
            }
         }
         //alert(SelBranchVal);displaymnumbers
		 if(document.getElementById("displaymnumbers").value == ""){
		 document.getElementById("displaymnumbers").value = document.getElementById("displaymnumbers").value + SelBranchVal.slice( 1 ); 
		 }
		 else{
		 document.getElementById("displaymnumbers").value = document.getElementById("displaymnumbers").value + SelBranchVal; 
		 }
       }


</script>
</head>



<?php
$to 	   = "";
$tid	   = "";
$cname	   = "";
$cproduct  = "";
$address   = "";
$sms_body  = "";

if(isset($_GET['to']))        $to  	 	= "88".$_GET['to'];
if(isset($_GET['tid']))       $tid 	 	= $_GET['tid'];
if(isset($_GET['cname']))     $cname 	= $_GET['cname']; 
if(isset($_GET['cproduct']))  $cproduct = $_GET['cproduct']; 
if(isset($_GET['address']))   $address  = $_GET['address'];




if(isset($_GET['tid']))
{
include 'db.php';
$res = mysql_query("select (SELECT phone FROM `users` where id = ( select assignd  from ticket where id = $tid)), `details` from ticket where id = $tid");
$DataAr = mysql_fetch_array($res);

$assignd_no = ";88".$DataAr[0];
$ti_detail = strip_tags($DataAr[1]);
}
else
{
$assignd_no = "";
$ti_detail = "";
}





if(isset($_GET['tid']))
{
$sms_body = "T-ID:$tid, $cname, $address, $cproduct, $to, $ti_detail - PRAN-RFL CRD";
}
?>





<body background="admin/<?php include 'bg.php';?>">

<div class="container" style="background:#CCCCCC; font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px;">
<?php include'menu.php';?>

<br>
    <div><fieldset>
        <legend style="font-size:14px;"><strong>SMS Recipient(s)</strong> Hold "Ctrl" key to select multiple</legend>
    
        <p>
                <textarea name="displaymnumbers" id="displaymnumbers" placeholder="Mobile Numbers Separated by (;)" cols="20" rows="3" class="form-control" style="width:40%; float:left;"><?php print $to.$assignd_no; ?></textarea>
			<button class="btn btn-primary btn-sm" onclick="GetInventory()" style="margin-left:10px;"> <span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Add Recipient</button>
				<select name="usersconlist" id="usersconlist" size="5" class="form-control" style="width:40%; float:right; font-size:11px;" multiple>
                	
					<? $result1 = mysql_query("select phone, user_name FROM users"); // ORDER BY user_name ASC
    				while($row=mysql_fetch_array($result1)) { ?>
            		<option value="<?=$row['phone']?>">
            		<?=$row['user_name']?>
            		</option><? } ?>
					
                </select>
            
        </p>
        
    </fieldset></div>

<div>
<strong>Message</strong> 
<textarea name="smsbody" id="smsbody" placeholder="SMS Body" cols="20" rows="3" class="form-control">
<?php print $sms_body;?>
</textarea>

<strong>Sender Mask</strong>
				<select name="smsmask" id="smsmask" class="form-control" style="width:40%;">
					<option value="PRAN">PRAN</option>
					<option value="RFL">RFL</option>
					<option value="BLIL">BLIL</option>
                </select>
<br>				
<button class="btn btn-primary btn-sm" onclick="showSend(document.getElementById('displaymnumbers').value,document.getElementById('smsbody').value,document.getElementById('smsmask').value);" style="float:left;"> <span class="glyphicon glyphicon-send" aria-hidden="true"></span> Send SMS</button>

<iframe id="suc_res" style="float:right; margin-top:-65px; margin-right:10px;     width:350px; height:80px; border:none; overflow:hidden;">

</iframe>


</div>



</div>
</body>
</html>
