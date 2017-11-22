<?php
/**
 * Search form template.
 *
 * @package WP Starter Theme
 * @since 1.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form form-inline" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label for="<?php echo $unique_id; ?>" class="sr-only"><?php echo _x( 'Search for:', 'label', 'wpst' ); ?></label>
    <div class="input-group">
        <input type="search" id="<?php echo $unique_id; ?>" class="form-control" placeholder="<?php echo esc_attr_x( 'Search&hellip;', 'placeholder', 'wpst' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
        <button type="submit" class="input-group-addon btn btn-primary"><?php _e('Go', 'wpst'); ?></button>
    </div>
</form>
