<?php include'session.php'; ?>
<script class="jsbin" src="jquery.min.js"></script>
<script class="jsbin" src="jquery-ui.min.js"></script>

<script type="text/javascript">
function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
				document.getElementById("imageTitle").innerHTML=""+document.getElementById("imgone").value;
				document.getElementById("blah").style.visibility = 'visible';
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(170)
                        .height(220);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
		
		
		
		
		function GABLA(IMAGED)
		{
		//document.getElementById("imageTitle").innerHTML=IMAGED;
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
    document.getElementById("imageTitle").innerHTML=xmlhttp.responseText;
	var body = parent.document.getElementsByTagName('body')[0];
	body.style.backgroundImage = "url("+IMAGED+")";
    }
  }
xmlhttp.open("GET","actionbg.php?q="+IMAGED,true);
xmlhttp.send();
		}
</script>

<style type="text/css">
.DIM{
cursor:pointer;
padding:5px;
border:double;
}
.WALA{
color:#CCCCCC;
}
.arena{
visibility:hidden;
}
</style>


<form action="upload.php" method="post" enctype="multipart/form-data">

<div align="center" style="margin-top:20px;"><img id="blah" src="#" alt="Your Image" class="arena" /></div>
<div align="center" style="color:#666666;" id="imageTitle"></div>
</form>



<?php
if(isset($_POST['kopla']))
{
    move_uploaded_file($_FILES["imgone"]["tmp_name"],"../pi/".$_FILES["imgone"]["name"]);
 print "<span class=\"WALA\">Image Successfully Uploded.<span>";
}	  
?>


<div align="center">
<div align="center" style="overflow-y:auto; width:75%; height:400px;">
<?php

   $files = glob("backgrounds/*.*");

   for ($i=1; $i<count($files); $i++)

  {
  $image = $files[$i];
  if(la($image) != ".php")
  echo '<img src="'.$image .'" title="'.$image.'" width="80" height="80" class="DIM"  onclick="GABLA(this.title)" />'."";
   }

 ?>
 </div>
 </div>
 
 
 
 <?php
 function dele( $string ) {
	return substr( $string, 6 );
}
 
 ?>
 
  <?php
 function la( $string ) {
	return substr( $string, -4 );
}
 
 ?>