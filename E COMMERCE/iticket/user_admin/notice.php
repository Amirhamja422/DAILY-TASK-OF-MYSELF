<?php include'session.php'; ?>
<script src="ck/ckeditor.js"></script>


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

<div align="center" class="TitleStyle">Send Notice/Reminder &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div><br>


<form action="" method="post">
  <table width="75%" height="123" align="center" style="color:#000000;">
    
    
    
    <tr>
      <td align="center" ><div align="left">Recipient    (Hold "Ctrl" key to select multiple)</div></td>
    </tr>
    <tr>
      <td align="center"><div align="left">
        
		
		<select name="type_to[]" class="form-consex"  multiple="multiple">
            
            <? include '../db.php';
					$result1 = mysql_query("select id, user_name FROM users ");
while($row=mysql_fetch_array($result1)) { ?>
            <option value="<?=$row['id']?>">
            <?=$row['user_name']?>
            </option>
            <? } ?>
        </select>
		
		
      </div></td>
    </tr>
    <tr>
      <td align="center"><div align="left">Notice massage  :</div></td>
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
	      <input type="submit" name="addtemplate" id="addtemplate" value="Send" style="border-radius:5px;" />	  
      &nbsp;</div></td>
    </tr>
  </table>
</form>


























<?php
if(isset($_POST['addtemplate']))
{
include '../db.php';


	$skillsArray = $_POST['type_to'];
	foreach ($skillsArray as $key => $value) { 
		$results=mysql_query("UPDATE `ticket`.`users` SET `notice` = '".$_POST['editor1']."' WHERE `users`.`id` = ".$value);
    }




print "<font face=\"Times New Roman, Times, serif\" color=\"#99FF33\">Notice Successfully Send.</font>";
}
?>
<br>



