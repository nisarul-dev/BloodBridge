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

/**
 * Creating a custom User Role
 * @return void
 */
// function create_blood_contributor_role() {
//     // Define an array of post type slugs
//     $post_types = ['blood_request', 'booking'];

//     // Build capabilities based on post types
//     $capabilities = [
//         'read'                     => true,
//         'edit_posts'               => true, // Allows editing own posts (default post type)
//         'delete_posts'             => true, // Allows deleting own posts (default post type)
//         'publish_posts'            => true, // Allows publishing own posts (default post type)
//         'edit_published_posts'     => true, // Allows editing own published posts (default post type)
//         'upload_files'             => true, // Allows media uploads
//         'moderate_comments'        => true, // Can comment
//     ];

//     // Loop through post types and add their specific capabilities
//     foreach ($post_types as $post_type) {
//         $capabilities["edit_{$post_type}s"] = true;
//         $capabilities["publish_{$post_type}s"] = true;
//         $capabilities["delete_{$post_type}s"] = true;
//         $capabilities["edit_published_{$post_type}s"] = true;
//         $capabilities["edit_others_{$post_type}s"] = false; // Cannot edit others' posts
//         $capabilities["delete_others_{$post_type}s"] = false; // Cannot delete others' posts
//     }

//     // Create the custom user role
//     add_role(
//         'blood_contributor',
//         'Blood Contributor',
//         $capabilities
//     );
// }
// add_action('init', 'create_blood_contributor_role');




/**
 * Creating a custom User Role
 * @return void
 */
function create_blood_contributor_role() {
    // Define an array of post type slugs
    $post_types = ['blood_request', 'booking'];

    // Start with basic capabilities (no post/page access)
    $capabilities = [
        'read'              => true,  // Allow reading content
        'upload_files'      => true,  // Allow media uploads
        'moderate_comments' => true,  // Can comment
    ];

    // Loop through post types and add their specific capabilities
    foreach ($post_types as $post_type) {
        $capabilities["edit_{$post_type}s"]          = true;
        $capabilities["publish_{$post_type}s"]       = true;
        $capabilities["delete_{$post_type}s"]        = true;
        $capabilities["edit_published_{$post_type}s"] = true;
        $capabilities["edit_others_{$post_type}s"]   = false; // Cannot edit others' posts
        $capabilities["delete_others_{$post_type}s"] = false; // Cannot delete others' posts
    }

    // Create the custom user role
    add_role('blood_contributor', 'Blood Contributor', $capabilities);
}
add_action('init', 'create_blood_contributor_role');

