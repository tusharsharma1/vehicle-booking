<?php
function vehicle_add_custom_box() {
    $screens = [ 'vehicle' ];
    foreach ( $screens as $screen ) {
        add_meta_box(
            'vehicle_box_id',                 // Unique ID
            'Vehicle Extra Fields',      // Box title
            'vehicle_custom_box_html',  // Content callback, must be of type callable
            $screen                            // Post type
        );
    }
}
add_action( 'add_meta_boxes', 'vehicle_add_custom_box' );

function vehicle_custom_box_html( $post ) {
	$_price = get_post_meta( $post->ID, '_price', true );
    ?>
    <label for="wporg_field"><strong>Vehicle starting price ($) : </strong> </label>
    <input type="text" name="_price" value="<?php echo $_price; ?>" /> Per Day
    <?php
}

function vehicle_save_postdata( $post_id ) {
    if ( array_key_exists( '_price', $_POST ) ) {
        update_post_meta(
            $post_id,
            '_price',
            $_POST['_price']
        );
    }
}
add_action( 'save_post', 'vehicle_save_postdata' );