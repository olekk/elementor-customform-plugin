<?php
/**
 * Elementor Customform WordPress Plugin
 *
 * @package ElementorCustomform
 *
 * Plugin Name: Elementor customform
 * Description: Simple Elementor plugin
 * Plugin URI:  https://www.grupataka.pl/
 * Version:     1.0.0
 * Author:      Aleksander Cieśla
 * Author URI:  https://github.com/olekk
 * Text Domain: elementor-customform
 */

define( 'ELEMENTOR_CUSTOMFORM', __FILE__ );

require plugin_dir_path( ELEMENTOR_CUSTOMFORM ) . 'class-elementor-customform.php';

add_action('wp_enqueue_scripts','customform_init');

function customform_init() {
    wp_enqueue_script("jquery");
    wp_enqueue_script( 'customform', plugins_url( '/assets/js/customform.js', __FILE__, array('jquery') ));
    // add_filter('script_loader_tag', 'add_type_attribute' , 10, 3);
}

// function add_type_attribute($tag, $handle, $src) {
//     // if not your script, do nothing and return original $tag
//     if ( 'locationslsit' !== $handle ) {
//         return $tag;
//     }
//     // change the script tag by adding type="module" and return it.
//     $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
//     return $tag;
// }
