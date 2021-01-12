<?php
/**
 * Child theme functions
 *
 * @package Divi
 */

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
function divi_child_scripts() {
	// Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme).
	$theme   = wp_get_theme( 'divi' );
	$version = $theme->get( 'Version' );
	// Load the stylesheet.
	wp_enqueue_style( 'divi-style', get_template_directory_uri() . '/style.css', array(), $version );
	wp_enqueue_style( 'divi-child-style', get_stylesheet_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'divi_child_scripts' );


/**
 * Add at a glance to left section
 */
add_action( 'auto_listings_before_listings_loop_item_summary', 'auto_listings_template_loop_at_a_glance', 20 );

/**
 * Add description
 */
remove_action( 'auto_listings_listings_loop_item', 'auto_listings_template_loop_description', 50 );
