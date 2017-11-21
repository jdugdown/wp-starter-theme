<?php
/**
 * The 404 page.
 *
 * This is the template that displays when a 404 error is triggered.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<main id="error404" role="main">

		<div class="container text-center">

			<h1 class="page-title"><?php _e('Error 404', 'wpst'); ?></h1>

            <h3><?php _e('The requested page or resource was not found', 'jwdmc'); ?></h3>

		</div>

	</main><!-- #main -->

<?php get_footer(); ?>
