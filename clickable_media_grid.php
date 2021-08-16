<?php
/*
  Plugin Name: Clickable Media Grid
  Plugin URI: https://pocaconsulting.pt
  Description: Make clickable media grids.
  Version: 1.0.0
  Author: Poça Consulting
  Author URI: https://pocaconsulting.pt
  Text Domain: clickable-media-grid
  Domain Path: /languages
*/

// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

if ( !class_exists( 'CMG_Clickable_Media_Grid_Admin' ) ) {
    include_once( 'admin/class-clickable-media-grid-admin.php' );
}

if ( !class_exists( 'CMG_Media_Grid_Type' ) ) {
    include_once( 'inc/class-clickable-media-grid-posttype.php' );
}


function wp_cmg_load_plugin_textdomain() {
    load_plugin_textdomain( 'clickable-media-grid', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'wp_cmg_load_plugin_textdomain' );

add_action( 'init', 'cmg_admin_init' );
function cmg_admin_init() {
    if ( is_admin() ) {
        new CMG_Clickable_Media_Grid_Admin();
    } else {
        new CMG_Media_Grid_Type();
    }
}