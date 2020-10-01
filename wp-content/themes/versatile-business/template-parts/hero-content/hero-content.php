<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Versatile_Business
 */

$versatile_business_enable = versatile_business_gtm( 'versatile_business_hero_content_visibility' );

if ( ! versatile_business_display_section( $versatile_business_enable ) ) {
	return;
}

get_template_part( 'template-parts/hero-content/content-hero' );
