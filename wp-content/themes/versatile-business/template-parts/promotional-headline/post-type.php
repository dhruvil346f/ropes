<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Versatile_Business
 */

if ( ! versatile_business_gtm( 'versatile_business_promotional_headline_page' ) ) {
	return;
}

$versatile_business_args = array(
	'page_id' => absint( versatile_business_gtm( 'versatile_business_promotional_headline_page' ) ),
);

$versatile_business_args['posts_per_page'] = 1;

$versatile_business_loop = new WP_Query( $versatile_business_args );

while ( $versatile_business_loop->have_posts() ) :
	$versatile_business_loop->the_post();

	$subtitle = versatile_business_gtm( 'versatile_business_promotional_headline_custom_subtitle' );
	$overlay  = versatile_business_gtm( 'versatile_business_promotional_headline_overlay' ) ? ' overlay-enabled' : '';
	?>

	<div id="promotion-section" class="section promotion-section text-aligncenter<?php echo esc_attr( $overlay ); ?>" <?php echo has_post_thumbnail() ? 'style="background-image: url( ' .esc_url( get_the_post_thumbnail_url() ) . ' )"' : ''; ?>>
	<div class="promotion-inner-wrapper section-promotion">
		<div class="container">
			<div class="promotion-content">
				<div class="promotion-description">
					<?php the_title( '<h2>', '</h2>' ); ?>

					<?php the_excerpt(); ?>
				</div><!-- .promotion-description -->
			</div><!-- .promotion-content -->
		</div><!-- .container -->
	</div><!-- .promotion-inner-wrapper" -->
</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
