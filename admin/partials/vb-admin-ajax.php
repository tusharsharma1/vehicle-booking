<?php
function my_jx_cll() {
	check_ajax_referer('status_nonce','nonce');

	global $wpdb;
	$table_name = $wpdb->prefix . 'v_booking_info';

	$v_id = $_POST['id'];
    $status = $_POST['status'];
    
    $updated = $wpdb->update( $table_name, array(
        "status" => $status
    ), array("id"=>$v_id) );

	if($updated) {
		$results = $wpdb->get_results ( "SELECT email FROM " . $table_name . " WHERE id = " . $v_id  );
		$email = $results[0]->email;
		$to = $email;
		$subject = 'Changes your requst status. Please check your request status.';
		$body = '<h1>Changes on your request mention below<h1>\n\n';
		$body .= 'Hello \n';
		$body .= 'There are some changes done on your requets by admin. Please visit the website.\n';
		$body .= 'Thanks';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		
		wp_mail( $to, $subject, $body, $headers );
		echo json_encode('success');
	} else {
		echo json_encode('error');
	}
	die;

}

add_action("wp_ajax_my_action_hook", "my_jx_cll");
add_action("wp_ajax_nopriv_my_action_hook", "my_jx_cll");