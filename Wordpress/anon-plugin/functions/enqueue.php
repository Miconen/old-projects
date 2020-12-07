<?php
function slick_enqueue_script() {
    wp_enqueue_script( 'slick-js', plugin_dir_url( __FILE__ ) . 'js/slick.min.js', array('jquery'));
    wp_enqueue_script( 'main-js', plugin_dir_url( __FILE__ ) . 'js/main.js', array('jquery'));
}

function slick_enqueue_style() {
    wp_enqueue_style( 'slick-css', plugin_dir_url( __FILE__ ) . 'css/slick.css' );
    wp_enqueue_style( 'slick-theme', plugin_dir_url( __FILE__ ) . 'css/slick.theme.css' );
}

add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\slick_enqueue_script');
add_action('wp_enqueue_style', __NAMESPACE__ . '\\slick_enqueue_style');
?>
