<script type="text/javascript">
function reportJAVA(id,ed,dd,kw)
{
id = id + " " +document.getElementById("ihour").value + ":" + document.getElementById("imin").value + ":" + document.getElementById("isec").value;
ed = ed + " " +document.getElementById("ehour").value + ":" + document.getElementById("emin").value + ":" + document.getElementById("esec").value;


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
xmlhttp.open("GET","generation.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw,true);
xmlhttp.send();
//showProducts("1");
}

</script>

<script language="javascript" type="text/javascript" src="tcal.js"></script>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<link rel="stylesheet" type="text/css" href="dipu.css" />
<link rel="stylesheet" type="text/css" href="report.css" />


<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery.simplemodal.js'></script>
<script type='text/javascript' src='js/osx.js'></script>
<link type='text/css' href='css/osx.css' rel='stylesheet' media='screen' />
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
<div align="center" class="TitleStyle">Reports & Analysis</div><br>
<div align="left">

  <div align="right">
    <label class="glabel" style="color:#FF0000 !important;">Initial Date :
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

  


    <td><label class="glabel">Branch Name</label></td>
    <td><select name="status" class="form-consex" id="branch" >
      <!--<option value="">-Select Status-</option> -->
      <?php include '../../db.php';
      $result1 = mysql_query("SELECT DISTINCT branch_name FROM user_group;");
      while($row=mysql_fetch_array($result1)) { ?>
        <option value="<?php echo $row['branch_name']; ?>">
        <?php echo $row['branch_name']; ?>
        </option>
      <?php } ?>
    </select></td>
    <td>
      <input type="submit" class="koblaex" name="Submit3" value="Download to Excel" onclick="window.location.assign('phpexcel/report_type_to.php?idate='+document.getElementById('idate').value+'&edate='+document.getElementById('edate').value+'&branch='+document.getElementById('branch').value)"/>
    </td>
       

  </tr> 


  <tr>
    <td width="115"><label class="glabel">Brand</label></td>
    <td width="151">
      <select name="type" class="form-consex" id="group" >        
        <option value="all">ALL Brand</option>
        <?php
        include '../../db.php';
        $result1 = mysql_query("select *FROM ticket_type");
        while ($row = mysql_fetch_array($result1)) {
          ?>
          <option value="<?php echo $row['type_name']; ?>">
            <?php echo $row['type_name']; ?>
          </option>
        <?php } ?>
      </select>
    </td>
    <td width="169">
      <input type="submit" class="koblaex" name="Submit" value="Download to Excel" onclick="window.location.assign('phpexcel/report_type.php?idate='+document.getElementById('idate').value+'&edate='+document.getElementById('edate').value+'&group='+document.getElementById('group').value)"/>
    </td>
    <td width="169">
    </td>
  </tr>


  <tr>

    <td><label class="glabel">Last Status</label></td>
    <td><select name="status" class="form-consex" id="status" >
      <!--<option value="">-Select Status-</option> -->
      <?php include '../../db.php';
      $result1 = mysql_query("select *FROM ticket_status ");
      while($row=mysql_fetch_array($result1)) { ?>
        <option value="<?php echo $row['status_name']?>">
          <?php echo $row['status_name']?>
        </option>
      <?php } ?>
    </select></td>
    <td>
      <input type="submit" class="koblaex" name="Submit2" value="Download to Excel" onclick="window.location.assign('phpexcel/report_type_status.php?idate='+document.getElementById('idate').value+'&edate='+document.getElementById('edate').value+'&status='+document.getElementById('status').value)"/>
    </td>





    <td align="right">
      <input type="submit" class="koblaex" style="width:220px !important; background-color:#330033 !important;" name="Submit" value="Download Full Escalation History" onclick="window.location.assign('phpexcel/report_type_status_Es.php?idate='+document.getElementById('idate').value+'&edate='+document.getElementById('edate').value)"/>

    </td>






  </tr>
  <tr>
    <td><label class="glabel">Search Keyword : </label></td>
    <td><select name="sby" class="form-consex" id="sby" >
      <option value="cus_contact">Contact</option>
      <option value="cus_name">Name</option>
      <option value="id">Ticket ID</option>
      <option value="order_id">Order ID</option>
    </select>		</td>
    <td><input type="text" name="skeyword" id="skeyword" class="gtext" style="width:125px;" />
      <img src="search.png" width="20" height="20" style="cursor:pointer; background-color:#FFFFFF; vertical-align:bottom; border-top-left-radius:3px; border-top-right-radius:3px; border-bottom-left-radius:3px; border-bottom-right-radius:3px;" onclick="reportJAVA(document.getElementById('idate').value,document.getElementById('edate').value,document.getElementById('sby').value,document.getElementById('skeyword').value)" /></td>

      <td>&nbsp;</td>
    </tr>
  </table>
  

</div>



<div align="center" id="scontent"></div>






<script>
// Display an external page using an iframe
function smcollege(kuti)
{
var X=window.innerWidth/5;//$(window).height()-430;
//document.getElementById("NP").value=X;
var Y=50;
var src = "reports/edittieket.php?q1="+kuti;
$.modal('<iframe src="' + src + '" height="480" width="830" style="border:0">', {
  closeHTML:"",
  appendTo: $(window.parent.document).find('body'),
  opacity:70,
  overlayCss: {backgroundColor:"#000"},
  containerCss:{
    backgroundColor:"#fff", 
    borderColor:"#000",
    borderRadius:15,
    height:510, 
    padding:0, 
    width:830
  },
  overlayClose:true,
  position: [Y,X],
  onOpen: function (dialog) {
  dialog.overlay.fadeIn('slow', function () {
    dialog.data.hide();
    dialog.container.fadeIn('slow', function () {
      dialog.data.slideDown('slow');   
    });
  });
},
onClose: function (dialog) {
  dialog.data.fadeOut('slow', function () {
    dialog.container.hide('fast', function () {
      dialog.overlay.slideUp('fast', function () {
        $.modal.close();
      });
    });
  });
}

});

$(window.parent.document).find('#simplemodal-overlay').css('width', '100%');
$(window.parent.document).find('#simplemodal-overlay').css('height', '100%');
}
</script>