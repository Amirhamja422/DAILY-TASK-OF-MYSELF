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
xmlhttp.open("GET","generation.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw+"&q5="+rrt,true);
xmlhttp.send();

//showProducts("1");
}

</script>

<script language="javascript" type="text/javascript" src="tcal.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<link rel="stylesheet" type="text/css" href="dipu.css" />
<link rel="stylesheet" type="text/css" href="report.css" />
<style type="text/css">
.TitleStyle {
	color: #333333;
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
<td width="115"><label class="glabel">Status type </label></td>
<td width="179"><select name="type" class="form-control" id="type" required="required">
  <option value="">-Select Type-</option>
  <? include '../../db.php';
					$result1 = mysql_query("select *FROM ticket_type ");
while($row=mysql_fetch_array($result1)) { ?>
  <option value="<?=$row['type_name']?>">
  <?=$row['type_name']?>
  </option>
  <? } ?>
</select></td>
<td width="103"><input type="submit" name="Submit" value="Status report" /></td>
</tr>

<tr>
<td><label class="glabel">Ticlet type </label></td>
<td><select name="status" class="form-control" id="status" >
  <option value="">-Select Status-</option>
  <? include '../../db.php';
$result1 = mysql_query("select *FROM ticket_status ");
while($row=mysql_fetch_array($result1)) { ?>
  <option value="<?=$row['status_name']?>">
  <?=$row['status_name']?>
  </option>
  <? } ?>
</select></td>
<td><input type="submit" name="Submit2" value="Type report" /></td>
</tr>
<tr>
<td><label class="glabel">Search Keyword : </label></td>
<td><input type="text" name="skeyword" id="skeyword" class="gtext" style="width:125px;" />
  <img src="search.png" width="20" height="20" style="cursor:pointer; background-color:#FFFFFF; vertical-align:bottom; border-top-left-radius:3px; border-top-right-radius:3px; border-bottom-left-radius:3px; border-bottom-right-radius:3px;" onclick="reportJAVA(document.getElementById('idate').value,document.getElementById('edate').value,document.getElementById('sby').value,document.getElementById('skeyword').value,document.getElementById('rrtype').value)" /></td>
<td><input type="submit" name="Submit3" value="All report" /></td>
</tr>
</table>

</div>


<br>
<div align="left" id="scontent"></div>
