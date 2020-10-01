<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Versatile_Business
 */

$sidebar = versatile_business_get_sidebar_id();

if ( '' === $sidebar || ! is_active_sidebar( $sidebar ) ) {
    return;
}

?>

<aside id="secondary" class="widget-area sidebar">
	<?php dynamic_sidebar( $sidebar ); ?>
</aside><!-- #secondary -->
