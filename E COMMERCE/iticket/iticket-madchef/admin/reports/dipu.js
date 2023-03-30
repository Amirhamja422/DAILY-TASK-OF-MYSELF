function showGroups(str,str2)
{
if (str=="")
  {
  document.getElementById("gspan").innerHTML="<label class=\"glabel\">Select Group: <select name=\"group\" id=\"group\" style=\"width:150px;\" class=\"sdesign\"><option value=\"\">Select Group</option></select></label>";
  return;
  }
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
    document.getElementById("gspan").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","glist.php?q="+str+"&q2="+str2,true);
xmlhttp.send();

//showProducts("1");
}




function reportJAVA(id,ed,dd,kw)
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
xmlhttp.open("GET","generation.php?q1="+id+"&q2="+ed+"&q3="+dd+"&q4="+kw,true);
xmlhttp.send();

//showProducts("1");
}
