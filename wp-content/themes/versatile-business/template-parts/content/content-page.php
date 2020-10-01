<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Versatile_Business
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-content-wraper">
		<?php versatile_business_post_thumbnail(); ?>

		<div class="entry-content-wrapper">
			<?php
			$versatile_business_enable = versatile_business_gtm( 'versatile_business_header_image_visibility' );

			if ( ! versatile_business_display_section( $versatile_business_enable ) ) : ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header><!-- .entry-header -->
			<?php endif; ?>

			<div class="entry-content">
				<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'versatile-business' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->

			<?php if ( get_edit_post_link() ) : ?>
				<footer class="entry-footer">
					<?php
					edit_post_link(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Edit <span class="screen-reader-text">%s</span>', 'versatile-business' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						),
						'<span class="edit-link">',
						'</span>'
					);
					?>
				</footer><!-- .entry-footer -->
			<?php endif; ?>
		</div><!-- .entry-content-wrapper -->
	</div><!-- .single-content-wraper -->
</article><!-- #post-<?php the_ID(); ?> -->
