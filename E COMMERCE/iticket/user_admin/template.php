<?php include'session.php'; ?>
<script src="ck/ckeditor.js"></script>
<script type="text/javascript">
function changeText2(str){
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
	document.getElementById('kullu').innerHTML = "<textarea class=\"form-control\" id=\"editor1\" name=\"editor1\" rows=\"4\" required>"+xmlhttp.responseText+"</textarea>";
	CKEDITOR.replace('editor1');
				CKEDITOR.config.height = 90;
    }
  }
xmlhttp.open("GET","kullu/tem.php?q="+str,true);
xmlhttp.send();
}
</script>

<style type="text/css">
.TitleStyle {
	color: #666666;
	font-weight: bold;
	font-size:24px;
}
.dropdown{
border-top-left-radius:5px;
border-top-right-radius:5px;
border-bottom-left-radius:5px;
border-bottom-right-radius:5px;
}
.anlepore tr:hover{
background-color:#999999;
}
.anlepore tr{
background-color:rgba(49, 94, 64, 0.6);
color:#000000;
}
.userdapa{
border-radius:5px;
}
.userdapa1 {border-radius:5px;
}
</style>
<script src="dipu.js"></script>

<div align="center" class="TitleStyle">Manage Ticket Template &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>


<form action="template.php" method="post">
  <table width="75%" height="123" align="center" style="color:#000000;">
    
    
    
    <tr>
      <td align="center"><div align="left">New massage title </div></td>
    </tr>
    <tr>
      <td align="center"><div align="left">
        <input name="title" type="text" id="title" required />
      </div></td>
    </tr>
    <tr>
      <td align="center"><div align="left">Detail massage  :</div></td>
    </tr>
    <tr>
      <td width="596" align="center"><div align="left">
        <div id="kullu">
          <div align="left">
            <textarea class="form-control" id="editor1" name="editor1" rows="3" required="required">
			
			</textarea>
          </div>
        </div>
      </div></td>
    </tr>
    <tr>
      <td align="center"><div align="left">
	      <script>
				CKEDITOR.replace( 'editor1');
				CKEDITOR.config.height = 90;
			</script>
	      <input type="submit" name="addtemplate" id="addtemplate" value="Add" style="border-radius:5px;" />	  
      &nbsp;</div></td>
    </tr>
  </table>
</form>


























<?php
if(isset($_POST['addtemplate']))
{
include '../db.php';
$results=mysql_query("INSERT INTO template (title,massage) VALUES ('".$_POST['title']."','".$_POST['editor1']."')");

print "<font face=\"Times New Roman, Times, serif\" color=\"#99FF33\">Massage Successfully Inserted.</font>";
}
?>
<br>



<div align="center">
<br><br>
<table style="border-radius:20px; border:1px; border:solid; width:75%; cursor:pointer; color:#999999;" align="center" class="anlepore">
<tr style="background-color:#0099CC; color:#FFFFFF;">
<td align="center">No.</td><td align="center">Title</td><td align="center">Massage</td><td title="Delete" align="center"><img src="idebnath/delete.png" style="cursor:pointer;"></td>

</tr>

<?php include 'bralist2template.php'; ?>

</table>

</div>