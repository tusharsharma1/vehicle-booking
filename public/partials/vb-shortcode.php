<?php
add_shortcode( 'vb_form', 'vb_form_callback_function' );
function vb_form_callback_function() {

	$terms = get_terms(array(
			    'taxonomy' => 'vehicle_type',
			    'hide_empty' => false,
			));
	$type = '';
	$vehicleName = '';
	foreach($terms as $term) {
		$type .= '<option value="'. $term->term_id .'">'. $term->name .'</option>';

		$vehicleArgs = array(
			  	'numberposts' => -1,
			  	'post_type'   => 'vehicle',
		        'tax_query' => array(
		            array(
		                'taxonomy' => 'vehicle_type',
		                'field' => 'term_id',
		                'terms' => $term->term_id,
		            )
		        )
			);
		$vehicles = get_posts( $vehicleArgs );
		foreach($vehicles as $vehicle) {
			$price = get_post_meta($vehicle->ID, '_price', true);
			$vehicleName .= '<option data-price="'.$price.'" class="vehicle-option disabled term-'. $term->term_id .'" value="'. $vehicle->ID .'">'. $vehicle->post_title .'</option>';
		}

	}

    $html = '<div class="vehicle-booking-form">
    			<form action="" method="post" id="booking_form">
	    			<div class="field-group">
					  <label for="fname">First name</label>
					  <input type="text" id="fname" name="fname">
					</div>
	    			<div class="field-group">
					  <label for="lname">Last name</label>
					  <input type="text" id="lname" name="lname">
					</div>
	    			<div class="field-group">
					  <label for="email">Email</label>
					  <input type="text" id="email" name="email">
					</div>
	    			<div class="field-group">
					  <label for="phone">Phone</label>
					  <input type="text" id="phone" name="phone">
					</div>
	    			<div class="field-group">
					  <label for="vehicle_type">Vehicle Type</label>
					  <select id="vehicle_type" name="vehicle_type">
					  	<option value="">select vehicle type</option>
					  	'. $type .'
					  </select>
					</div>
	    			<div class="field-group">
					  	<label for="vehicle">Vehicle</label>
					  	<select id="vehicle" name="vehicle">
					  		<option value="">select vehicle</option>
					  		'. $vehicleName .'
					  	</select>
					</div>
	    			<div class="field-group">
	    			<label><strong>Vehicle Price:</strong> <span class="v_price"></span></label>
	    			</div>
	    			<div class="field-group">
					  <label for="message">Message</label>
					  <textarea id="message" name="message"></textarea>
					</div>
	    			<div class="field-group">
					  <input id="submit_booking" type="submit" value="Submit">
					  <div class="responseMessage"></div>
					</div>
				</form>
			</div>';
	return $html;
}