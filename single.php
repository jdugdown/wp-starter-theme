<?php
/**
 * The single post template file.
 *
 * This is the template that is used for a single post.
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

	<main id="single" role="main">
		<div class="container">

			<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'components/post/single' );

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile;
			?>

		</div>
	</main> <!-- main -->

<?php get_footer(); ?>
