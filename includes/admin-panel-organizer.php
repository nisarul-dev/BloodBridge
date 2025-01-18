<?php

/**
 * Disabling dashboard menu 
 */
function disable_dashboard_menus() {
    // Remove specific dashboard menus
    remove_menu_page('index.php'); // Dashboard
}
add_action('admin_menu', 'disable_dashboard_menus', 999);

/**
 * Code to Add a Custom Login Logo
 */

function my_custom_login_logo() {
    echo '<style>
        .login h1 a {
            background-image: url("' . plugin_dir_url(__FILE__) . '../assets/images/blood-bridge-logo.png") !important;
            background-size: contain;
            width: 100%;
            height: 80px;
        }
    </style>';
}
add_filter( 'login_head', 'my_custom_login_logo' );

/**
 * Customizing the Login Logo Title
 */
function custom_login_logo_url_title() {
    return 'Welcome to My Website'; // Change the text here
}
add_filter('login_headertitle', 'custom_login_logo_url_title');

/**
 * Customizing the Login URL
 */
function custom_login_logo_url() {
    return home_url(); // Link to your site
}
add_filter('login_headerurl', 'custom_login_logo_url');


/**
 * Hide the WordPress Logo from the Admin Bar 
 */
function hide_wp_logo_from_admin_bar($wp_admin_bar) {
    $wp_admin_bar->remove_node('wp-logo');
}
add_action('admin_bar_menu', 'hide_wp_logo_from_admin_bar', 999);

/**
 * Change "Post" to "Blog Post" in the WordPress menu or admin interface
 */
function change_post_object_labels() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;

    $labels->name = 'Blog Posts';
    $labels->singular_name = 'Blog Post';
    $labels->menu_name = 'Blog Posts';
    $labels->name_admin_bar = 'Blog Post';
}
add_action('init', 'change_post_object_labels');