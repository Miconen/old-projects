<?php
// Remove wp emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );

// Enqueue styles & scripts from Bootstrap and theme
function theme_media_enqueue() {
    // all styles
    wp_enqueue_style( 'theme-style', get_stylesheet_directory_uri() . '/style.css', array(), '1' );
    // all scripts
    wp_enqueue_script( 'theme-script', get_template_directory_uri() . '/main.js', array(), '1', true );
}
add_action( 'wp_enqueue_scripts', 'theme_media_enqueue' );

function myprefix_enqueue_google_fonts() {
	wp_enqueue_style( 'roboto', 'https://fonts.googleapis.com/css?family=Roboto' );
}
add_action( 'wp_enqueue_scripts', 'myprefix_enqueue_google_fonts' );

require('showmore.php');

?>
