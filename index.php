<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * It is used to display a page when nothing more specific matches a query.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); ?>

	<main id="index" role="main">
		<div class="container">

			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'components/post/single' ); ?>

				<?php endwhile; ?>

				<?php // TODO: add pagination func here ?>

			<?php else : ?>

				<h1 class="single-title"><?php _e('No posts yet', 'wpst'); ?></h1>

			<?php endif; ?>

		</div>
	</main> <!-- main -->

<?php get_footer(); ?>
