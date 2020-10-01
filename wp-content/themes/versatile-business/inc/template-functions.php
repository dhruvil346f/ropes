<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Versatile_Business
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function versatile_business_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class with respect to layout selected.
	$layout  = versatile_business_get_theme_layout();
	$sidebar = versatile_business_get_sidebar_id();

	$layout_class = "layout-no-sidebar-content-width";

	if ( 'no-sidebar-full-width' === $layout ) {
		$layout_class = 'layout-no-sidebar-full-width';
	} elseif ( 'left-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'layout-left-sidebar';
		}
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'layout-right-sidebar';
		}
	}

	$classes[] = $layout_class;

	// Add Site Layout Class.
	$classes[] = esc_attr( versatile_business_gtm( 'versatile_business_layout_type' ) . '-layout' );

	// Add Archive Layout Class.
	$classes[] = 'grid';

	// Add header Style Class.
	$classes[] = 'header-one';

	$versatile_business_enable = versatile_business_gtm( 'versatile_business_header_image_visibility' );

	if ( ! versatile_business_display_section( $versatile_business_enable ) || ( ! has_header_image() && ! ( is_header_video_active() && has_header_video() ) ) ) {
    	$classes[] = 'no-header-media';
    }

	return $classes;
}
add_filter( 'body_class', 'versatile_business_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function versatile_business_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'versatile_business_pingback_header' );

if ( ! function_exists( 'versatile_business_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 */
	function versatile_business_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Theme Options
		$length	= versatile_business_gtm( 'versatile_business_excerpt_length' );

		return absint( $length );
	} // versatile_business_excerpt_length.
endif;
add_filter( 'excerpt_length', 'versatile_business_excerpt_length', 999 );

if ( ! function_exists( 'versatile_business_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function versatile_business_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = versatile_business_gtm( 'versatile_business_excerpt_more_text' );

		$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
		);

		return '&hellip;' . $link;
	}
endif;
add_filter( 'excerpt_more', 'versatile_business_excerpt_more' );

if ( ! function_exists( 'versatile_business_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 */
	function versatile_business_custom_excerpt( $output ) {
		if ( is_admin() ) {
			return $output;
		}

		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = versatile_business_gtm( 'versatile_business_excerpt_more_text' );

			$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
			);

			$output .= '&hellip;' . $link;
		}

		return $output;
	} // versatile_business_custom_excerpt.
endif;
add_filter( 'get_the_excerpt', 'versatile_business_custom_excerpt' );

if ( ! function_exists( 'versatile_business_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 */
	function versatile_business_more_link( $more_link, $more_link_text ) {
		$more_tag_text = versatile_business_gtm( 'versatile_business_excerpt_more_text' );

		return str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	} // versatile_business_more_link.
endif;
add_filter( 'the_content_more_link', 'versatile_business_more_link', 10, 2 );

/**
 * Filter Homepage Options as selected in theme options.
 */
function versatile_business_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = versatile_business_gtm( 'versatile_business_front_page_category' );

		if ( $cats ) {
			$query->query_vars['category__in'] = explode( ',', $cats );
		}
	}
}
add_action( 'pre_get_posts', 'versatile_business_alter_home' );

/**
 * Display section as selected in theme options.
 */
function versatile_business_display_section( $option ) {
	if ( 'entire-site' === $option || ( is_front_page() && 'homepage' === $option ) || ( ! is_front_page() && 'excluding-home' === $option ) ) {
		return true;
	}

	// Section is disabled.
	return false;
}

/**
 * Return theme layout
 * @return layout
 */
function versatile_business_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = versatile_business_gtm( 'versatile_business_default_layout' );

		if ( is_home() || is_archive() ) {
			$layout = versatile_business_gtm( 'versatile_business_homepage_archive_layout' );
		}
	}

	return $layout;
}

/**
 * Return theme layout
 * @return layout
 */
function versatile_business_get_sidebar_id() {
	$sidebar = '';

	$layout = versatile_business_get_theme_layout();

	if ( 'no-sidebar-full-width' === $layout ) {
		return $sidebar;
	}

	return is_active_sidebar( $sidebar ) ? $sidebar : 'sidebar-1'; // sidebar-1 is main sidebar.
}


/**
 * Function to add Scroll Up icon
 */
function versatile_business_scrollup() {
	$disable_scrollup = versatile_business_gtm( 'versatile_business_band_disable_scrollup' );

	if ( $disable_scrollup ) {
		return;
	}

	echo '<a href="#masthead" id="scrollup" class="backtotop">' . '<span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'versatile-business' ) . '</span></a>' ;

}
add_action( 'wp_footer', 'versatile_business_scrollup', 1 );

/**
 * Return args for specific section type
 */
function versatile_business_get_section_args( $section_name ) {
	$numbers = versatile_business_gtm( 'versatile_business_' . $section_name . '_number' );

	$args = array(
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => absint( $numbers ),
		'post_type'           => 'page',
	);

	// If post or page or product, then set post__in argument.
	$post__in = array();

	for( $i = 0; $i < $numbers; $i++ ) {
		$post__in[] = versatile_business_gtm( 'versatile_business_' . $section_name . '_page_' . $i );
	}

	$args['post__in'] = $post__in;
	$args['orderby']  = 'post__in';

	return $args;
}
