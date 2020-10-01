<?php
/**
 * Header Search
 *
 * @package Versatile_Business
 */

$versatile_business_phone      = versatile_business_gtm( 'versatile_business_header_phone' );
$versatile_business_email      = versatile_business_gtm( 'versatile_business_header_email' );
$versatile_business_address    = versatile_business_gtm( 'versatile_business_header_address' );
$versatile_business_open_hours = versatile_business_gtm( 'versatile_business_header_open_hours' );

if ( $versatile_business_phone || $versatile_business_email || $versatile_business_address || $versatile_business_open_hours ) : ?>
	<div class="inner-quick-contact">
		<ul>
			<?php if ( $versatile_business_phone ) : ?>
				<li class="quick-call">
					<span><?php esc_html_e( 'Phone', 'versatile-business' ); ?></span><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $versatile_business_phone ) ); ?>"><?php echo esc_html( $versatile_business_phone ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $versatile_business_email ) : ?>
				<li class="quick-email"><span><?php esc_html_e( 'Email', 'versatile-business' ); ?></span><a href="<?php echo esc_url( 'mailto:' . esc_attr( antispambot( $versatile_business_email ) ) ); ?>"><?php echo esc_html( antispambot( $versatile_business_email ) ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $versatile_business_address ) : ?>
				<li class="quick-address"><span><?php esc_html_e( 'Address', 'versatile-business' ); ?></span><?php echo esc_html( $versatile_business_address ); ?></li>
			<?php endif; ?>

			<?php if ( $versatile_business_open_hours ) : ?>
				<li class="quick-open-hours"><span><?php esc_html_e( 'Open Hours', 'versatile-business' ); ?></span><?php echo esc_html( $versatile_business_open_hours ); ?></li>
			<?php endif; ?>
		</ul>
	</div><!-- .inner-quick-contact -->
<?php endif; ?>

