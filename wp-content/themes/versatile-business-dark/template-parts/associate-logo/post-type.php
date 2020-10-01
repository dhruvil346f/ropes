<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Versatile_Business
 */

$associate_logo_args = versatile_business_get_section_args( 'associate_logo' );

$versatile_business_loop = new WP_Query( $associate_logo_args );

if ( $versatile_business_loop->have_posts() ) :
	?>
	<div class="associate-logo-section associate-logo-col-6">
		<div class="row">
		<?php

		while ( $versatile_business_loop->have_posts() ) :
			$versatile_business_loop->the_post();

			if ( has_post_thumbnail() ) : ?>
			<div class="associate-logo-item ff-grid-2">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
			</div><!-- .associate-logo-item -->
		<?php
			endif;
		endwhile;
		?>
		</div><!-- .swiper-wrapper -->
	</div><!-- .associate-logo-wrapper -->
<?php
endif;

wp_reset_postdata();
