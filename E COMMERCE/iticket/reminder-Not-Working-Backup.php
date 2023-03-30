



<script src="ck/ckeditor.js"></script>

<script type="text/javascript">
function showSend(to,msg)
{
document.getElementById("sendStatus").innerHTML = "<img src=\"loading.gif\" width=\"100\" height=\"80\">";
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
    document.getElementById("sendStatus").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","mail/send_dipu.php?to="+to+"&msg="+msg,true);
xmlhttp.send();
}
</script>


<style type="text/css">
.form-consex{
width:100% !important;
height:30px;
border:1px solid #999999;
border-radius:3px;
padding-left:5px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:15px;
}
.form-consex:focus{
box-shadow: 0px 0px 8px #04124D;
}
.optionV{
background-color:#CCCCFF;
}
.emailcontainer{
font-family:Verdana, Arial, Helvetica, sans-serif;
}
.chotoicon
{
color:#FFFFFF;
cursor:pointer;
background:#009966;
border-radius:5px;
width:100px;
height:25px;
background-image:url(image/send.png);
background-repeat:no-repeat;
background-position:left;
background-size:35px 25px;
box-shadow: 1px 1px 1px #000000;
vertical-align:middle;
margin-top:10px;
}
.chotoicon:hover{
background:#3399CC;
background-image:url(image/send.png);
background-repeat:no-repeat;
background-position:left;
background-size:35px 25px;
}
.vitorchoto{
text-shadow: 1px 1px 1px #000000;
margin-right:15px;
}
#sendStatus{
margin-right:200px;
margin-top:-30px;
color:#00CC00;
font-weight:bolder;
text-shadow: 1px 1px 1px #000000;
}
</style>







<?php include 'db.php';?>
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
$sms_body = "<font color=\"red\"><strong>Dear Concern,</strong></font><br><br>
<font color=\"red\">Please see the complain :</font><br>

<p align=\"justify\">
T-ID:$tid, $cname, $address, $cproduct, $to, $ti_detail
</p><br><br>
<font color=\"red\"><strong>Customer Relation Department</strong></font><br>
<font color=\"red\"><strong>PRAN-RFL Group</strong></font>";
}
?>

<div align="center" class="emailcontainer">


<table align="center">


<tr>
<td>Email Recipient :</td>

<td>
<select name="select_to" class="form-consex" id="select_to" >
		<option value="id">-- Select Email Recipient --</option>
		<?php
		$results = mysql_query("select name,email FROM users ");
		while($row=mysql_fetch_array($results))
		{
		print "<option class=\"optionV\" value=\"$row[1]\">$row[0] < $row[1] ></option>";
		}
		?>  
</select></td>
</tr>

<tr>
<td colspan="3">

<textarea id="editor1" name="editor1" rows="4" required>
Please Check Ticket ID :  and Provide Quick Response.
</textarea>
<script>CKEDITOR.replace( 'editor1',{uiColor:'#CCCCCC'});CKEDITOR.config.height = 190;CKEDITOR.config.width = 620;</script></td>
</tr>

<tr>
<td colspan="3" align="right">

<div class="chotoicon" align="right" onclick="showSend(document.getElementById('select_to').value,document.getElementById('editor1').value);"><span class="vitorchoto">Send</span></div>
<div align="right" id="sendStatus"></div>
</td>
</tr>
</table>







</div>