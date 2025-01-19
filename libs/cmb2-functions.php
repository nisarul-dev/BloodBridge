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
	 * ===============================================================
	 * Metabox for "Blood Request" Post Type: $blood_request_post_type
	 * ===============================================================
	 */
	$blood_request_post_type = new_cmb2_box( array(
		'id'            => 'bloodbridge_blood_request_posts_metabox',
		'title'         => esc_html__( 'Blood Request Post Fields', 'cmb2' ),
		'object_types'  => array( 'blood_request' ), // Post type
	) );

	// Blood Group
	$blood_request_post_type->add_field( array(
		'name' => esc_html__( 'Blood Group', 'cmb2' ),
		'desc' => esc_html__( 'Enter Blood Group', 'cmb2' ),
		'id'   => 'bloodbridge_blood_group',
		'type' => 'text',
	) );

	// Blood Amount
	$blood_request_post_type->add_field( array(
		'name' => esc_html__( 'Blood Amount', 'cmb2' ),
		'desc' => esc_html__( 'Enter Blood Amount', 'cmb2' ),
		'id'   => 'bloodbridge_blood_amount',
		'type' => 'text',
	) );

	// Hospital Name
	$blood_request_post_type->add_field( array(
		'name'         => esc_html__( 'Hospital Name', 'cmb2' ),
		'desc'         => esc_html__( 'Enter hospital name', 'cmb2' ),
		'id'           => 'bloodbridge_hospital_name',
		'type'         => 'text',
	) );

	// Hospital Address
	$blood_request_post_type->add_field( array(
		'name'         => esc_html__( 'Hospital Address', 'cmb2' ),
		'desc'         => esc_html__( 'Enter hospital address', 'cmb2' ),
		'id'           => 'bloodbridge_hospital_address',
		'type'         => 'text',
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

	// Booking ID
	$blood_request_post_type->add_field( array(
		'name' => esc_html__( 'Booking ID', 'cmb2' ),
		'desc' => esc_html__( 'Enter Associated Booking ID', 'cmb2' ),
		'id'   => 'bloodbridge_booking_id',
		'type' => 'text',
	) );

	
	/**
	 * ===================================================
	 * Metabox for "Booking" Post Type: $booking_post_type
	 * ===================================================
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
		'type' => 'text_date',
	) );

	// The ID of the recipient
	$booking_post_type->add_field( array(
		'name' => esc_html__( 'Recipient ID', 'cmb2' ),
		'desc' => esc_html__( 'The User ID of the recipient', 'cmb2' ),
		'id'   => 'bloodbridge_booking_recipient_id',
		'type' => 'text',
	) );

	// The ID of the donor
	$booking_post_type->add_field( array(
		'name'         => esc_html__( 'Donor ID', 'cmb2' ),
		'desc'         => esc_html__( 'The User ID of the donor', 'cmb2' ),
		'id'           => 'bloodbridge_booking_donor_id',
		'type'         => 'text',
	) );


	/**
	 * ===================================
	 * Metabox for the USER PROFILE screen
	 * ===================================
	 */
	$cmb_user = new_cmb2_box( array(
		'id'               => 'bloodbridge_edit',
		'title'            => __( 'User Profile Metabox', 'cmb2' ), // Doesn't output for user boxes
		'object_types'     => array( 'user' ), // Tells CMB2 to use user_meta vs post_meta
		'show_names'       => true,
		'new_user_section' => 'add-new-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
	) );

	// Fields for user profile screen
	$cmb_user->add_field( array(
		'name'     => __( 'User Profile Screen Fields', 'cmb2' ),
		'desc'     => __( 'Custom Meta Fields for User Profile Screen', 'cmb2' ),
		'id'       => 'bloodbridge_extra_info',
		'type'     => 'title',
		'on_front' => false,
	) );

	// User Profile Avatar
	$cmb_user->add_field( array(
		'name'    => __( 'Profile Avatar', 'cmb2' ),
		'desc'    => __( '', 'cmb2' ),
		'id'      => 'bloodbridge_user_avatar',
		'type'    => 'file',
	) );

	// User's Phone Number
	$cmb_user->add_field( array(
		'name' => __( 'Phone Number', 'cmb2' ),
		'desc' => __( 'User\'s Phone Number', 'cmb2' ),
		'id'   => 'bloodbridge_user_phone_number',
		'type' => 'text',
	) );

	// User's Blood Group
	$cmb_user->add_field( array(
		'name' => __( 'Blood Group', 'cmb2' ),
		'desc' => __( 'Select User\'s Blood Group', 'cmb2' ),
		'id'   => 'bloodbridge_user_text_field',
		'type' => 'text',
	) );

	// User's Address
	$cmb_user->add_field( array(
		'name' => __( 'Present Address', 'cmb2' ),
		'desc' => __( 'User\'s Present Home Location Address', 'cmb2' ),
		'id'   => 'bloodbridge_user_address',
		'type' => 'text',
	) );

	// User's Address Latitude
	$cmb_user->add_field( array(
		'name' => __( 'Address Latitude', 'cmb2' ),
		'desc' => __( 'Home Location Address\'s Latitude', 'cmb2' ),
		'id'   => 'bloodbridge_user_address_latitude',
		'type' => 'text',
	) );

	// User's Address Longitude
	$cmb_user->add_field( array(
		'name' => __( 'Address Longitude', 'cmb2' ),
		'desc' => __( 'Home Location Address\'s Longitude', 'cmb2' ),
		'id'   => 'bloodbridge_user_address_longitude',
		'type' => 'text',
	) );




}
