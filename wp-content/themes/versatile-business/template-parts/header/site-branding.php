<?php
/**
 * Displays header site branding
 *
 * @package Versatile_Business
 */
?>


	<?php versatile_business_the_custom_logo(); ?>

	<div class="site-identity">
		<?php if ( is_front_page() && is_home() ) : ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php else : ?>
			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
		<?php endif;

		$versatile_business_description = get_bloginfo( 'description', 'display' );
		if ( $versatile_business_description || is_customize_preview() ) : ?>
			<p class="site-description"><?php echo esc_html( $versatile_business_description ); ?></p>
		<?php endif; ?>
	</div><!-- .site-identity -->

