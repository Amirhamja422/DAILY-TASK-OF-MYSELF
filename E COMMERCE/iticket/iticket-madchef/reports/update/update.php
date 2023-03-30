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
width:190px !important;
height:30px;
border-radius:3px;
}
.form-consex:focus{
box-shadow: 0px 0px 8px #04124D;
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
.chotoicon
{
cursor:pointer;
background:#00CC99;
border-radius:2px;
}
.chotoicon:hover{
background:#00FF66;
}
</style>
<div align="center" class="TitleStyle">Update/Delete Ticket</div><br>
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
	
    <table align="left" style="font-family:Verdana, Arial, Helvetica, sans-serif;"> 
      <tr>
        <td><label class="glabel">Search Keyword : </label></td>
		<td><select name="sby" class="form-consex" id="sby" >
		<option value="cus_contact">Contact</option>
		<option value="cus_ac">Account Number</option>  
		<option value="cus_amount">Card Number</option>
		<!-- <option value="ticket_type">Type</option>  -->  
		<option value="id">Ticket ID</option>
		</select>		</td>
        <td><input type="text" name="skeyword" id="skeyword" class="form-consex" style="width:125px;" /></td>
        
        <td><img src="bsearch.png" width="25" height="25" class="chotoicon" onclick="reportJAVA(document.getElementById('idate').value,document.getElementById('edate').value,document.getElementById('sby').value,document.getElementById('skeyword').value)" /></td>
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
var src = "update/edittieket.php?q1="+kuti;
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