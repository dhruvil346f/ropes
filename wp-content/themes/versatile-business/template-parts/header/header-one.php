<?php
/**
 * Header One Style Template
 *
 * @package Versatile_Business
 */
$versatile_business_phone      = versatile_business_gtm( 'versatile_business_header_phone' );
$versatile_business_email      = versatile_business_gtm( 'versatile_business_header_email' );
$versatile_business_address    = versatile_business_gtm( 'versatile_business_header_address' );
$versatile_business_open_hours = versatile_business_gtm( 'versatile_business_header_open_hours' );

if ( $versatile_business_phone || $versatile_business_email || $versatile_business_address || $versatile_business_open_hours || has_nav_menu( 'social-primary' ) ) :
?>
<div id="top-header" class="dark-top-header">
	<div class="site-top-header-mobile">
		<div class="container">
			<button id="header-top-toggle" class="header-top-toggle" aria-controls="header-top" aria-expanded="false">
				<i class="fas fa-bars"></i><span class="menu-label"> <?php esc_html_e( 'Top Bar', 'versatile-business' ); ?></span>
			</button><!-- #header-top-toggle -->
			<div id="site-top-header-mobile-container">
				<?php if ( $versatile_business_phone || $versatile_business_email || $versatile_business_address || $versatile_business_open_hours ) : ?>
					<div id="quick-contact">
						<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
					</div>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'social-primary' ) ): ?>
					<div id="top-social">
						<div class="social-nav">
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
						</div>
					</div><!-- #top-social -->
				<?php endif; ?>
				<?php
					$versatile_business_button_text   = versatile_business_gtm( 'versatile_business_header_button_text' );
					$versatile_business_button_link   = versatile_business_gtm( 'versatile_business_header_button_link' );
					$versatile_business_button_target = versatile_business_gtm( 'versatile_business_header_button_target' ) ? '_blank' : '_self';

					if ( $versatile_business_button_text ) :
					?>
					<a target="<?php echo esc_attr( $versatile_business_button_target );?>" href="<?php echo esc_url( $versatile_business_button_link );?>" class="ff-button header-button mobile-off"><?php echo esc_html( $versatile_business_button_text );?></a>
				<?php endif; ?>
			</div><!-- #site-top-header-mobile-container-->
		</div><!-- .container -->
	</div><!-- .site-top-header-mobile -->
	<div class="site-top-header">
		<div class="container">
			<?php if ( $versatile_business_phone || $versatile_business_email || $versatile_business_address || $versatile_business_open_hours ) : ?>
			<div id="quick-contact" class="pull-left">
				<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'social-primary' ) ): ?>
			<div id="top-social" class="pull-right">
				<div class="social-nav">
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
				</div>
			</div><!-- #top-social -->
			<?php endif; ?>


		</div><!-- .container -->
	</div><!-- .site-top-header -->
</div><!-- #top-header -->
<?php endif; ?>

<header id="masthead" class="site-header clear-fix">
	<div class="container">
		<div class="site-header-main">
			<div class="site-branding">
				<?php get_template_part( 'template-parts/header/site-branding' ); ?>
			</div><!-- .site-branding -->

			<div class="right-head pull-right">
				<div id="main-nav" class="pull-left">
					<?php get_template_part( 'template-parts/navigation/navigation-primary' ); ?>
				</div><!-- .main-nav -->
				<div class="head-search-cart-wrap pull-left">
					<div class="header-search pull-left">
						<?php get_template_part( 'template-parts/header/header-search' ); ?>
					</div><!-- .header-search -->

					<?php if ( function_exists( 'versatile_business_woocommerce_header_cart' ) ) : ?>
					<div class="cart-contents pull-left">
						<?php versatile_business_woocommerce_header_cart(); ?>
					</div>
					<?php endif; ?>
				</div><!-- .head-search-cart-wrap -->

				<?php
				$versatile_business_button_text   = versatile_business_gtm( 'versatile_business_header_button_text' );
				$versatile_business_button_link   = versatile_business_gtm( 'versatile_business_header_button_link' );
				$versatile_business_button_target = versatile_business_gtm( 'versatile_business_header_button_target' ) ? '_blank' : '_self';

				if ( $versatile_business_button_text ) :
				?>
				<a target="<?php echo esc_attr( $versatile_business_button_target );?>" href="<?php echo esc_url( $versatile_business_button_link );?>" class="ff-button header-button mobile-off"><?php echo esc_html( $versatile_business_button_text );?></a>
				<?php endif; ?>
			</div><!-- .right-head -->
		</div><!-- .site-header-main -->
	</div><!-- .container -->
</header><!-- #masthead -->


