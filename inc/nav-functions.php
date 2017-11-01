<?php
/**
 * Displays the primary menu.
 */
function wpst_primary_navigation() {
	wp_nav_menu(
		array(
			'menu' => 'primary_navigation', /* menu name */
			'menu_class' => 'nav navbar-nav',
			'theme_location' => 'primary_navigation', /* where in the theme it's assigned */
			'container' => 'nav', /* container element */
			// 'fallback_cb' => 'wpst_main_nav_fallback', /* menu fallback */
			// 'depth' => '2',  suppress lower levels for now
			'walker' => new Bootstrap_walker()
		)
	);
}

/**
 * Displays the footer menu.
 */
function wpst_footer_links() {
    wp_nav_menu(
		array(
			'menu' => 'footer_links', /* menu name */
			'menu_class' => 'footer-links',
			'theme_location' => 'footer_links', /* where in the theme it's assigned */
			'container' => 'nav', /* container element */
			// 'fallback_cb' => 'wpst_main_nav_fallback', /* menu fallback */
			// 'depth' => '2',  suppress lower levels for now
			// 'walker' => new Bootstrap_walker()
		)
	);
}
