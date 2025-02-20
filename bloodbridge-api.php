<?php
/*
Plugin Name: BloodBridge API
Description: Custom REST API for BloodBridge functionalities.
Version: 1.0
Author: Nisarul Amin Naim
*/

/**
 * Prevent direct access
 */
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Including Files and Libraries
 */

// Include Library CMB2 for custom metaboxs
if( file_exists( plugin_dir_path(__FILE__) . 'libs/cmb2-functions.php' ) ) {
    require_once plugin_dir_path(__FILE__) . 'libs/cmb2-functions.php';
}

// Include Custom Post Types (CPTs)
if( file_exists( plugin_dir_path(__FILE__) . 'includes/cpts.php' ) ) {
    require_once plugin_dir_path(__FILE__) . 'includes/cpts.php';
}

// Include functionalities
if( file_exists( plugin_dir_path(__FILE__) . 'includes/functions.php' ) ) {
    require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
}

// Include Admin Panel Organizer
if( file_exists( plugin_dir_path(__FILE__) . 'includes/admin-panel-organizer.php' ) ) {
    require_once plugin_dir_path(__FILE__) . 'includes/admin-panel-organizer.php';
}

// Include Custom Rest API Routes
if( file_exists( plugin_dir_path(__FILE__) . 'includes/custom-routes.php' ) ) {
    require_once plugin_dir_path(__FILE__) . 'includes/custom-routes.php';
}











