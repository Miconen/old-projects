<?php
/*
Plugin Name: Mico WP Dev Plugin
Plugin URI: localhost
Description: Mico plugin
Version: 0.1.0
Author: Mico
Author URI: localhost
Text Domain: mico-plugin
Domain Path: /languages
*/

// Add custom post type
require('assets/custom-post-type.php');

// Add custom taxonomy
require('assets/custom-taxonomy.php');

// Add custom meta boxes
require('assets/custom-meta.php');

// Add shortcode support
require('assets/shortcode-support.php');

// Add possibility to filter visible custom posts by taxonomy
require('assets/taxonomy-filter.php');

function slug_get_post_meta_cb( $object, $field_name, $request ) {
    return get_post_meta( $object[ 'id' ], $field_name );
}

function slug_update_post_meta_cb( $value, $object, $field_name ) {
    return update_post_meta( $object[ 'id' ], $field_name, $value );
}

add_action( 'rest_api_init', function() {
 register_rest_field( 'employee',
    'contact',
    array(
       'get_callback'    => 'slug_get_post_meta_cb',
       'update_callback' => 'slug_update_post_meta_cb',
       'schema'          => null,
    )
 );

});
