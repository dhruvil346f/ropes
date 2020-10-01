<?php
/**
 * Template part for displaying Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Versatile_Business
 */

$versatile_business_enable_slider = versatile_business_gtm( 'versatile_business_slider_visibility' );

if ( ! versatile_business_display_section( $versatile_business_enable_slider ) ) {
	return;
}

?>
<div id="hero-slider" class="section overlay-enabled no-padding style-one">
	<div class="swiper-wrapper">
		<?php get_template_part( 'template-parts/slider/post', 'type' ); ?>
	</div><!-- .swiper-wrapper -->

	<div class="swiper-pagination"></div>

	<div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
</div><!-- .main-slider -->
