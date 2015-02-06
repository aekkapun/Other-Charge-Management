$(function() {
	
	$(".cleditor").cleditor({
width:700
});
	$(".cleditor1").cleditor({
width:325,
height:130
});
var popup = false;

var popup1 = false;

/* -------------------  sending mail to all Candidate one time ----------------------- */
$('#btn_mail').click(function(e) {
		var j=0
                 var x1 = document.getElementById("no_rows1");
        var val0 = parseInt(x1.innerHTML);
        //alert(val0);
		 var x = document.getElementById("no_rows");
        var val1 = parseInt(x.innerHTML);
        //alert(val1);
		var x="";
		var email="";
		var form_no="";
		var total=0;
		for(var i=val0;i<=val1;i++)
		{
    		if($('#check'+i).is(':checked'))
			{
				//var x=x+':'+$('#form_no'+i).val();
				if($('#ap_email'+i).val()!='')
				{
					var email=email+$('#ap_email'+i).val()+',';
					total++;
				}

				//var form_no=form_no+$('#form1_no'+i).val()+':';
				//alert(form_no);
				j++;	
							
			}
		}
		if(j==0)    
	{		

	alert('At leat one should be checked for sending mail');
	}
	else
	{
		//alert(email);
		$('#to').val(email);
		$('#total').html("Total Recipient-"+total);
		
	if(popup == false)
	{		//alert(email);

		$("#overlayEffect").fadeIn("slow");
		$("#popupContainer").fadeIn("slow");
		$("#close").fadeIn("slow");
	    center();
		popup = true;
	}
		
	}	
	
});  

$('#send_mail').click(function(e) {
	
	var message=$('#message').val();
	var subject=$('#subject').val();
	var to=$('#to').val();
	if(message=="" || subject=="" || to=="")
	{
		if(message=="")
		{
			$('#message').attr('placeholder','* This field is required');
			$('#message').css('color','red');
		}
		if(subject=="")
		{
				$('#subject').attr('placeholder','* This field is required');
				$('#subject').css('color','red');
		}
		if(to=="")
		{
				$('#subject').attr('placeholder','* This field is required');
				$('#subject').css('color','red');
		}		
	}
	else
	{ 	
		popup = true;
		hidePopup();
		$("#form_submit").val("mail_submit");
		if(popup1 == false)
		{
	
			$("#overlayEffect1").fadeIn("slow");
			$("#popupContainer1").fadeIn("slow");
			$("#close1").fadeIn("slow");
		    center1();
			popup1 = true;
			$('#p').focus();
		}
	}
	});
	



/* -------------------  sending mail to all Candidate one time ----------------------- */
$('#btn_sms').click(function(e) {
		var j=0
		var val1=$('#no_rows').val();
		var x="";
		var mobile="";
		var total_mobile=0;
		for(var i=1;i<=val1;i++)
		{
    		if($('#check'+i).is(':checked'))
			{

				if($('#ap_mobile'+i).val()!='')
				{
					var mobile=mobile+$('#ap_mobile'+i).val()+',';
					total_mobile++;
				}
				j++;
							
			}
		}
		if(j==0)    
	{		
	alert('At leat one should be checked for sending SMS');
	}
	else
	{
		$('#mobile').val(mobile);
		$('#mobile_total').html("Total Recipient-"+total_mobile);
		e.preventDefault();
		$('#myModal').modal('show'); 
	}	
	
}); 


$('#sms_body,#subject,#to').keyup(function(e) {
	$('#subject').css('color','');
	$('#to').css('color','');
	
	var message=$('#sms_body').val();
	$('#sms_body').css('color','');
	$('#mobile').css('color',''); 
	var left_char=160-(message.length);
	$('#left').html(left_char);
	});


function check_length() {
	var message=$('#sms_body').val();
	var left_char=160-(message.length);
	if(left_char<0)
	{

		return false;
				//alert("You are cross the limit of 160 character. Please provide the message up to 160 character");
	}
	else {
		return true;
		}
	}


$('#send_sms').click(function(e) {
	var message=$('#sms_body').val();
	var mobile=$('#mobile').val();
	var left_char=160-(message.length);
	if(message=="" || mobile=="")
	{
		if(message=="")
		{
			$('#sms_body').attr('placeholder','* This field is required');
			$('#sms_body').css('color','red');
		}
		if(mobile=="")
		{
				$('#mobile').attr('placeholder','* This field is required');
				$('#mobile').css('color','red');
		}
	} 
	else
	{
		$('#sms_body').attr('placeholder','');
		$('#sms_body').css('color','');
		
		$('#mobile').attr('placeholder','');
		$('#mobile').css('color','');
				
		if(left_char<0)
		alert("You are cross the limit of 160 character. Please provide the message up to 160 character");
		else
		{
		
			$('#myModal').modal('hide');			
			e.preventDefault();
			$('#p').focus();
			$("#form_submit").val("sms_submit");
		if(popup1 == false)
		{
	
			$("#overlayEffect1").fadeIn("slow");
			$("#popupContainer1").fadeIn("slow");
			$("#close1").fadeIn("slow");
		    center1();
			popup1 = true;
			$('#p').focus();
		}
			

//			var op="<?php echo $_SESSION[PROJECT_SHORT.'password']; ?>";
//			var p=prompt("Please Enter your password")
//			hash = Sha1.hash(p);
//			if(op==hash)
//		 	$('#sms_submit').submit();
//			else
//			alert("password is not correct");
		}
	}
	});




	

	





$("#from_name").change(function()
{
	var val=$(this).val()
	if(val!='')
	{
	var x=val.split(':');
	$('#from').val(x[1]);
	}	
	});




	
	$("#close").click(function(){
		hidePopup();
	});
	
	$("#overlayEffect").click(function(){
		hidePopup();
	});
	
function center(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContainer").height();
	var popupWidth = $("#popupContainer").width();
	
		$("#popupContainer").css({
		"position" : "fixed",
		"top" : 70,
		"left" : 270,
		"width" : 750
	});
	

	
	}
function hidePopup(){
	if(popup==true){

		$("#overlayEffect").fadeOut("slow");
		$("#popupContainer").fadeOut("slow");
		$("#close").fadeOut("slow");
		popup = false;
	}
}





/* For Password Confirmation*/

$("#close1").click(function(){
		hidePopup1();
	});
	
	$("#overlayEffect1").click(function(){
		hidePopup1();
	});
	
function center1(){
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#popupContainer1").height();
	var popupWidth = $("#popupContainer1").width();
	
		$("#popupContainer1").css({
		"position" : "fixed",
		"top" : 70,
		"left" : 270,
		"width" : 700
	});
	

	
	}
function hidePopup1(){
	if(popup1==true){
		$("#overlayEffect1").fadeOut("slow");
		$("#popupContainer1").fadeOut("slow");
		$("#close1").fadeOut("slow");
		popup1 = false;
	}
}








} ,jQuery);


