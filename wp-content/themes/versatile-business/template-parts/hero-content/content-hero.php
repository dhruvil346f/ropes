<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Versatile_Business
 */

if ( ! ( $page_id = versatile_business_gtm( 'versatile_business_hero_content_page' ) ) ) {
	// Bail if page id is not set.
	return;
}

$versatile_business_args['posts_per_page'] = 1;
$versatile_business_args['page_id'] = absint( $page_id );

$versatile_business_loop = new WP_Query( $versatile_business_args );

while ( $versatile_business_loop->have_posts() ) :
	$versatile_business_loop->the_post();
	?>
	<div id="hero-section" class="hero-section section content-position-right default">
		<div class="section-featured-page">
			<div class="container">
				<div class="row">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="ff-grid-6 featured-page-thumb">
						<?php the_post_thumbnail( 'versatile-business-hero', array( 'class' => 'alignnone' ) );?>
					</div>
					<?php endif; ?>

					<!-- .ff-grid-6 -->
					<div class="ff-grid-6 featured-page-content">
						<div class="featured-page-section">
							<div class="section-title-wrap">
								<?php the_title( '<h2 class="section-title">', '</h2>' ); ?>

								<span class="divider"></span>
							</div>

							<div class="featured-info">
								<?php the_excerpt(); ?>
							</div><!-- .featured-info -->
						</div><!-- .featured-page-section -->
					</div><!-- .ff-grid-6 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .section-featured-page -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
