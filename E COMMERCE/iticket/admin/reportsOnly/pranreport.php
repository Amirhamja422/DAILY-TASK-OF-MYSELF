<script type="text/javascript">
function reportJAVA(id,ed,dd,kw,rrt)
{

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
    document.getElementById("scontent").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","prangeneration.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw+"&q5="+rrt,true);
xmlhttp.send();

//showProducts("1");
}

</script>

<script language="javascript" type="text/javascript" src="../../supernova_dipu/tcal.js"></script>
<link rel="stylesheet" type="text/css" href="../../supernova_dipu/tcal.css" />
<link rel="stylesheet" type="text/css" href="dipu.css" />
<link rel="stylesheet" type="text/css" href="report.css" />
<style type="text/css">
.TitleStyle {
	color: #FFFFFF;
	font-weight: bold;
	font-size:24px;
}
.dropdown{
border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-left-radius:5px;
border-bottom-right-radius:5px;
}
.suc{
color:#00FF00;
}
.firsttr{
background-color:#99CCFF;
color:#0000FF;
font-style:oblique;
text-align:center;
text-shadow: 4px 4px 2px rgba(150, 150, 150, 1);
}
.porertr{
background-color:#006600;
color:#FFFFFF;
text-align:center;
}
</style>
<div align="center" class="TitleStyle">Reports & Analysis</div><br>
<div align="center">
<label class="glabel">Initial Date : <input type="text" id="idate" name="idate" class="tcal" value="<?php echo date("Y-m-d"); ?>"></label>
<label class="glabel">End Date : <input type="text" id="edate" name="edate" class="tcal" value="<?php echo date("Y-m-d"); ?>"></label>
</div>



<div align="left">
<table>
<tr>
<td><label class="glabel">Report Type : </label></td>
<td>
<select name="rrtype" id="rrtype" class="sdesign" style="width:121px;">
<option value="">Report Type</option>
<option value="Complain">Complain</option>
<option value="Query">Query</option>
<option value="Compliment">Compliment</option>
</select>
</td>
</tr>



<tr>
<td><label class="glabel">Search by : </label></td>
<td>
<select name="sby" id="sby" class="sdesign">
<option value="brand">Group</option>
<option value="contact">Contact</option>
<option value="product">Product</option>
<option value="address">Address</option>
<option value="p_nature">Problem Nature</option>
<option value="p_model">Product Model</option>
<option value="pur_date">Purchase Date</option>
<option value="report_type">Report Type</option>
<option value="problem_status">Problem Status</option>
<option value="all">All</option>
</select>
</td>
</tr>
<tr>
<td><label class="glabel">Search Keyword : </label></td>
<td><input type="text" name="skeyword" id="skeyword" class="gtext" style="width:125px;">
<img src="../../idebnath/search.png" width="20" height="20" style="cursor:pointer; background-color:#FFFFFF; vertical-align:bottom; border-top-left-radius:3px; border-top-right-radius:3px; border-bottom-left-radius:3px; border-bottom-right-radius:3px;" onclick="reportJAVA(document.getElementById('idate').value,document.getElementById('edate').value,document.getElementById('sby').value,document.getElementById('skeyword').value,document.getElementById('rrtype').value)">
</td>
</tr>
</table>

</div>


<br>
<div align="left" id="scontent"></div>
