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

	<main id="page-default" role="main">

		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<?php the_title('<h1 class="page-title display-4">', '</h1>'); ?>
			</div>
		</div>

		<div class="container">
			<?php the_content(); ?>
		</div>

	</main><!-- #main -->

<?php endwhile; ?>

<?php get_footer(); ?>
