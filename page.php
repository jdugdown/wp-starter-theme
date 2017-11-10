<?php
/**
 * The default page template file.
 *
 * This is the template that displays all pages by default. Pages may be
 * assigned a different template via the template hierarchy.
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

	<main id="main" role="main">

		<div class="container">

			<?php the_title('<h1 class="page-title">', '</h1>'); ?>

			<?php the_content(); ?>

		</div>

	</main><!-- #main -->

<?php endwhile; ?>

<?php get_footer(); ?>
