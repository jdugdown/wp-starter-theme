<?php
/**
 * The main navigation bar.
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>" rel="home"><?php bloginfo('title'); ?></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<?php wpst_primary_navigation(); ?>
		</div>
	</div>
</nav>
