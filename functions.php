<?php
/**
 * Theme functions file
 *
 * Contains theme-specific functions and classes. Data-specific functions should
 * be placed in a custom plugin.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Sets up theme defaults and registers support for various features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook because he init hook is too late for some
 * features.
 */
function wpst_theme_setup() {
	/*
	 * Make theme available for translation.
	 */
	load_theme_textdomain( 'wpst' );

	/**
	 * Add default post and comment RSS feed links to head. Leave disabled
	 * unless site utilizes a blog.
	 */
	// add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 *
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'wpst-gallery-thumbnail', 250, 250, true );
	add_image_size( 'wpst-post-featured', 850, 350, true );

	/**
	 * Register header and footer navigation menus.
	 */
	register_nav_menus( array(
		'primary_navigation'    => __( 'Primary Navigation', 'wpst' ),
		'footer_links' => __( 'Footer Links', 'wpst' ),
	) );

	/*
	 * Switch default core markup to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'comment-form',
		'search-form',
		'gallery',
		'caption',
	) );

	/**
	 * Enable WooCommerce features.
	 */
	add_theme_support('woocommerce');
 	add_theme_support('wc-product-gallery-zoom');
 	add_theme_support('wc-product-gallery-lightbox');
 	add_theme_support('wc-product-gallery-slider');
}
add_action( 'after_setup_theme', 'wpst_theme_setup' );

/**
 * Register theme sidebars.
 */
function wpst_register_sidebars() {
	register_sidebar(array(
		'id'            => 'sidebar1',
		'name'          => 'Main Sidebar',
		'description'   => 'The default sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="widgettitle">',
		'after_title'   => '</h5>',
		));
}
add_action( 'widgets_init', 'wpst_register_sidebars' );

/**
 * Set the content width in pixels.
 *
 * Priority set to 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wpst_content_width() {
	$content_width = 1140;

	$GLOBALS['content_width'] = apply_filters( 'wpst_content_width', $content_width );
}
add_action( 'after_setup_theme', 'wpst_content_width', 0 );

/**
 * Clean up the <head> section.
 */
function wpst_head_cleanup() {
	remove_action('wp_head', 'feed_links_extra', 3);
	add_action('wp_head', 'ob_start', 1, 0);
	add_action('wp_head', function () {
		$pattern = '/.*' . preg_quote(esc_url(get_feed_link('comments_' . get_default_feed())), '/') . '.*[\r\n]+/';
		echo preg_replace($pattern, '', ob_get_clean());
	}, 3, 0);
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'wp_shortlink_wp_head', 10);
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');
	remove_action('wp_head', 'rest_output_link_wp_head', 10);
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('use_default_gallery_style', '__return_false');
	add_filter('emoji_svg_url', '__return_false');
	add_filter('show_recent_comments_widget_style', '__return_false');
}
add_action('init', 'wpst_head_cleanup');

/**
 * Disable XMLRPC.
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Disable WordPress theme and plugin editor.
 */
define( 'DISALLOW_FILE_EDIT', true );

/**
 * Custom editor stylesheet.
 */
add_editor_style('assets/css/editor.css');

/**
 * Use front-page.php when a static page is set to display as the front page.
 *
 * @since 1.0.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults
 * to index.php), else $template.
 */
function wpst_front_page_template( $template ) {
	if ( is_home() ) {
		return '';
	} else {
		return $template;
	}
}
add_filter( 'frontpage_template',  'wpst_front_page_template' );

/**
* Add a pingback url auto-discovery header for singularly identifiable articles.
*/
function wpst_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
	}
}
add_action( 'wp_head', 'wpst_pingback_header' );

/**
 * Add link after excerpts.
 *
 * Replaces [...] (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since 1.0.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function wpst_excerpt_more() {
	$link = sprintf( '<div class="link-more text-right"><a href="%1$s" class="btn btn-link">%2$s &rsaquo;</a></div>',
		esc_url( get_permalink( get_the_ID() ) ),

		sprintf( __( 'Continue reading', 'wpst' ), get_the_title( get_the_ID() ) )
	);

	return '&hellip;' . $link;
}
add_filter( 'excerpt_more', 'wpst_excerpt_more' );

/**
 * Set Yoast SEO metabox priority.
 *
 * Push the Yoast metabox down below the content and custom fields.
 *
 * @return string The assigned priority.
 */
function wpst_yoasttobottom() {
	return 'low';
}
add_filter( 'wpseo_metabox_prio', 'wpst_yoasttobottom');

/**
 * Customize Gravity Forms buttons.
 *
 * Change out the default Gravity Forms submit, next, and previous buttons to
 * match the theme.
 *
 * @param string $button Current string of button code.
 * @param string $form The form the button is tied to.
 * @return string The filtered button.
 */
function wpst_form_submit_button( $button, $form ) {
	$button = str_replace( 'input', 'button', $button );
	$button = str_replace( '/', '', $button );
	$button = str_replace( 'gform_button button', 'btn btn-primary', $button );
	$button .= "{$form['button']['text']}</button>";
	return $button;
}
add_filter( 'gform_submit_button', 'wpst_form_submit_button', 10, 5 );

function wpst_form_next_button( $button, $form ) {
	$button = str_replace( 'input', 'button', $button );
	$button = str_replace( '/', '', $button );
	$button = str_replace( 'gform_next_button button', 'btn btn-default', $button );
	$button .= 'Next</button>';
	return $button;
}
add_filter( 'gform_next_button', 'wpst_form_next_button', 10, 5 );

function wpst_form_previous_button( $button, $form ) {
	$button = str_replace( 'input', 'button', $button );
	$button = str_replace( '/', '', $button );
	$button = str_replace( 'gform_previous_button button', 'btn btn-default', $button );
	$button .= 'Previous</button>';
	return $button;
}
add_filter( 'gform_previous_button', 'wpst_form_previous_button', 10, 5 );

/**
 * Enqueue functions.
 */
require get_parent_theme_file_path( '/inc/enqueue-functions.php' );

/**
 * Navigation functions.
 */
require get_parent_theme_file_path( '/inc/nav-functions.php' );

/**
 * Pagination functions.
 */
require get_parent_theme_file_path( '/inc/pagination-functions.php' );

?>
