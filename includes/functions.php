<?php

/**
 * Registers custom meta fields for hospital posts.
 *
 * This function registers the following meta fields:
 * - bloodbridge_hospital_latitude: The latitude coordinate of the hospital.
 * - bloodbridge_hospital_longitude: The longitude coordinate of the hospital.
 * - bloodbridge_hospital_address: The address of the hospital.
 * 
 * @return void
 */
function register_hospital_meta_fields() {
    $meta_fields = [
        'bloodbridge_hospital_latitude' => [
            'type'         => 'string',
            'description'  => 'The latitude coordinate of the hospital',
            'single'       => true,
            'show_in_rest' => true,
        ],
        'bloodbridge_hospital_longitude' => [
            'type'         => 'string',
            'description'  => 'The longitude coordinate of the hospital',
            'single'       => true,
            'show_in_rest' => true,
        ],
        'bloodbridge_hospital_address' => [
            'type'         => 'string',
            'description'  => 'The address of the hospital',
            'single'       => true,
            'show_in_rest' => true,
        ],
    ];

    foreach ($meta_fields as $key => $args) {
        register_post_meta('blood_request', $key, $args);
    }
}

// add_action('init', 'register_hospital_meta_fields');

/**
 * Registers custom meta fields for 'Blood Requests' post type.
 *
 * @return void
 */
function register_blood_requests_meta_fields() {
    $meta_fields = [
        'hospital_name' => [
            'type'         => 'string',
            'description'  => 'The name of the hospital',
            'single'       => true,
            'show_in_rest' => true,
        ],
        'hospital_location' => [
            'type'         => 'string',
            'description'  => 'The location of the hospital',
            'single'       => true,
            'show_in_rest' => true,
        ],
        'blood_group' => [
            'type'         => 'string',
            'description'  => 'The blood group required',
            'single'       => true,
            'show_in_rest' => true,
        ],
        'amount' => [
            'type'         => 'integer',
            'description'  => 'The amount of blood required',
            'single'       => true,
            'show_in_rest' => true,
        ],
        'booking_id' => [
            'type'         => 'integer',
            'description'  => 'The associated booking ID',
            'single'       => true,
            'show_in_rest' => true,
        ],
    ];

    foreach ($meta_fields as $key => $args) {
        register_post_meta('blood_request', $key, $args);
    }
}

add_action('init', 'register_blood_requests_meta_fields');


/**
 * Registers custom meta fields for 'Bookings' post type.
 *
 * @return void
 */
function register_bookings_meta_fields() {
    $meta_fields = [
        'booking_id' => [
            'type'         => 'integer',
            'description'  => 'The booking ID',
            'single'       => true,
            'show_in_rest' => true,
        ],
        'booking_date' => [
            'type'         => 'string',
            'description'  => 'The date of the booking',
            'single'       => true,
            'show_in_rest' => true,
        ],
        'recipient_id' => [
            'type'         => 'integer',
            'description'  => 'The ID of the recipient',
            'single'       => true,
            'show_in_rest' => true,
        ],
        'donor_id' => [
            'type'         => 'integer',
            'description'  => 'The ID of the donor',
            'single'       => true,
            'show_in_rest' => true,
        ],
    ];

    foreach ($meta_fields as $key => $args) {
        register_post_meta('bookings', $key, $args);
    }
}

add_action('init', 'register_bookings_meta_fields');
