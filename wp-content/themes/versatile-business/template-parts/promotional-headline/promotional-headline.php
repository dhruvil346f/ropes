<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Versatile_Business
 */

$versatile_business_enable_promotional = versatile_business_gtm( 'versatile_business_promotional_headline_visibility' );

if ( ! versatile_business_display_section( $versatile_business_enable_promotional ) ) {
	return;
}

get_template_part( 'template-parts/promotional-headline/post-type' );
