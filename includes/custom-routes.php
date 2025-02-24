<?php

/**
 * Register custom REST API endpoint to register a new user
 * 
 * @return void
 */
function blood_bridge_register_user_endpoint() {
    register_rest_route('blood-bridge/v1', '/register-user', array(
        'methods'  => 'POST',
        'callback' => 'blood_bridge_register_user_callback',
        'permission_callback' => '__return_true',
    ));
}

add_action('rest_api_init', 'blood_bridge_register_user_endpoint');

/** 
 * Callback function to register a new user
 * 
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function blood_bridge_register_user_callback(WP_REST_Request $request) {
    $username      = sanitize_text_field($request->get_param('username'));
    $email         = sanitize_email($request->get_param('email'));
    $password      = $request->get_param('password');
    $first_name   = sanitize_text_field($request->get_param('first_name'));
    $last_name    = sanitize_text_field($request->get_param('last_name'));
    $phone_number = sanitize_text_field($request->get_param('phone_number'));
    $address       = sanitize_textarea_field($request->get_param('address'));
    $latitude       = sanitize_textarea_field($request->get_param('latitude'));
    $longitude       = sanitize_textarea_field($request->get_param('longitude'));
    $taxonomy_blood_group = sanitize_text_field($request->get_param('blood_group')); // New parameter for taxonomy


    // Validate required fields
    if ( empty($latitude) || empty($longitude) ) {
        return new WP_REST_Response(['message' => 'Latitude and Longitude are required.'], 400);
    }

    // Validate required fields
    if ( empty($username) || empty($email) || empty($password) || empty($first_name) || empty($last_name) || empty($address) || empty($taxonomy_blood_group) ) {
        return new WP_REST_Response(['message' => 'All the fields are required.'], 400);
    }

    if (username_exists($username) || email_exists($email)) {
        return new WP_REST_Response(['message' => 'Username or email already exists.'], 400);
    }

    // Create user
    $user_id = wp_create_user($username, $password, $email);

    if (is_wp_error($user_id)) {
        return new WP_REST_Response(['message' => 'User registration failed.'], 500);
    }

    // Set user role to subscriber
    wp_update_user([
        'ID'         => $user_id,
        'role'       => 'blood_contributor',
        'first_name' => $first_name,
        'last_name'  => $last_name
    ]);

    // Save custom user meta fields
    update_user_meta($user_id, 'bloodbridge_user_phone_number', $phone_number);
    update_user_meta($user_id, 'bloodbridge_user_address', $address);
    update_user_meta($user_id, 'bloodbridge_user_address_latitude', $latitude);
    update_user_meta($user_id, 'bloodbridge_user_address_longitude', $longitude);

    // Assign taxonomy term to user
    if (!empty($taxonomy_blood_group)) {
        // Assuming taxonomy is 'blood_group'
        wp_set_object_terms($user_id, $taxonomy_blood_group, 'blood_group');
    }
    
    return new WP_REST_Response([
        'message' => 'User registered successfully.',
        'user_id' => $user_id
    ], 200);
}



