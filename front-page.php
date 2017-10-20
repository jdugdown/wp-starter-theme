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
get_header(); ?>

	<main id="main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

		<?php the_title('<h1 class="single-title">', '</h1>'); ?>

		<?php the_content(); ?>

		<?php endwhile; ?>

	</main><!-- #main -->

<?php get_footer(); ?>
