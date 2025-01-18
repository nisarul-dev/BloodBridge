<?php

/**
 * Register custom post type: 'Blood Requests'
 */
function blood_request_custom_post_type() {
    $labels = array(
        'name'               => 'Blood Request Posts',
        'singular_name'      => 'Blood Request Post',
        'add_new'            => 'Add New Post',
        'all_items'          => 'All Posts',
        'add_new_item'       => 'Add New Post',
        'edit_item'          => 'Edit Post',
        'new_item'           => 'New Blood Request Post',
        'view_item'          => 'View Post',
        'search_item'        => 'Search Blood Request Posts',
        'not_found'          => 'No Blood Request Posts found',
        'not_found_in_trash' => 'No Blood Request Posts found in trash',
        'parent_item_colon'  => 'Parent Blood Request Post'
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'publicly_queryable' => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'supports'           => array(
            'title',
            'editor',
            'thumbnail',
            'custom-fields',
            'revisions',
        ),
        'taxonomies'         => array(),
        'menu_position'      => 1,
        'exclude_from_search'=> false,
        'menu_icon'   => 'dashicons-heart',
    );
    register_post_type('blood_request', $args );
}
add_action('init', 'blood_request_custom_post_type');

/**
 * Register custom post types: 'Bookings'
 */
function bookings_custom_post_type() {
    $labels = array(
        'name'               => 'Bookings',
        'singular_name'      => 'Booking',
        'add_new'            => 'Add New Booking',
        'all_items'          => 'All Bookings',
        'add_new_item'       => 'Add New Booking',
        'edit_item'          => 'Edit Booking',
        'new_item'           => 'New Booking',
        'view_item'          => 'View Booking',
        'search_item'        => 'Search Bookings',
        'not_found'          => 'No Bookings found',
        'not_found_in_trash' => 'No Bookings found in trash',
        'parent_item_colon'  => 'Parent Booking Post'
    );
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'publicly_queryable' => true,
        'query_var'          => true,
        'rewrite'            => true,
        'capability_type'    => 'post',
        'hierarchical'       => false,
        'supports'           => array(
            'title',
            'thumbnail',
            'custom-fields',
            'revisions',
        ),
        'taxonomies'         => array(),
        'menu_position'      => 2,
        'exclude_from_search'=> true,
        'menu_icon'   => 'dashicons-calendar-alt',
    );
    register_post_type('booking', $args );
}
add_action('init', 'bookings_custom_post_type');

