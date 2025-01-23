<?php

/**
 * Register the Taxonomy: 'Blood Group'
 * @return void
 */
function register_blood_group_taxonomy() {
    // Register the taxonomy
    register_taxonomy(
        'blood_group',
        ['blood_request', 'user'], // Associate with custom post type and users
        array(
            'public' => true,
            'labels' => array(
                'name' => 'Blood Groups',
                'singular_name' => 'Blood Group',
                'search_items' => 'Search Blood Groups',
                'all_items' => 'All Blood Groups',
                'edit_item' => 'Edit Blood Group',
                'update_item' => 'Update Blood Group',
                'add_new_item' => 'Add New Blood Group',
                'new_item_name' => 'New Blood Group Name',
                'menu_name' => 'Blood Groups',
            ),
            'hierarchical' => true, // Non-hierarchical like tags
            'show_ui' => true,
            'show_in_menu' => true,
            'show_admin_column' => true,
            'show_in_rest' => true,
        )
    );
}
add_action('init', 'register_blood_group_taxonomy');

/**
 * Add Taxonomy Support for Users: 'Blood Group' (Because, by default, taxonomies don’t apply to users by default)
 * @return void
 */
function add_blood_group_to_users() {
    register_taxonomy_for_object_type('blood_group', 'user');
}
add_action('init', 'add_blood_group_to_users');


