<?php
/**
 * The single post with excerpt.
 *
 * Displays the relevant markup for a single post to be used in a list of posts.
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
	<?php the_post_thumbnail( 'wpst-post-featured', array( 'class' => 'card-img-top' ) ); ?>

	<header class="entry-header card-body">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<?php get_template_part( 'components/post/meta' ); ?>
	</header>

	<section class="entry-content card-body">
		<?php if ( ! has_excerpt() ) : ?>
			<?php the_excerpt(); ?>
		<?php else: ?>
			<?php the_excerpt(); ?>
			<div class="link-more text-right"><a href="<?php esc_url( get_permalink() ); ?>" class="btn btn-link"><?php _e('Continue reading', 'wpst'); ?> &rsaquo;</a></div>
		<?php endif; ?>
	</section>

</article>
