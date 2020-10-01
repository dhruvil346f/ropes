<?php
/**
 * Versatile Business Theme Customizer
 *
 * @package Versatile_Business
 */

/**
 * Main Class for customizer
 */
class Versatile_Business_Customizer {
	public function __construct() {
		// Register Custozier Options.
		add_action( 'customize_register', array( $this, 'register_options' ) );

		// Add preview js.
		add_action( 'customize_preview_init', array( $this, 'preview_js' ) );

		// Enqueue js for customizer.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'customize_control_js' ) );
	}

	/**
	 * Add postMessage support for site title and description for the Theme Customizer.
	 * Other basic stuff for customizer initialization.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function register_options( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' => '.site-title a, body.home #custom-header .page-title',
				'container_inclusive' => false,
				'render_callback' => array( $this, 'partial_blogname' ),
			) );
			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector' => '.site-description',
				'container_inclusive' => false,
				'render_callback' => array( $this, 'partial_blogdescription' ),
			) );
		}

		$section_visibility = Versatile_Business_Customizer_Utilities::section_visibility();

		$section_visibility['excluding-home'] = esc_html__( 'Excluding Homepage', 'versatile-business' );

		Versatile_Business_Customizer_Utilities::register_option(
			array(
				'settings'          => 'versatile_business_header_image_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'versatile_business_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'versatile-business' ),
				'section'           => 'header_image',
				'choices'           => $section_visibility,
				'priority'          => 1,
			)
		);

		$wp_customize->add_panel( 'versatile_business_sections', array(
			'title'       => esc_html__( 'Sections', 'versatile-business' ),
			'priority'    => 150,
		) );

		// Add sections.
		$wp_customize->add_section( 'versatile_business_ss_slider',
			array(
				'title' => esc_html__( 'Slider', 'versatile-business' ),
				'panel' => 'versatile_business_sections'
			)
		);

		$wp_customize->add_section( 'versatile_business_ss_featured_content',
			array(
				'title' => esc_html__( 'Featured Content', 'versatile-business' ),
				'panel' => 'versatile_business_sections'
			)
		);

		$wp_customize->add_section( 'versatile_business_ss_hero_content',
			array(
				'title' => esc_html__( 'Hero Content', 'versatile-business' ),
				'panel' => 'versatile_business_sections'
			)
		);

		$wp_customize->add_section( 'versatile_business_ss_wwd',
			array(
				'title' => esc_html__( 'What We Do', 'versatile-business' ),
				'panel' => 'versatile_business_sections'
			)
		);

		$wp_customize->add_section( 'versatile_business_ss_promotional_headline',
			array(
				'title' => esc_html__( 'Promotional Headline', 'versatile-business' ),
				'panel' => 'versatile_business_sections'
			)
		);

		$wp_customize->add_section( 'versatile_business_ss_testimonial',
			array(
				'title' => esc_html__( 'Testimonials', 'versatile-business' ),
				'panel' => 'versatile_business_sections'
			)
		);

		$wp_customize->add_section( new Versatile_Business_Upsell_Section( $wp_customize, 'upsell_section',
			array(
				'title'           => esc_html__( 'Versatile Business Pro Available', 'versatile-business' ),
				'url'             => 'https://fireflythemes.com/themes/versatile-business-pro',
				'backgroundcolor' => '#f06544',
				'textcolor'       => '#fff',
				'priority'        => 0,
			)
		) );
	}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 * @since 0.1
	 */
	public function partial_blogname() {
		bloginfo( 'name' );
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 *
	 * @since 0.1
	 */
	public function partial_blogdescription() {
		bloginfo( 'description' );
	}

	/**
	 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
	 *
	 * @since 0.1
	 */
	public function preview_js() {
		$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_enqueue_script( 'versatile-business-customizer', get_template_directory_uri() . '/js/customizer-preview' . $min . '.js', array( 'customize-preview' ), versatile_business_get_file_mod_date( get_template_directory() . '/js/customizer-preview' . $min . '.js' ), true );
	}

	/**
	 * Binds the JS listener to make Customizer versatile_business_color_scheme control.
	 *
	 * @since 0.1
	 */
	public function customize_control_js() {
		$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		// Register/Enqueue Select2.
		wp_register_script( 'versatile-business-select2-js', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/select2' . $min . '.js', array( 'jquery' ), '4.0.13', true );
		wp_enqueue_style( 'versatile-business-select2-css', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/select2' . $min . '.css', array(), '4.0.13', 'all' );

		// Enqueue Custom JS and CSS.
		wp_enqueue_script( 'versatile-business-custom-controls-js', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'js/customizer' . $min . '.js', array( 'jquery', 'versatile-business-select2-js' ), versatile_business_get_file_mod_date( get_template_directory() . '/js/customizer' . $min . '.js' ), true );
		wp_enqueue_style( 'versatile-business-custom-controls-css', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/customizer' . $min . '.css', null, versatile_business_get_file_mod_date( get_template_directory() . '/css/customizer' . $min . '.css' ), 'all' );
	}
}

/**
 * Initialize customizer class.
 */
$versatile_business_customizer = new Versatile_Business_Customizer();

/**
 * Utility Class
 */
require get_template_directory() . '/inc/customizer/utilities.php';

/**
 * Load all our Customizer Custom Controls
 */
require get_template_directory() . '/inc/customizer/custom-controls.php';

/**
 * Theme Options
 */
require get_template_directory() . '/inc/customizer/theme-options.php';

/**
 * Header Options
 */
require get_template_directory() . '/inc/customizer/header-options.php';

/**
 * Customizer Reset Button.
 */
require get_template_directory() . '/inc/customizer/reset.php';

/**
 * Customizer Slider.
 */
require get_template_directory() . '/inc/customizer/slider.php';

/**
 * Customizer Featured Content.
 */
require get_template_directory() . '/inc/customizer/featured-content.php';

/**
 * Customizer Hero Content.
 */
require get_template_directory() . '/inc/customizer/hero-content.php';

/**
 * Customizer What we do.
 */
require get_template_directory() . '/inc/customizer/wwd.php';

/**
 * Customizer Promotional Headline.
 */
require get_template_directory() . '/inc/customizer/promotional-headline.php';

/**
 * Customizer Testimonial.
 */
require get_template_directory() . '/inc/customizer/testimonial.php';
