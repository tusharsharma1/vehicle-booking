(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$("#statusChange").submit(function(e) {
		e.preventDefault();
		
		var id = $("input[name='vehicle_id']",this).val(); 
		var status = $("select[name='status']",this).val(); 
		var nonce = $("input[name='status_nonce']",this).val(); 
		var admin_ajax = $("input[name='admin_url']",this).val(); 
		
		$.ajax({
			url : admin_ajax,
			type : "POST",
			dataType : "json",
			data : {
				action: 'my_action_hook',
				nonce: nonce,
				id: id, 
				status: status
			},
			success: function(response) {
				if(response == "success") {
					alert("Updated Successfully.");
					location.reload();
				}
			}
		});
	});
})( jQuery );
