jQuery(document).ready( function($) {

   jQuery("#booking_form").submit( function(e) {
	   	e.preventDefault();
	   	var form = $(this);
	   	var fname = $('#fname').val();
	   	var lname = $('#lname').val();
	   	var email = $('#email').val();
	   	var phone = $('#phone').val();
	   	var vehicle_type = $('#vehicle_type').val();
	   	var vehicle = $('#vehicle').val();
	   	var message = $('#message').val();
	   	if(fname =='') {
	   		$('.responseMessage').html('<span class="error">First Name is required</span>');
	   		return;
	   	}
	   	if(lname =='') {
	   		$('.responseMessage').html('<span class="error">Last Name is required</span>');
	   		return;
	   	}
	   	if(email =='') {
	   		$('.responseMessage').html('<span class="error">Email is required</span>');
	   		return;
	   	}
	   	if(IsEmail(email)==false){
   			$('.responseMessage').html('<span class="error">Email is not valid.</span>');
   			return;
   		}
	   	if(phone =='') {
	   		$('.responseMessage').html('<span class="error">Phone Number is required</span>');
	   		return;
	   	}
	   	if(vehicle_type =='') {
	   		$('.responseMessage').html('<span class="error">Please choose vehicle type</span>');
	   		return;
	   	}
	   	if(vehicle =='') {
	   		$('.responseMessage').html('<span class="error">Please choose vehicle</span>');
	   		return;
	   	}

	   	jQuery.ajax({
	        type : "post",
	        dataType : "json",
	        url : myAjax.ajaxurl,
	        data : {action: "my_user_vote", fname : fname, lname : lname, email : email, phone : phone, vehicle_type : vehicle_type, vehicle : vehicle, message : message},
	        success: function(response) {
	            if($.trim(response) == 'success') { 
	            	$('.responseMessage').html('<span class="success">Your request submitted syccessfully.</span>');
	            } else {
	            	$('.responseMessage').html('<span class="error">Something wrong, Please try again later.</span>');
	            }
	        }
      	});

   	});
});

function IsEmail(email) {
	  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	  if(!regex.test(email)) {
	    return false;
	  }else{
	    return true;
	  }
}