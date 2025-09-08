<?php

if ( !defined( 'WP_DEBUG' ) ) {
	die( 'Direct access forbidden.' );
}

add_action( 'wp_enqueue_scripts', 'cardzone_child_enqueue_styles', 99 );

/**
 * Enqueues the child theme stylesheet.
 *
 * This function is responsible for enqueuing the child theme stylesheet by using the wp_enqueue_style() function.
 * The stylesheet is enqueued with the handle 'parent-style' and the source is set to the URI of the parent theme's style.css file.
 *
 * @return void
 */
function cardzone_child_enqueue_styles() {
   wp_enqueue_style( 'parent-style', get_stylesheet_directory_uri() . '/style.css' );
}