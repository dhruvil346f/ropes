<?php
/**
 * Testimonial Options
 *
 * @package Versatile_Business
 */

class Versatile_Business_Testimonial_Options {
	public function __construct() {
		// Register Testimonial Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'versatile_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'versatile_business_testimonial_visibility' => 'disabled',
			'versatile_business_testimonial_number'     => 4,
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
				'settings'          => 'versatile_business_testimonial_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'versatile_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'versatile-business' ),
				'section'           => 'versatile_business_ss_testimonial',
				'choices'           => Versatile_Business_Customizer_Utilities::section_visibility(),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'settings'          => 'versatile_business_testimonial_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'versatile-business' ),
				'section'           => 'versatile_business_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_testimonial_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'versatile-business' ),
				'section'           => 'versatile_business_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_testimonial_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'versatile-business' ),
				'section'           => 'versatile_business_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);


		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_testimonial_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'versatile-business' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'versatile-business' ),
				'section'           => 'versatile_business_ss_testimonial',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		$numbers = versatile_business_gtm( 'versatile_business_testimonial_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Versatile_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Versatile_Business_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'versatile_business_testimonial_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'versatile-business' ),
					'section'           => 'versatile_business_ss_testimonial',
					'active_callback'   => array( $this, 'is_testimonial_visible' ),
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
	 * Testimonial visibility active callback.
	 */
	public function is_testimonial_visible( $control ) {
		return ( versatile_business_display_section( $control->manager->get_setting( 'versatile_business_testimonial_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$versatile_business_ss_testimonial = new Versatile_Business_Testimonial_Options();
