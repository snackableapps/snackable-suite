<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cream_Magazine
 */

if ( ! is_active_sidebar( 'sidebar' ) ) {
	return;
}

$sidebar_class = '';

$is_sticky = cream_magazine_check_sticky_sidebar();

if( $is_sticky == true ) {
	$sidebar_class .= 'col-md-4 col-sm-12 col-xs-12 sticky_portion';
} else {
	$sidebar_class .= 'col-md-4 col-sm-12 col-xs-12';
}
?>
<div class="<?php echo esc_attr( $sidebar_class ); ?>">
	<aside id="secondary" class="sidebar-widget-area">
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside><!-- #secondary -->
</div><!-- .col.sticky_portion -->