<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Versatile_Business
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 */
function versatile_business_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'infinite-grid',
		'render'    => 'versatile_business_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'   => false,
	) );
}
add_action( 'after_setup_theme', 'versatile_business_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function versatile_business_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content/content', 'search' );
		else :
			get_template_part( 'template-parts/content/content', get_post_type() );
		endif;
	}
}
