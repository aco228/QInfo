$(document).ready(function(){
	centriranje();
	odbrojavanje();
});	
function centriranje(){
	var docH = $(window).height();      var docW = $(window).width();
	var centH = $('#center').height(); var centW = $('#center').width();

	var pozX = (docH/2)-(centH/2); var pozY = (docW/2)-(centW/2);
	$('#center').css({'top':pozX+'px','left':pozY+'px'});
}
function odbrojavanje(){
	var duzina = 60;
	$('#counter').text(duzina);
	setInterval(function(){
		if(duzina==0) window.location = "../index.php";
		else duzina--;
		$('#counter').text(duzina);
	}, 1000);
}	
