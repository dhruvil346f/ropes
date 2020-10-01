<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Versatile_Business
 */

$versatile_business_args = versatile_business_get_section_args( 'featured_content' );

$versatile_business_loop = new WP_Query( $versatile_business_args );

if ( $versatile_business_loop->have_posts() ) :
	?>
	<div class="row">
	<?php

	while ( $versatile_business_loop->have_posts() ) :
		$versatile_business_loop->the_post();
		?>
		<div class="ff-grid-4 latest-posts-item">
			<div class="latest-posts-wrapper inner-block-shadow">
				<?php
				$versatile_business_cats = versatile_business_get_featured_content_cats();

				if ( has_post_thumbnail() || $versatile_business_cats ) : ?>
				<div class="latest-posts-thumb">
					<?php if ( has_post_thumbnail() ) : ?>
					<a class="image-hover-zoom" href="<?php the_permalink(); ?>" >
						<?php the_post_thumbnail(); ?>
					</a>
					<?php endif; ?>

					<?php
					if ( $versatile_business_cats ) {
						echo $versatile_business_cats;
					}
					?>
				</div><!-- latest-posts-thumb  -->
				<?php endif; ?>

				<div class="latest-posts-text-content-wrapper">
					<div class="latest-posts-text-content">
						<?php the_title( '<h3 class="latest-posts-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>

						<?php versatile_business_featured_content_meta(); ?>
						
						<?php the_excerpt(); ?>
					</div><!-- .latest-posts-text-content -->
				</div><!-- .latest-posts-inner-content -->
			</div><!-- .latest-posts-inner -->
		</div><!-- .latest-posts-item -->
	<?php
	endwhile;
	?>

	<?php
	$versatile_business_button_text   = versatile_business_gtm( 'versatile_business_featured_content_button_text' );
	$versatile_business_button_link   = versatile_business_gtm( 'versatile_business_featured_content_button_link' );
	$versatile_business_button_target = versatile_business_gtm( 'versatile_business_featured_content_button_target' ) ? '_blank' : '_self';

	if ( $versatile_business_button_text ) : ?>
		<div class="more-wrapper clear-fix">
			<a href="<?php echo esc_url($versatile_business_button_link); ?>" class="ff-button" target="<?php echo esc_attr($versatile_business_button_target); ?>"><?php echo esc_html($versatile_business_button_text); ?></a>
		</div><!-- .more-wrapper -->
	<?php endif; ?>
</div><!-- .row -->
<?php
endif;

wp_reset_postdata();
