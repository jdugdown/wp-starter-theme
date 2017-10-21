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
	// TODO: add relevant image sizes

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
		'comment-form',
		'comment-list',
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
 * Disable XMLRPC
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Disable WordPress theme and plugin editor
 */
define( 'DISALLOW_FILE_EDIT', true );

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
 * Register and enqueue stylesheets
 */
function wpst_scripts() {
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
// TODO: Clean up styles

/**
 * Add link after excerpts.
 *
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since 1.0.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function wpst_excerpt_more() {
	$link = sprintf( '<p class="link-more text-center text-sm-right"><a href="%1$s" class="more-link">%2$s &rsaquo;</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),

		sprintf( __( 'Continue reading', 'wpst' ), get_the_title( get_the_ID() ) )
	);

	return '&hellip;' . $link;
}
add_filter( 'excerpt_more', 'wpst_excerpt_more' );

?>
