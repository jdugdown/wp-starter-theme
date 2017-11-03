<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 text-center text-sm-left">
					<?php wpst_footer_links(); ?>
				</div>

				<div class="col-lg-4 text-center text-sm-right">
					<p class="copyright">&copy; <?php echo date('Y'); ?> <a href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo('name'); ?></a>.</p>
				</div>
			</div>
		</div>
	</footer> <!-- #colophon -->

	<?php wp_footer(); ?>

</body>
</html>
