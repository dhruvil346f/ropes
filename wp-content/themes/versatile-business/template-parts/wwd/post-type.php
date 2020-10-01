<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Versatile_Business
 */

$versatile_business_wwd_args = versatile_business_get_section_args( 'wwd' );

$versatile_business_loop = new WP_Query( $versatile_business_wwd_args );

if ( $versatile_business_loop->have_posts() ) :
	?>
	<div class="wwd-block-list">
		<div class="row">
		<?php

		while ( $versatile_business_loop->have_posts() ) :
			$versatile_business_loop->the_post();
			
			$count = absint( $versatile_business_loop->current_post );

			$image = versatile_business_gtm( 'versatile_business_wwd_custom_image_' . $count );
			?>
			<div class="ff-grid-4 wwd-block-item">
				<div class="wwd-block-inner inner-block-shadow">
					<?php if ( $image ) : ?>
					<a class="wwd-icon" href="<?php the_permalink(); ?>" >
						<img src="<?php echo esc_url( $image ); ?>" class="attachment-thumbnail size-thumbnail wp-post-image">
					</a>
					<?php endif; ?>

					<div class="wwd-block-inner-content">
						<?php the_title( '<h3 class="wwd-item-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>

						<div class="wwd-block-item-excerpt">
							<?php the_excerpt(); ?>
						</div><!-- .wwd-block-item-excerpt -->
					</div><!-- .wwd-block-inner-content -->
				</div><!-- .wwd-block-inner -->
			</div><!-- .wwd-block-item -->
		<?php
		endwhile;
		?>
		</div><!-- .row -->
	</div><!-- .wwd-block-list -->
<?php
endif;

wp_reset_postdata();
