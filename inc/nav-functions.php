<?php
/**
 * Displays the primary menu.
 */
function wpst_primary_navigation() {
	wp_nav_menu(
		array(
			'menu'           => 'primary_navigation',
			'menu_class'     => 'navbar-nav ml-auto',
			'theme_location' => 'primary_navigation',
			'container'      => false,
			'fallback_cb'    => false,
			'walker'         => new Bootstrap_walker()
		)
	);
}

/**
 * Displays the footer menu.
 */
function wpst_footer_links($something) {
    wp_nav_menu(
		array(
			'menu'           => 'footer_links',
			'menu_class'     => 'footer-links',
			'theme_location' => 'footer_links',
			'container'      => 'nav',
		)
	);
}

// TODO: finish walker, replace bs3 with bs4 stuff
/**
 * Nav menu walker.
 *
 * Modifies WP menu output to include Bootstrap-friendly markup.
 */
class Bootstrap_walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$submenu = ($depth > 0) ? ' sub-menu' : '';

		// Set up our submenus at the start of a new level.
		$output .= "\n$indent<ul class=\"dropdown-menu dropdown-menu-right$submenu\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$li_attributes = '';
		$class_names = $value = '';

		// Gather classes for our list items.
		$li_classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$li_classes[] = ( $args->walker->has_children ) ? 'dropdown' : '';
		$li_classes[] = ( $item->current || $item->current_item_ancestor ) ? 'active' : '';
		$li_classes[] = 'nav-item';
		$li_classes[] = 'nav-item-' . $item->ID;
		$li_classes[] = 'depth-' . $depth;

		// Put those classes together (and sanitize).
		$class_names =  join( ' ', apply_filters('nav_menu_css_class', array_filter( $li_classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		// Set up the IDs for our list items.
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		// Output our list item markup.
		$output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

		// Set up anchor attributes.
		$a_attributes = !empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$a_attributes .= !empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$a_attributes .= !empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . '"' : '';
		$a_attributes .= !empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';
		$a_attributes .= ( $args->walker->has_children ) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';

		// Start outputting all that hard work.
		$item_output = $args->before;
		$item_output .= ( $depth > 0 ) ? '<a class="dropdown-item"' . $a_attributes . '>' : '<a' . $a_attributes . '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

}
