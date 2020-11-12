<?php
function my_user_vote() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'v_booking_info';

	$fName = $_POST['fname'];
	$lName = $_POST['lname'];
	$phone = $_POST['phone'];
	$email = $_POST['email'];
	$vehicalType = $_POST['vehicle_type'];
	$vehicle = $_POST['vehicle'];
	$message = $_POST['message'];

	$vType = get_term( $vehicalType, 'vehicle_type' );

	$insert = $wpdb->insert($table_name, array(
	    'f_name' => $fName,
	    'l_name' => $lName,
	    'email' => $email,
	    'phone' => $phone,
	    'vehicle_type' => $vType->name,
	    'vehicle' => get_the_title($vehicle),
	    'message' => $message,
	    'status' => 0,
	    'time' => date('Y-m-d H:i:s'),
	));
	if($insert) {
		$to = $email;
		$subject = 'You have successfully registered your request.';
		$body = '<h1>Your request has been submited successfuly</h1>';
		$body .= 'Hello ' . $fName . ', \n';
		$body = 'Your request has been submitted successfully. We will reply for this as soon as possible. \n';
		$body = 'Thanks \n';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		
		wp_mail( $to, $subject, $body, $headers );
		echo json_encode('success');
	} else {
		echo json_encode('error');
	}
	die;
}