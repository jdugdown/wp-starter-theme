<?php
/**
 * Script and style includes.
 *
 * Contains functions, filters, and actions related to enqueuing scripts and
 * styles.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

/**
 * Register and enqueue stylesheets
 */
function wpst_styles() {
	// Bootstrap CSS
	wp_register_style(
		'bootstrap-styles',
		'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css',
		array(),
		'4.0.0-beta',
		'all' );
	wp_enqueue_style( 'bootstrap-styles' );

	// FontAwesome
	// wp_register_style( 'fontawesome',
	// 	'//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
	// 	array(),
	// 	'4.7.0',
	// 	'all' );
	// wp_enqueue_style( 'fontawesome' );

	// Material Design Icons
	// wp_register_style( 'material-design-icons',
	// 	'//cdn.materialdesignicons.com/2.0.46/css/materialdesignicons.min.css',
	// 	array(),
	// 	'2.0.46',
	// 	'all' );
	// wp_enqueue_style( 'material-design-icons' );

	// if ( is_front_page() ) {
	// 	// Slick
	// 	wp_register_style( 'slick',
	// 		'//cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css',
	// 		array(),
	// 		'1.6.0',
	// 		'all' );
	// 	wp_enqueue_style( 'slick' );
	// }

	// blueimp gallery
	// wp_register_style( 'blueimp-gallery',
	// 	get_stylesheet_directory_uri() . '/lib/blueimp/css/blueimp-gallery.min.css',
	// 	array(),
	// 	null,
	// 	'all' );
	// wp_enqueue_style( 'blueimp-gallery' );

	// Google Fonts
	// wp_register_style( 'googlefonts',
	// 	'//fonts.googleapis.com/css?family=Open+Sans:300,400,400italic,600,700,800|Open+Sans+Condensed:300,700',
	// 	array(),
	// 	null,
	// 	'all' );
	// wp_enqueue_style( 'googlefonts' );

	// Theme CSS
	// wp_register_style( 'wpst-styles',
	// 	get_stylesheet_directory_uri() . '/css/main.min.css',
	// 	array(),
	// 	time(),
	// 	'all' );
	// wp_enqueue_style( 'wpst-styles' );
}
add_action( 'wp_enqueue_scripts', 'wpst_styles' );

/**
 * Register and enqueue JavaScript
 */
function wpst_scripts() {
	// Popper JS
	wp_register_script(
		'popper',
		'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js',
		array( 'jquery' ),
		'1.12.3',
		true
	);
	wp_enqueue_script( 'popper' );

	// Bootstrap JS
	wp_register_script(
		'bootstrap-js',
		'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js',
		array( 'jquery', 'popper' ),
		'4.0.0-beta',
		true
	);
	wp_enqueue_script( 'bootstrap-js' );
}
add_action( 'wp_enqueue_scripts', 'wpst_scripts' );
