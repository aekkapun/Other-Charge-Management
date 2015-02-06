$(document).ready(function() {
	
$(".cleditor").cleditor({
width:700
});	
	
	
$("#bgPopup2").data("state",0);  
/*   $("#myButton3,#btn_mail").click(function(){  
		centerPopup();
		loadPopup();   
   });
   */
   $("#popupClose2").click(function(){
	   	disablePopup();
   });

   
   $(document).keypress(function(e){
		if(e.keyCode==27) {
			disablePopup();	
		}
	});
});

$(window).resize(function() {
centerPopup();
});

function loadPopup(){
	//loads popup only if it is disabled
	if($("#bgPopup2").data("state")==0){
		$("#bgPopup2").css({
			"opacity": "0.7"
		});		
		$("#bgPopup2").fadeIn("medium");
		$("#Popup2").fadeIn("medium");

		$("#bgPopup2").data("state",1);
	}

	
}

function disablePopup(){
	if ($("#bgPopup2").data("state")==1){
		$("#bgPopup2").fadeOut("medium");
		$("#Popup2").fadeOut("medium");
		$("#bgPopup2").data("state",0);
	}
	if ($("#bgPopup1").data("state")==1){
		$("#bgPopup1").fadeOut("medium");
		$("#Popup1").fadeOut("medium");
		$("#bgPopup1").data("state",0);
	}	
}
function centerPopup(){
	var winw = $(window).width();
	var winh = $(window).height();
	var popw = $('#Popup2').width();
	var poph = $('#Popup2').height();
	$("#Popup2").css({
		"position" : "fixed",
		"top" : 80,
		"left" : 180
	});
	//IE6
	$("#bgPopup2").css({
		"height": winh	
	});

	
}
// JavaScript Document