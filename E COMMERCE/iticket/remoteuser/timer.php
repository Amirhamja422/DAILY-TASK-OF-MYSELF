<script language="JavaScript">
function clock(){
var time = new Date()

var dd = time.getDate();
var mm = time.getMonth()+1; 
var yyyy = time.getFullYear();

var hr = time.getHours()
var min = time.getMinutes()
var sec = time.getSeconds()
var ampm = " PM "
if (hr < 12){
ampm = " AM "
}
if (hr > 12){
hr -= 12
}
if (hr < 10){
hr = " " + hr
}
if (min < 10){
min = "0" + min
}
if (sec < 10){
sec = "0" + sec
}
document.getElementById("timerDiv").innerHTML =dd+"-"+ mm+ "-"+ yyyy + hr + ":" + min + ":" + sec + ampm
setTimeout("clock()", 1000)
}
function showDate(){
var date = new Date()
var year = date.getYear()
if(year < 1000){
year += 1900
}
var monthArray = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December")
alert( monthArray[date.getMonth()] + " " + date.getDate() + ", " + year)
}
//window.onload=clock;
</script>

<style>
#timerDiv
{
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:11px;
color:#009900;
}
</style>










<body onLoad="clock();">
<div id="timerDiv" >


</div>
</body>