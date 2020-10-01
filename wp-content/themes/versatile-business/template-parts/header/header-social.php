<?php
/**
 * Header Social
 *
 * @package Versatile_Business
 */
?>

<?php if ( has_nav_menu( 'social-primary' ) ) : ?>
	<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'versatile-business' ); ?>">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'social-primary',
				'menu_class'     => 'social-links-menu',
				'depth'          => 1,
				'link_before'    => '<span class="screen-reader-text">',
			) );
		?>
	</nav><!-- .social-navigation -->
<?php endif; ?>
