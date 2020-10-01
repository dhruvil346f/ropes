<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Versatile_Business
 */

$versatile_business_args = versatile_business_get_section_args( 'testimonial' );
$versatile_business_loop = new WP_Query( $versatile_business_args );

if ( $versatile_business_loop->have_posts() ) :

	?>
	<div class="testimonial-content-wrapper swiper-carousel-enabled">
		<div class="swiper-wrapper">
		<?php

		while ( $versatile_business_loop->have_posts() ) :
			$versatile_business_loop->the_post();
			?>
			<div class="testimonial-item swiper-slide">
				<div class="testimonial-wrapper">
					<div class="testimonial-summary">
						<?php the_excerpt(); ?>
					</div>

					<?php if ( has_post_thumbnail() ) : ?>
					<div class="testimonial-thumb">
						<a href="<?php the_permalink(); ?>">
							<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'pull-left' ) ); ?>
						</a>
					</div>
					<?php endif; ?>

					<div class="client-info-wrap">
						<div class="clinet-info">
							<?php the_title( '<h4><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h4>'); ?>
						</div>
						<!-- .clinet-info -->
					</div><!-- .client-info-wrap -->
				</div><!-- .testimonial-wrapper -->
			</div><!-- .testimonial-item -->
		<?php
		endwhile;
		?>
		</div><!-- .swiper-wrapper -->

		<div class="swiper-pagination"></div>
		<div class="swiper-button-prev"></div>
	    <div class="swiper-button-next"></div>
	</div><!-- .testimonial-content-wrapper -->
<?php
endif;

wp_reset_postdata();
