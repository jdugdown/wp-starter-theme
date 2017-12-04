<?php
/**
 * The search results template.
 *
 * This template is used when a search query is executed on the site.
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

	<div id="index">
		<div class="jumbotron jumbotron-fluid">
			<div class="container">
				<h1 class="page-title display-4"><small class="d-block"><?php _e('Search results for:', 'wpst'); ?></small> <?php echo esc_attr(get_search_query()); ?></h1>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<main class="col-lg-8 col-xl-9" role="main">

					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'components/post/single', 'excerpt' ); ?>

						<?php endwhile; ?>

						<?php wpst_pagination(); ?>

					<?php else : ?>

						<h2 class="single-title"><?php _e('Not Found', 'wpst'); ?></h2>

						<p class="lead"><?php _e('Your search returned zero results.', 'wpst'); ?></p>

					<?php endif; ?>

				</main>

				<?php get_sidebar('sidebar1'); ?>

			</div>
		</div>
	</div>

<?php get_footer(); ?>
