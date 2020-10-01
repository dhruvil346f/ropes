<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Versatile_Business
 */

?>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- #content -->

		<?php get_template_part( 'template-parts/testimonial/testimonial' ); ?>
		
		<footer id="colophon" class="site-footer">
			<?php get_template_part( 'template-parts/footer/footer', 'widget' ); ?>

			<?php get_template_part( 'template-parts/footer/site-info' ); ?>
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<div id="scrollup">
		<a title="<?php echo esc_attr( 'Go to Top', 'versatile-business' ); ?>" class="scrollup" href="#"><i class="fas fa-angle-up"></i></a>
	</div>
	
	<?php wp_footer(); ?>
</body>
</html>
