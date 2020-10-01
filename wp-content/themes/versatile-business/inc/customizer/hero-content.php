<?php
/**
 * Hero Content Options
 *
 * @package Versatile_Business
 */

class Versatile_Business_Hero_Content_Options {
	public function __construct() {
		// Register Hero Content Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'versatile_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'versatile_business_hero_content_visibility' => 'disabled',
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
				'settings'          => 'versatile_business_hero_content_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'versatile_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'versatile-business' ),
				'section'           => 'versatile_business_ss_hero_content',
				'choices'           => Versatile_Business_Customizer_Utilities::section_visibility(),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Versatile_Business_Dropdown_Posts_Custom_Control',
				'sanitize_callback' => 'absint',
				'settings'          => 'versatile_business_hero_content_page',
				'label'             => esc_html__( 'Select Page', 'versatile-business' ),
				'section'           => 'versatile_business_ss_hero_content',
				'active_callback'   => array( $this, 'is_hero_content_visible' ),
				'input_attrs' => array(
					'post_type'      => 'page',
					'posts_per_page' => -1,
					'orderby'        => 'name',
					'order'          => 'ASC',
				),
			)
		);
	}

	/**
	 * Hero Content visibility active callback.
	 */
	public function is_hero_content_visible( $control ) {
		return ( versatile_business_display_section( $control->manager->get_setting( 'versatile_business_hero_content_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$versatile_business_ss_hero_content = new Versatile_Business_Hero_Content_Options();
