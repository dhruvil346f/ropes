<?php
/**
 * Slider Options
 *
 * @package Versatile_Business
 */

class Versatile_Business_Slider_Options {
	public function __construct() {
		// Register Slider Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 98 );

		// Add default options.
		add_filter( 'versatile_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'versatile_business_slider_visibility' => 'disabled',
			'versatile_business_slider_number'     => 2,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add slider section and its controls
	 */
	public function register_options( $wp_customize ) {
		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_slider_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'versatile_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'versatile-business' ),
				'section'           => 'versatile_business_ss_slider',
				'choices'           => Versatile_Business_Customizer_Utilities::section_visibility(),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'versatile_business_slider_number',
				'label'             => esc_html__( 'Number', 'versatile-business' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'versatile-business' ),
				'section'           => 'versatile_business_ss_slider',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		$numbers = versatile_business_gtm( 'versatile_business_slider_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Versatile_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Versatile_Business_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'versatile_business_text_sanitization',
					'settings'          => 'versatile_business_slider_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'versatile-business' )  . $j,
					'section'           => 'versatile_business_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
				)
			);

			Versatile_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Versatile_Business_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'versatile_business_slider_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'versatile-business' ),
					'section'           => 'versatile_business_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}
	}

	/**
	 * Slider visibility active callback.
	 */
	public function is_slider_visible( $control ) {
		return ( versatile_business_display_section( $control->manager->get_setting( 'versatile_business_slider_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$versatile_business_ss_slider = new Versatile_Business_Slider_Options();
