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
    $medical_condition       = sanitize_textarea_field($request->get_param('medical_condition'));
    $smoker       = sanitize_textarea_field($request->get_param('smoker'));


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
    update_user_meta($user_id, 'bloodbridge_user_medical_condition', $medical_condition);
    update_user_meta($user_id, 'bloodbridge_user_smoker', $smoker);

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




// Register REST API endpoint
add_action('rest_api_init', function () {
    register_rest_route('bloodbridge/v1', '/user/', [
        'methods'  => 'GET',
        'callback' => 'blood_bridge_get_user_callback',
        'permission_callback' => '__return_true',
    ]);
});

/** 
 * Callback function to get user data by username
 * 
 * @param WP_REST_Request $request
 * @return WP_REST_Response
 */
function blood_bridge_get_user_callback(WP_REST_Request $request) {
    $username = sanitize_text_field($request->get_param('username'));
    
    if (empty($username)) {
        return new WP_REST_Response(['message' => 'Username is required.'], 400);
    }

    $user = get_user_by('login', $username);
    
    if (!$user) {
        return new WP_REST_Response(['message' => 'User not found.'], 404);
    }

    // Retrieve user meta data
    $user_data = [
        'id'            => $user->ID,
        'username'      => $user->user_login,
        'email'         => $user->user_email,
        'first_name'    => get_user_meta($user->ID, 'first_name', true),
        'last_name'     => get_user_meta($user->ID, 'last_name', true),
        'phone_number'  => get_user_meta($user->ID, 'bloodbridge_user_phone_number', true),
        'address'       => get_user_meta($user->ID, 'bloodbridge_user_address', true),
        'latitude'      => get_user_meta($user->ID, 'bloodbridge_user_address_latitude', true),
        'longitude'     => get_user_meta($user->ID, 'bloodbridge_user_address_longitude', true),
        'medical_condition' => get_user_meta($user->ID, 'bloodbridge_user_medical_condition', true),
        'smoker'        => get_user_meta($user->ID, 'bloodbridge_user_smoker', true),
        'blood_group'   => wp_get_object_terms($user->ID, 'blood_group', ['fields' => 'names'])
    ];
    
    return new WP_REST_Response($user_data, 200);
}






function blood_bridge_get_users_callback(WP_REST_Request $request) {
    $blood_group = sanitize_text_field($request->get_param('blood_group'));
    $latitude = sanitize_text_field($request->get_param('latitude'));
    $longitude = sanitize_text_field($request->get_param('longitude'));
    $smoker = sanitize_text_field($request->get_param('smoker'));

    $args = [
        'role'    => 'blood_contributor',
        'number'  => -1
    ];

    $user_query = new WP_User_Query($args);
    $users = $user_query->get_results();

    $filtered_users = [];
    
    foreach ($users as $user) {
        $user_id = $user->ID;
        $user_blood_group = wp_get_object_terms($user_id, 'blood_group', ['fields' => 'names']);
        $user_latitude = get_user_meta($user_id, 'bloodbridge_user_address_latitude', true);
        $user_longitude = get_user_meta($user_id, 'bloodbridge_user_address_longitude', true);
        $user_smoker = get_user_meta($user_id, 'bloodbridge_user_smoker', true);
        
        // Filter users based on criteria
        if ($blood_group && !in_array($blood_group, $user_blood_group)) continue;
        if ($smoker !== '' && $smoker != $user_smoker) continue;
        
        $distance = ($latitude && $longitude) ? haversine_distance($latitude, $longitude, $user_latitude, $user_longitude) : null;
        
        $filtered_users[] = [
            'id' => $user_id,
            'name' => get_user_meta($user->ID, 'first_name', true) . ' ' . get_user_meta($user->ID, 'last_name', true),
            'username' => $user->user_login,
            'email' => $user->user_email,
            'phone' => get_user_meta($user_id, 'bloodbridge_user_phone_number', true),
            'address' => get_user_meta($user_id, 'bloodbridge_user_address', true),
            'blood_group' => $user_blood_group,
            'smoker' => $user_smoker,
            'distance_from_hospital' => $distance
        ];
    }
    
    if ($latitude && $longitude) {
        usort($filtered_users, function ($a, $b) {
            return $a['distance_from_hospital'] <=> $b['distance_from_hospital'];
        });
    }
    
    return new WP_REST_Response($filtered_users, 200);
}

// Haversine formula to calculate distance between two lat/lng points
function haversine_distance($lat1, $lon1, $lat2, $lon2) {
    if (!$lat1 || !$lon1 || !$lat2 || !$lon2) return null;
    $earth_radius = 6371; // Earth's radius in km

    $dLat = deg2rad($lat2 - $lat1);
    $dLon = deg2rad($lon2 - $lon1);
    
    $a = sin($dLat / 2) * sin($dLat / 2) +
         cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
         sin($dLon / 2) * sin($dLon / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
    return round($earth_radius * $c, 2); // Distance in km
}

// Register REST API endpoint
add_action('rest_api_init', function () {
    register_rest_route('bloodbridge/v1', '/users/', [
        'methods'  => 'GET',
        'callback' => 'blood_bridge_get_users_callback',
        'permission_callback' => '__return_true',
    ]);
});


