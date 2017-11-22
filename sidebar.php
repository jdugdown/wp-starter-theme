<?php
/**
 * The sidebar for placing widgets.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if using a different sidebar.
if ( ! is_active_sidebar( 'sidebar1' ) ) {
	return;
}
?>

<aside id="sidebar" class="col-lg-4 col-xl-3" role="complementary">
	<?php dynamic_sidebar( 'sidebar1' ); ?>
</aside> <!-- #sidebar -->
