<?php
if ( file_exists( plugin_dir_path(__FILE__) . 'cmb2/init.php' ) ) {
	require_once plugin_dir_path(__FILE__) . 'cmb2/init.php';
}

add_action( 'cmb2_admin_init', 'bloodbridge_register_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function bloodbridge_register_metabox() {
	/**
	 * Metabox for "Blood Request" Post Type: $blood_request_post_type
	 */
	$blood_request_post_type = new_cmb2_box( array(
		'id'            => 'bloodbridge_blood_request_posts_metabox',
		'title'         => esc_html__( 'Blood Request Post Fields', 'cmb2' ),
		'object_types'  => array( 'blood_request' ), // Post type
	) );

	// Hospital Latitude
	$blood_request_post_type->add_field( array(
		'name' => esc_html__( 'Hospital Latitude', 'cmb2' ),
		'desc' => esc_html__( 'Enter hospital location\'s latitude', 'cmb2' ),
		'id'   => 'bloodbridge_hospital_latitude',
		'type' => 'text',
	) );

	// Hospital Longitude
	$blood_request_post_type->add_field( array(
		'name' => esc_html__( 'Hospital Longitude', 'cmb2' ),
		'desc' => esc_html__( 'Enter hospital location\'s longitude', 'cmb2' ),
		'id'   => 'bloodbridge_hospital_longitude',
		'type' => 'text',
	) );

	// Hospital Address
	$blood_request_post_type->add_field( array(
		'name'         => esc_html__( 'Hospital Address', 'cmb2' ),
		'desc'         => esc_html__( 'Enter hospital address', 'cmb2' ),
		'id'           => 'bloodbridge_hospital_address',
		'type'         => 'text',
	) );

	// Hospital Address
	$blood_request_post_type->add_field( array(
		'name'         => esc_html__( 'Hospital Address', 'cmb2' ),
		'desc'         => esc_html__( 'Enter hospital address', 'cmb2' ),
		'id'           => 'bloodbridge_hospital_address',
		'type'         => 'text',
	) );


	/**
	 * Metabox for "Booking" Post Type: $booking_post_type
	 */
	$booking_post_type = new_cmb2_box( array(
		'id'            => 'bloodbridge_booking_metabox',
		'title'         => esc_html__( 'Booking Fields', 'cmb2' ),
		'object_types'  => array( 'booking' ), // Post type
	) );

	// The date of the booking
	$booking_post_type->add_field( array(
		'name' => esc_html__( 'Booking Date', 'cmb2' ),
		'desc' => esc_html__( 'Appointment Date of the blood donation', 'cmb2' ),
		'id'   => 'bloodbridge_booking_date',
		'type' => 'date',
	) );

	// The ID of the recipient
	$blood_request_post_type->add_field( array(
		'name' => esc_html__( 'Recipient ID', 'cmb2' ),
		'desc' => esc_html__( 'The User ID of the recipient', 'cmb2' ),
		'id'   => 'bloodbridge_booking_recipient_id',
		'type' => 'number',
	) );

	// The ID of the donor
	$blood_request_post_type->add_field( array(
		'name'         => esc_html__( 'Donor ID', 'cmb2' ),
		'desc'         => esc_html__( 'The User ID of the donor', 'cmb2' ),
		'id'           => 'bloodbridge_booking_donor_id',
		'type'         => 'number',
	) );




	/**
	 * Simple slider metabox
	 */
	/* $simple_slider = new_cmb2_box( array(
		'id'            => 'bloodbridge_simple_slider_metabox',
		'title'         => esc_html__( 'Simple Slider Fields', 'cmb2' ),
		'object_types'  => array( 'simple_slider' ), // Post type
	) );

	$simple_slider->add_field( array(
		'name' => esc_html__( 'Slider Subtitle', 'cmb2' ),
		'id'   => 'simple-slider-subtitle',
		'type' => 'textarea_small',
	) );

	$button_fields_group_id = $simple_slider->add_field( array(
		'id'                => '_button_fields',
		'type'              => 'group',
		'description'       => 'Add button, name it, set URL and select an pre-made style',
		'options'           => array(
			'group_title'   => 'Button {#}',
			'add_button'    => 'Add Another Button',
			'remove_button' => 'Remove Button',
			'sortable'      => true
		)
	) );

	$simple_slider->add_group_field( $button_fields_group_id, array(
		'name' => esc_html__( 'Button Text', 'cmb2' ),
		'id'   => '_simple_slider_button_text', // This is how the ID should be wirtten in CMB2
		'type' => 'text',
	) );

	$simple_slider->add_group_field( $button_fields_group_id, array(
		'name' => esc_html__( 'Button Link', 'cmb2' ),
		'id'   => '_simple_slider_button_link',
		'type' => 'text_url',
	) );

	$simple_slider->add_group_field( $button_fields_group_id, array(
		'name' => esc_html__( 'Button Style', 'cmb2' ),
		'id'   => '_simple_slider_button_style',
		'type' => 'radio',
		'options'          => array(
			'style-one' => __(
				'<span style="display:table-cell;vertical-align:middle;height:50px;" >
					Style One: &nbsp&nbsp
				</span>
				<img style="height:50px;" src="' . get_template_directory_uri() . '/images/button-style-1.png' . '">',
			'cmb2' ),
			'style-two'   => __(
				'<span style="display:table-cell;vertical-align:middle;height:50px;" >
					Style Two: &nbsp&nbsp
				</span>
				<img style="height:50px;" src="' . get_template_directory_uri() . '/images/button-style-2.png' . '">',
			'cmb2' ),
		),
	) ); */

}
