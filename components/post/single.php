<?php
/**
 * The single post.
 *
 * Displays the relevant markup for a single post
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_post_thumbnail( 'large', array( 'class' => 'aligncenter' ) ); ?>

		<?php if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		} ?>

		<?php get_template_part( 'components/post/meta' ); ?>
	</header>

	<section class="entry-content">
		<?php if ( is_single() ) {
			the_content();
			wp_link_pages();
		} else {
			the_excerpt();
		}
		?>
	</section>

	<?php if ( is_single() ): ?>
		<footer class="entry-footer">
			<?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags','wpst') . ':</span> ', ', ', '</p>'); ?>
		</footer>
	<?php endif; ?>

</article>
