<?php
/**
 * The archive template file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */
get_header(); ?>

	<main id="index" role="main">
		<div class="container">

			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>

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
