<?php
/**
 * The archive template file.
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
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<?php
				the_archive_title( '<h1 class="page-title display-4">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description lead">', '</div>' );
				?>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-lg-8 col-xl-9">

					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'components/post/single', 'excerpt' ); ?>

						<?php endwhile; ?>

						<?php // TODO: add pagination func here ?>

					<?php else : ?>

						<h2 class="single-title"><?php _e('No posts yet', 'wpst'); ?></h2>

					<?php endif; ?>

				</div>

				<?php get_sidebar(); ?>

			</div>
		</div>
	</main> <!-- main -->

<?php get_footer(); ?>
