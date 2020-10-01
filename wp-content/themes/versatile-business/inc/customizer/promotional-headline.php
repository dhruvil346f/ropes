<?php
/**
 * Promotional Headline Options
 *
 * @package Versatile_Business
 */

class Versatile_Business_Promotional_Headline_Options {
	public function __construct() {
		// Register Promotion Headline Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'versatile_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'versatile_business_promotional_headline_visibility' => 'disabled',
			'versatile_business_promotional_headline_overlay'    => 1,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_promotional_headline_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'versatile_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'versatile-business' ),
				'section'           => 'versatile_business_ss_promotional_headline',
				'choices'           => Versatile_Business_Customizer_Utilities::section_visibility(),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Versatile_Business_Dropdown_Posts_Custom_Control',
				'sanitize_callback' => 'absint',
				'settings'          => 'versatile_business_promotional_headline_page',
				'label'             => esc_html__( 'Select Page', 'versatile-business' ),
				'section'           => 'versatile_business_ss_promotional_headline',
				'active_callback'   => array( $this, 'is_promotional_headline_visible' ),
				'input_attrs' => array(
					'post_type'      => 'page',
					'posts_per_page' => -1,
					'orderby'        => 'name',
					'order'          => 'ASC',
				),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Versatile_Business_Toggle_Switch_Custom_control',
				'settings'          => 'versatile_business_promotional_headline_overlay',
				'sanitize_callback' => 'versatile_business_switch_sanitization',
				'label'             => esc_html__( 'Overlay on image?', 'versatile-business' ),
				'section'           => 'versatile_business_ss_promotional_headline',
				'active_callback'   => array( $this, 'is_promotional_headline_visible' ),
			)
		);
	}

	/**
	 * Promotion Headline visibility active callback.
	 */
	public function is_promotional_headline_visible( $control ) {
		return ( versatile_business_display_section( $control->manager->get_setting( 'versatile_business_promotional_headline_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$versatile_business_ss_promotional_headline = new Versatile_Business_Promotional_Headline_Options();
