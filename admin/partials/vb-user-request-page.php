<?php
function user_request_callback() {
	global $wpdb;
	$table_name = $wpdb->prefix . 'v_booking_info';
	$results = $wpdb->get_results ( "SELECT * FROM ".$table_name );
	//echo "<pre>";
	//print_r($results);
	//echo "</pre>";
	?>
	<table border="1" style="width:100%;margin-top:30px;">
		<thead>
			<tr>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Vehcile Type</th>
				<th>Vehicle</th>
				<th>Message</th>
				<th>Status</th>
				<th>Requested on</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($results as $key => $value) { ?>
				<tr>
					<td><?php echo $value->f_name; ?></td>
					<td><?php echo $value->l_name; ?></td>
					<td><?php echo $value->email; ?></td>
					<td><?php echo $value->phone; ?></td>
					<td><?php echo $value->vehicle_type; ?></td>
					<td><?php echo $value->vehicle; ?></td>
					<td><?php echo $value->message; ?></td>
					<td>
						<form id="statusChange" method="post">
							<select name="status">
								<option value="0" <?php if($value->status == '0') { echo "selected"; }; ?>>Pending</option>
								<option value="1" <?php if($value->status == '1') { echo "selected"; }; ?>>Approved</option>
								<option value="2" <?php if($value->status == '2') { echo "selected"; }; ?>>Reject</option>
								<option value="3" <?php if($value->status == '3') { echo "selected"; }; ?>>On the way</option>
								<option value="4" <?php if($value->status == '4') { echo "selected"; }; ?>>Complete</option>
							</select>
							<input type="hidden" name="admin_url" value="<?php echo admin_url('admin-ajax.php'); ?>" />
							<input type="hidden" name="status_nonce" value="<?php echo wp_create_nonce('status_nonce'); ?>" />
							<input type="hidden" name="vehicle_id" value="<?php echo $value->id; ?>" />
							<span><?php submit_button(); ?></span>
						</form>
					</td>
					<td><?php echo $value->time; ?></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<?php
}