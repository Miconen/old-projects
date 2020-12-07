<?php
/*
Plugin Name: anonymized API Shortcodes
Plugin URI: localhost
Description: anonymized API Shortcode support
Version: 0.1.0
Author: Mico
Author URI: localhost
Text Domain: anonymized
Domain Path: /languages
*/

namespace anonymized;

if( ! defined( 'ABSPATH' ) ) {
    return;
}

// Admin dashboard plugin settings
require('functions/settings.php');

// Enqueue styles assssnd scripts
require('functions/enqueue.php');

// Shortcode functions and their requirements
// API call and transient
// $localization = array();
require('functions/transient.php');
// Carousel shortcode
require('functions/shortcode-carousel.php');


?>
