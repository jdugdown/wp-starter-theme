<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
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

<?php while ( have_posts() ) : the_post(); ?>

	<main id="front-page" role="main">

		<div class="container">

			<h1 class="page-title"><?php bloginfo('title'); ?></h1>

			<?php the_content(); ?>

		</div>

	</main><!-- #main -->

<?php endwhile; ?>

<?php get_footer(); ?>
