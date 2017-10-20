<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * It is used to display a page when nothing more specific matches a query.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */
get_header(); ?>

	<main id="index" role="main">
		<div class="container">

			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<header class="entry-header">
							<?php the_post_thumbnail( 'large', array( 'class' => 'aligncenter' ) ); ?>

							<h1 class="single-title"><?php the_title(); ?></h1>

							<?php // TODO: convert post info line into component ?>
							<p class="entry-meta"><?php _e('Posted on', 'wpst'); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>"><?php the_time('F j, Y'); ?></time> <?php _e('by', 'wpst'); ?> <?php the_author_posts_link(); ?> &amp; <?php _e('filed under', 'wpst'); ?> <?php the_category(', '); ?>.</p>
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 128 ); ?>
							<?php
								$categories = get_the_category();
								if ( ! empty( $categories ) ) {
									foreach ($categories as $category) {
										echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="badge badge-secondary">' . esc_html( $category->name ) . '</a>';
									}
								}
							?>
						</header>

						<section class="entry-content">
							<?php the_excerpt(); ?>
							<?php wp_link_pages(); ?>
						</section>

						<footer class="entry-footer">
							<?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags','wpst') . ':</span> ', ' ', '</p>'); ?>
						</footer>

					</article>

				<?php endwhile; ?>

				<?php // TODO: add pagination func here ?>

			<?php else : ?>

				<h1 class="single-title"><?php _e('No posts yet', 'wpst'); ?></h1>

			<?php endif; ?>

		</div>
	</main> <!-- main -->

<?php get_footer(); ?>
