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

		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="page-title display-4"><?php _e('Error 404', 'wpst'); ?></h1>
			</div>
		</div>

		<div class="container">
            <h4><?php _e('The requested page or resource was not found', 'wpst'); ?></h4>
		</div>

	</main><!-- #main -->

<?php get_footer(); ?>
