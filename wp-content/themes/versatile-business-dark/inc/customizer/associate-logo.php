<?php
/**
 * Associate Logo Options
 *
 * @package Versatile_Business
 */

class Versatile_Business_Associate_Logo_Options {
	public function __construct() {
		// Add options to default options.
		add_filter( 'versatile_business_customizer_defaults', array( $this, 'add_defaults' ) );

		// Register Associate Logo Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'versatile_business_associate_logo_visibility' => 'disabled',
			'versatile_business_associate_logo_number'     => 10,
		);

		// Add default colors.
		$colors = $this->get_colors();

		// Set array as $key => default value as the array contaons other unnecessary stuff.
		foreach ( $colors as $key => $value ) {
			$defaults[ $key ] = $value['default'];
		}

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		$wp_customize->add_section( 'versatile_business_ss_associate_logo',
			array(
				'title' => esc_html__( 'Associate Logo', 'versatile-business-dark' ),
				'panel' => 'versatile_business_sections'
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_associate_logo_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'versatile_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'versatile-business-dark' ),
				'section'           => 'versatile_business_ss_associate_logo',
				'choices'           => Versatile_Business_Customizer_Utilities::section_visibility(),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'settings'          => 'versatile_business_associate_logo_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'versatile-business-dark' ),
				'section'           => 'versatile_business_ss_associate_logo',
				'active_callback'   => array( $this, 'is_associate_logo_visible' ),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_associate_logo_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'versatile-business-dark' ),
				'section'           => 'versatile_business_ss_associate_logo',
				'active_callback'   => array( $this, 'is_associate_logo_visible' ),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_associate_logo_section_subtitle',
				'type'              => 'text',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Section Subtitle', 'versatile-business-dark' ),
				'section'           => 'versatile_business_ss_associate_logo',
				'active_callback'   => array( $this, 'is_associate_logo_visible' ),
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_associate_logo_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'versatile-business-dark' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'versatile-business-dark' ),
				'section'           => 'versatile_business_ss_associate_logo',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_associate_logo_visible' ),
			)
		);

		$numbers = versatile_business_gtm( 'versatile_business_associate_logo_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Versatile_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Versatile_Business_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'versatile_business_associate_logo_page_' . $i,
					'label'             => esc_html__( 'Select Page', 'versatile-business-dark' ),
					'section'           => 'versatile_business_ss_associate_logo',
					'active_callback'   => array( $this, 'is_associate_logo_visible' ),
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
	 * Associate Logo visibility active callback.
	 */
	public function is_associate_logo_visible( $control ) {
		return ( versatile_business_display_section( $control->manager->get_setting( 'versatile_business_associate_logo_visibility' )->value() ) );
	}

	/**
	 * Add color options
	 */
	public function register_color_options( $wp_customize ) {
		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Versatile_Business_Note_Control',
				'settings'          => 'versatile_business_associate_logo_colors_notice',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Colors', 'versatile-business-dark' ),
				'section'           => 'versatile_business_ss_associate_logo',
				'active_callback'   => array( $this, 'is_associate_logo_visible' ),
				'transport'         => 'postMessage',
			)
		);

		$colors = $this->get_colors();

		foreach ( $colors as $key => $value) {
			Versatile_Business_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'WP_Customize_Color_Control',
					'settings'          => $key,
					'sanitize_callback' => 'sanitize_hex_color',
					'label'             => $value['label'],
					'section'           => 'versatile_business_ss_associate_logo',
					'active_callback'   => array( $this, 'is_associate_logo_visible' ),
					'transport'         => 'postMessage',
				)
			);
		}
	}

	/**
	 * Return array of color options.
	 */
	public static function get_colors() {
		$colors = array(

			'versatile_business_associate_logo_section_bg_color' => array(
				'label'    => esc_html__( 'Section Background Color', 'versatile-business-dark' ),
				'selector' => '#associate_logo-section',
				'property' => 'background-color', // separate by comma.
				'default'  => '#fff',

			),
			'versatile_business_associate_logo_title_color' => array(
				'label'    => esc_html__( 'Title Color', 'versatile-business-dark' ),
				'selector' => '#associate_logo-section h2',
				'property' => 'color', // separate by comma.
				'default'  => '#222',

			),
			'versatile_business_associate_logo_title_divider_color' => array(
				'label'    => esc_html__( 'Title Divider Color', 'versatile-business-dark' ),
				'selector' => '#associate_logo-section .section-title-wrap span.divider ',
				'property' => 'background-color', // separate by comma.
				'default'  => '#3368c6',

			),
			'versatile_business_associate_logo_subtitle_color' => array(
				'label'    => esc_html__( 'Sub Title Color', 'versatile-business-dark' ),
				'selector' => '#associate_logo-section .section-top-subtitle',
				'property' => 'color', // separate by comma.
				'default'  => '#808291',

			),
			'versatile_business_associate_logo_text_color' => array(
				'label'    => esc_html__( 'Text Color', 'versatile-business-dark' ),
				'selector' => '#associate_logo-section p',
				'property' => 'color', // separate by comma.
				'default'  => '#808291',

			),
			'versatile_business_associate_logo_link_color' => array(
				'label'    => esc_html__( 'Title Color', 'versatile-business-dark' ),
				'selector' => '#associate_logo-section a,#associate_logo-section a:visited,#associate_logo-section .associate_logo-content h3',
				'property' => 'color', // separate by comma.
				'default'  => '#222',

			),
			'versatile_business_associate_logo_link_hover_color' => array(
				'label'    => esc_html__( 'Title Link Hover Color', 'versatile-business-dark' ),
				'selector' => '#associate_logo-section a:hover, #associate_logo-section a:focus,#associate_logo-section a:active',
				'property' => 'color', // separate by comma.
				'default'  => '#3368c6',

			),
		);

		return apply_filters( 'versatile_business_associate_logo_colors', $colors );
	}
}

/**
 * Initialize class
 */
$versatile_business_ss_associate_logo = new Versatile_Business_Associate_Logo_Options();
