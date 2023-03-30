<script type="text/javascript">
function reportJAVAC(id,ed,dd,kw,rrt,con)
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
xmlhttp.open("GET","generation.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw+"&q5="+rrt+"&q6="+con,true);
xmlhttp.send();

//showProducts("1");
}

function reportNAME(id,ed,dd,kw,rrt,con)
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
xmlhttp.open("GET","searchByName.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw+"&q5="+rrt+"&q6="+con,true);
xmlhttp.send();
}

function reportTYPE(id,ed,dd,kw,rrt,con)
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
xmlhttp.open("GET","searchByType.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw+"&q5="+rrt+"&q6="+con,true);
xmlhttp.send();
}

function reportSTATUS(id,ed,dd,kw,rrt,con)
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
xmlhttp.open("GET","searchByStatus.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw+"&q5="+rrt+"&q6="+con,true);
xmlhttp.send();
}

</script>

<script language="javascript" type="text/javascript" src="tcal.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<link rel="stylesheet" type="text/css" href="dipu.css" />
<link rel="stylesheet" type="text/css" href="report.css" />
<style type="text/css">
.chotoTime{
width:30px;
border-radius:1px;
}
.TitleStyle {
	color: #333333;
	font-weight: bold;
	font-size:24px;
}
.form-consex{
width:100%;
height:30px;
border-radius:5px;
}
.koblaex{
height:30px;;
width:120px;
border:none;
background-color:#009999;
color:#FFFFFF;
border-radius:3px;
cursor:pointer;
}
.koblaex:hover{
background-color:#666666;
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

<?php
session_start();
if($_GET['i']){
	
	$pad_user = $_GET['i'];
} else {
	$pad_user = $_SESSION['id'];
}
include '../../db.php';

  $results3=mysql_query("SELECT user_name, concern, user_group_id,concern FROM users WHERE id=".$pad_user);
  $row222 = mysql_fetch_array($results3);
?>


<div align="center" class="TitleStyle">Reports & Analysis</div><br>
<div align="left">
  
    <div align="right">
      <label class="glabel" style="color:#FF0000 !important;">    Initial Date :
        <input type="text" id="idate" name="idate" class="tcal" value="<?php echo date("Y-m-d"); ?>" />
      </label>
	  
	  	  <input type="text" name="ihour" id="ihour" value="00" class="chotoTime" required>:
  		  <input type="text" name="imin" id="imin" value="00" class="chotoTime" required>:
		  <input type="text" name="isec" id="isec" value="00" class="chotoTime" required>	
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <label class="glabel" style="color:#FF0000 !important;">End Date :
        <input type="text" id="edate" name="edate" class="tcal" value="<?php echo date("Y-m-d"); ?>" />
      </label>
	  
	  	  <input type="text" name="ehour" id="ehour" value="23" class="chotoTime" required>:
  		  <input type="text" name="emin" id="emin" value="59" class="chotoTime" required>:
		  <input type="text" name="esec" id="esec" value="59" class="chotoTime" required>
    </div>
	
    <table>
	
	<tr>
        <td width="115"><label class="glabel">Assigned to </label></td>
        <td width="151"><select name="type_to" class="form-consex" id="type_to" >
            <!--<option value="">-Select Type-</option>-->
            <? include '../../db.php';
					$result1 = mysql_query("select id, user_name FROM users where user_group_id=".$row222[2]." AND `previlege`!='0' AND `previlege`!='2'");
while($row=mysql_fetch_array($result1)) { ?>
            <option value="<?=$row['id']?>">
            <?=$row['user_name']?>
            </option>
            <? } ?>
        </select></td>
        <td width="169"><input type="submit" class="koblaex" name="Submit" value="Download to Excel" onclick="window.location.assign('phpexcel/report_type_to.php?idate='+document.getElementById('idate').value+'&edate='+document.getElementById('edate').value+'&type='+document.getElementById('type_to').value)"/>

          <img src="search.png" width="20" height="20" style="cursor:pointer;margin-bottom: 6px;background-color:#FFFFFF; vertical-align:bottom; border-top-left-radius:3px; border-top-right-radius:3px; border-bottom-left-radius:3px; border-bottom-right-radius:3px;" onclick="reportNAME(document.getElementById('idate').value, document.getElementById('edate').value, document.getElementById('type_to').value,'<?php print $row222[2]; ?>')" /> </td>

        <td width="169" style="color:#009933;">
          <?php 
            $group = mysql_fetch_array(mysql_query("SELECT * FROM user_group WHERE id=".$row222[2]));
          ?>
		Wellcome <?php print $row222[0];?> [<?php print $group[1]; ?>]
		
		</td>
      </tr>
      <tr>
        <td width="115"><label class="glabel">Service</label></td>
        <td width="151"><select name="type" class="form-consex" id="type" >
            <!--<option value="">-Select Type-</option>-->
            <? include '../../db.php';
					$result1 = mysql_query("select * FROM ticket_type where group_id = '$row222[2]'");
while($row=mysql_fetch_array($result1)) { ?>
            <option value="<?=$row['id']?>">
            <?=$row['type_name']?>
            </option>
            <? } ?>
        </select></td>
        <td width="169"><input type="submit" class="koblaex" name="Submit" value="Download to Excel" onclick="window.location.assign('phpexcel/report_type.php?idate='+document.getElementById('idate').value+'&edate='+document.getElementById('edate').value+'&type='+document.getElementById('type').value)"/>

          <img src="search.png" width="20" height="20" style="cursor:pointer;margin-bottom: 6px;background-color:#FFFFFF; vertical-align:bottom; border-top-left-radius:3px; border-top-right-radius:3px; border-bottom-left-radius:3px; border-bottom-right-radius:3px;" onclick="reportTYPE(document.getElementById('idate').value, document.getElementById('edate').value, document.getElementById('type').value,'<?php print $row222[3]; ?>')" />
        </td>
        <td width="169">
		
		
		</td>
      </tr>
      <!-- <tr>
        <td><label class="glabel">Last Status</label></td>
        <td><select name="status" class="form-consex" id="status" >
            <option value="">-Select Status-</option> 
            <? include '../../db.php';
					$result1 = mysql_query("select *FROM ticket_status");
while($row = mysql_fetch_array($result1)) { ?>
            <option value="<?=$row['status_name']?>">
            <?=$row['status_name']?>
            </option>
            <? } ?>
        </select></td>
        <td><input type="submit" class="koblaex" name="Submit2" value="Download to Excel" onclick="window.location.assign('phpexcel/report_type_status.php?idate='+document.getElementById('idate').value+'&edate='+document.getElementById('edate').value+'&status='+document.getElementById('status').value+'&type=' + '<?php print $row222[2]; ?>')"/>

          <img src="search.png" width="20" height="20" style="cursor:pointer;margin-bottom: 6px;background-color:#FFFFFF; vertical-align:bottom; border-top-left-radius:3px; border-top-right-radius:3px; border-bottom-left-radius:3px; border-bottom-right-radius:3px;" onclick="reportSTATUS(document.getElementById('idate').value, document.getElementById('edate').value, document.getElementById('status').value,'<?php print $row222[2]; ?>')" />
        </td>
        <td>
		
		</td>
      </tr> -->
	  <!-- <input type="submit" class="koblaex" style="width:220px !important; background-color:#330033 !important;" name="Submit" value="Download Full Escalation History" onclick="window.location.assign('phpexcel/report_type_status_Es.php?idate='+document.getElementById('idate').value+'&edate='+document.getElementById('edate').value+'&type='+document.getElementById('type').value)"/> -->
      <tr>
        <td><label class="glabel">Search Keyword : </label></td>
		<td><select name="sby" class="form-consex" id="sby" >
		<option value="cus_contact">Contact</option>
		<option value="cus_ac">Account Number</option>  
		<option value="cus_amount">Card Number</option>
		<option value="id">Ticket ID</option>
		</select>		</td>
        <td><input type="text" name="skeyword" id="skeyword" class="gtext" style="width:125px;" />
            <img src="search.png" width="20" height="20" style="cursor:pointer; background-color:#FFFFFF; vertical-align:bottom; border-top-left-radius:3px; border-top-right-radius:3px; border-bottom-left-radius:3px; border-bottom-right-radius:3px;" onclick="reportJAVAC(document.getElementById('idate').value,document.getElementById('edate').value,document.getElementById('sby').value,document.getElementById('skeyword').value,'<?php print $row222[2]; ?>')" /></td>
        
        <td>&nbsp;</td>
      </tr>
    </table>
  

</div>



<div align="center" id="scontent"></div>
