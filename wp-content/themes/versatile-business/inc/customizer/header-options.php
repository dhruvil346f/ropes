<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package Versatile_Business
 */

class Versatile_Business_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'versatile_business_header_options',
			array(
				'title' => esc_html__( 'Header Options', 'versatile-business' ),
				'panel' => 'versatile_business_theme_options'
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'versatile_business_header_email',
				'sanitize_callback' => 'sanitize_email',
				'label'             => esc_html__( 'Email', 'versatile-business' ),
				'section'           => 'versatile_business_header_options',
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'versatile_business_header_phone',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Phone', 'versatile-business' ),
				'section'           => 'versatile_business_header_options',
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'versatile_business_header_address',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Address', 'versatile-business' ),
				'section'           => 'versatile_business_header_options',
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'versatile_business_header_open_hours',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Open Hours', 'versatile-business' ),
				'section'           => 'versatile_business_header_options',
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'versatile_business_header_button_text',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Button Text', 'versatile-business' ),
				'section'           => 'versatile_business_header_options',
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'versatile_business_header_button_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Button Link', 'versatile-business' ),
				'section'           => 'versatile_business_header_options',
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Versatile_Business_Toggle_Switch_Custom_control',
				'settings'          => 'versatile_business_header_button_target',
				'sanitize_callback' => 'versatile_business_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'versatile-business' ),
				'section'           => 'versatile_business_header_options',
			)
		);
	}
}

/**
 * Initialize class
 */
$versatile_business_theme_options = new Versatile_Business_Header_Options();
