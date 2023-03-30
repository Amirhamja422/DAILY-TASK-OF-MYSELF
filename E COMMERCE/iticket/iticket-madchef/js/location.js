function getState(country) {	
var strURL="&country="+country;
$.ajax({
	type: "GET",
	url: "findState.php",
	data: strURL,
	cache: false,
	success: function(d){
	$('#statediv').show().html(d);
	}
});
}
function getCity(stateId) {	
var strURL="&state="+stateId;
$.ajax({
	type: "GET",
	url: "findCity.php",
	data: strURL,
	cache: false,
	success: function(d){
	$('#citydiv').show().html(d);
	}
});
}

function getvillage(vill) {	
var strURL="&city="+vill;
$.ajax({
	type: "GET",
	url: "findvillage.php",
	data: strURL,
	cache: false,
	success: function(d){
	$('#villagediv').show().html(d);
	}
});
}


function getpostoffice(post) {	
var strURL="&village="+post;
$.ajax({
	type: "GET",
	url: "findpostoffice.php",
	data: strURL,
	cache: false,
	success: function(d){
	$('#postofficediv').show().html(d);
	}
});
}


function getcode(code) {	
var strURL="&state="+code;
$.ajax({
	type: "GET",
	url: "findcode.php",
	data: strURL,
	cache: false,
	success: function(d){
	$('#codediv').show().html(d);
	}
});
}
