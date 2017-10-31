<?php
/**
 * The post meta.
 *
 * Displays meta information about the current post such as author, published
 * date, and categories.
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */
?>

<div class="entry-meta">
	<p><?php _e('Posted on', 'wpst'); ?> <time datetime="<?php echo the_time('Y-m-j'); ?>"><?php the_time('F j, Y'); ?></time> <?php _e('by', 'wpst'); ?> <?php the_author_posts_link(); ?>.</p>
	<?php
		$categories = get_the_category();
		if ( ! empty( $categories ) ) {
			foreach ($categories as $category) {
				echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="badge badge-secondary">' . esc_html( $category->name ) . '</a>';
			}
		}
	?>
</div>
