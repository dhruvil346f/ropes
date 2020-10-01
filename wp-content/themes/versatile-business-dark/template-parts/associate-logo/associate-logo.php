<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Versatile_Business
 */

$versatile_business_logo = versatile_business_gtm( 'versatile_business_associate_logo_visibility' );

if ( ! versatile_business_display_section( $versatile_business_logo ) ) {
	return;
}

$versatile_business_top_subtitle = versatile_business_gtm( 'versatile_business_associate_logo_section_top_subtitle' );
$versatile_business_title        = versatile_business_gtm( 'versatile_business_associate_logo_section_title' );
$versatile_business_subtitle     = versatile_business_gtm( 'versatile_business_associate_logo_section_subtitle' );
?>
<div id="section-associate-logo" class="section">
	<div class="section-associate-logo">
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

			<?php get_template_part( 'template-parts/associate-logo/post-type' ); ?>
		</div><!-- .container -->
	</div><!-- .section-associate-logo -->
</div><!-- .section -->
