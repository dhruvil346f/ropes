<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Versatile_Business
 */

$versatile_business_enable_wwd = versatile_business_gtm( 'versatile_business_wwd_visibility' );

if ( ! versatile_business_display_section( $versatile_business_enable_wwd ) ) {
	return;
}

$versatile_business_top_subtitle = versatile_business_gtm( 'versatile_business_wwd_section_top_subtitle' );
$versatile_business_title        = versatile_business_gtm( 'versatile_business_wwd_section_title' );
$versatile_business_subtitle     = versatile_business_gtm( 'versatile_business_wwd_section_subtitle' );
?>

<div id="wwd-section" class="section style-one">
	<div class="section-wwd wwd-layout-1">
		<div class="container">
			<?php if ( $versatile_business_top_subtitle || $versatile_business_title || $versatile_business_subtitle ) : ?>
			<div class="section-title-wrap">
				<?php if ( $versatile_business_top_subtitle ) : ?>
				<p class="section-top-subtitle"><?php echo esc_html( $versatile_business_top_subtitle ); ?></p>
				<?php endif; ?>

				<?php if ( $versatile_business_title ) : ?>
				<h2 class="section-title"><?php echo esc_html( $versatile_business_title ); ?></h2>
				<?php endif; ?>

				<span class="divider"></span>
				<?php if ( $versatile_business_subtitle ) : ?>
				<p class="section-subtitle"><?php echo esc_html( $versatile_business_subtitle ); ?></p>
				<?php endif; ?>

			</div>
			<?php endif; ?>

			<?php get_template_part( 'template-parts/wwd/post-type' ); ?>
		</div><!-- .container -->
	</div><!-- .section-wwd  -->
</div><!-- .section -->
