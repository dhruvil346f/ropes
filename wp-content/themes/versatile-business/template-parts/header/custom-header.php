<?php
/**
 * Displays header site branding
 *
 * @package Versatile_Business
 */

$versatile_business_enable = versatile_business_gtm( 'versatile_business_header_image_visibility' );

if ( versatile_business_display_section( $versatile_business_enable ) ) : ?>
<div id="custom-header">
	<?php is_header_video_active() && has_header_video() ? the_custom_header_markup() : ''; ?>

	<div class="custom-header-content">
		<div class="container">
			<?php versatile_business_header_title(); ?>
		</div> <!-- .container -->
	</div>  <!-- .custom-header-content -->
</div>
<?php
endif;
