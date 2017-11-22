<?php
/**
 * The single post.
 *
 * Displays the relevant markup for a full single post.
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
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php get_template_part( 'components/post/meta' ); ?>
	</header>

	<section class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</section>

	<footer class="entry-footer">
		<?php the_tags('<p class="tags"><span class="tags-title">' . __('Tags','wpst') . ':</span> ', ', ', '</p>'); ?>
	</footer>

</article>
