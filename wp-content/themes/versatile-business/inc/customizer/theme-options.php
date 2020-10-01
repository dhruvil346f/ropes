<?php
/**
 * Adds the theme options sections, settings, and controls to the theme customizer
 *
 * @package Versatile_Business
 */

class Versatile_Business_Theme_Options {
	public function __construct() {
		// Register our Panel.
		add_action( 'customize_register', array( $this, 'add_panel' ) );

		// Register Breadcrumb Options.
		add_action( 'customize_register', array( $this, 'register_breadcrumb_options' ) );

		// Register Excerpt Options.
		add_action( 'customize_register', array( $this, 'register_excerpt_options' ) );

		// Register Homepage Options.
		add_action( 'customize_register', array( $this, 'register_homepage_options' ) );

		// Register Layout Options.
		add_action( 'customize_register', array( $this, 'register_layout_options' ) );

		// Register Search Options.
		add_action( 'customize_register', array( $this, 'register_search_options' ) );		
		// Add default options.
		add_filter( 'versatile_business_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			// Header Media.
			'versatile_business_header_image_visibility' => 'disabled',

			// Breadcrumb
			'versatile_business_breadcrumb_show'      => 1,

			// Layout Options.
			'versatile_business_layout_type'             => 'fluid',
			'versatile_business_default_layout'          => 'right-sidebar',
			'versatile_business_homepage_archive_layout' => 'no-sidebar-full-width',

			// Excerpt Options
			'versatile_business_excerpt_length'    => 30,
			'versatile_business_excerpt_more_text' => esc_html__( 'Continue reading', 'versatile-business' ),

			// Homepage/Frontpage Options.
			'versatile_business_front_page_category' => '',

			// Search Options.
			'versatile_business_search_text'         => esc_html__( 'Search...', 'versatile-business' ),
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Register the Customizer panels
	 */
	public function add_panel( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'versatile_business_theme_options',
		 	array(
				'title' => esc_html__( 'Theme Options', 'versatile-business' ),
			)
		);
	}

	/**
	 * Add breadcrumb section and its controls
	 */
	public function register_breadcrumb_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'versatile_business_breadcrumb_options', 
			array(
				'title' => esc_html__( 'Breadcrumb', 'versatile-business' ),
				'panel' => 'versatile_business_theme_options',
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Versatile_Business_Toggle_Switch_Custom_control',
				'settings'          => 'versatile_business_breadcrumb_show',
				'sanitize_callback' => 'versatile_business_switch_sanitization',
				'label'             => esc_html__( 'Display Breadcrumb?', 'versatile-business' ),
				'section'           => 'versatile_business_breadcrumb_options',
			) 
		);
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_layout_options( $wp_customize ) {
		// Add layouts section.
		$wp_customize->add_section( 'versatile_business_layouts',
			array(
				'title' => esc_html__( 'Layouts', 'versatile-business' ),
				'panel' => 'versatile_business_theme_options'
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'versatile_business_layout_type',
				'sanitize_callback' => 'versatile_business_sanitize_select',
				'label'             => esc_html__( 'Site Layout', 'versatile-business' ),
				'section'           => 'versatile_business_layouts',
				'choices'           => array(
					'fluid' => esc_html__( 'Fluid', 'versatile-business' ),
					'boxed' => esc_html__( 'Boxed', 'versatile-business' ),
				),
			) 
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'versatile_business_default_layout',
				'sanitize_callback' => 'versatile_business_sanitize_select',
				'label'             => esc_html__( 'Default Layout', 'versatile-business' ),
				'section'           => 'versatile_business_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'versatile-business' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'versatile-business' ),
				),
			) 
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'versatile_business_homepage_archive_layout',
				'sanitize_callback' => 'versatile_business_sanitize_select',
				'label'             => esc_html__( 'Homepage/Archive Layout', 'versatile-business' ),
				'section'           => 'versatile_business_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'versatile-business' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'versatile-business' ),
				),
			) 
		);
	}

	/**
	 * Add excerpt section and its controls
	 */
	public function register_excerpt_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'versatile_business_excerpt_options', 
			array(
				'title' => esc_html__( 'Excerpt Options', 'versatile-business' ),
				'panel' => 'versatile_business_theme_options',
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'versatile_business_excerpt_length',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Excerpt Length (Words)', 'versatile-business' ),
				'section'           => 'versatile_business_excerpt_options',
			) 
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'versatile_business_excerpt_more_text',
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Excerpt More Text', 'versatile-business' ),
				'section'           => 'versatile_business_excerpt_options',
			) 
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_homepage_options( $wp_customize ) {
		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Versatile_Business_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'settings'          => 'versatile_business_front_page_category',
				'description'       => esc_html__( 'Filter Homepage/Blog page posts by following categories', 'versatile-business' ),
				'label'             => esc_html__( 'Categories', 'versatile-business' ),
				'section'           => 'static_front_page',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'versatile-business' ) => Versatile_Business_Customizer_Utilities::get_terms( 'category' ) ),
			) 
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_search_options( $wp_customize ) {
		// Add Homepage/Frontpage Section.
		$wp_customize->add_section( 'versatile_business_search', 
			array(
				'title' => esc_html__( 'Search', 'versatile-business' ),
				'panel' => 'versatile_business_theme_options',
			)
		);

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_search_text',
				'sanitize_callback' => 'versatile_business_text_sanitization',
				'label'             => esc_html__( 'Search Text', 'versatile-business' ),
				'section'           => 'versatile_business_search',
				'type'              => 'text',
			) 
		);
	}
}

/**
 * Initialize class
 */
$versatile_business_theme_options = new Versatile_Business_Theme_Options();
