<?php
/**
 * K theme functions and definitions
 *
 * @package K
 * @since   K 0.1
 */

/*
 * TODO: Filter <title> elements on untitled posts to the posted date/time
 * TODO: Function to check/return if there's a Post Kind or Format
 */

// Queue up our theme stylesheet
wp_enqueue_style( 'style', get_stylesheet_uri(), '', wp_get_theme()->get( 'Version' ) );

if ( ! isset( $content_width ) ) {
	$content_width = 825;
}
add_filter( 'show_admin_bar', '__return_false' );

if ( ! function_exists( 'mrkapowski_setup' ) ) {

	// Sets up theme defaults and registers support for various WordPress features.

	function mrkapowski_setup() {
		// Register support for microformats + microdata
		add_theme_support( 'microformats2' );
		add_theme_support( 'microformats' );
		add_theme_support( 'microdata' );

		add_theme_support( 'automatic-feed-links' );
		// Register HTML5 support
		add_theme_support(
			'html5',
			array(
				'comment-list',
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);
		add_theme_support( 'title-tag' );
		register_nav_menus(
			array(
				'primary'   => __( 'Primary Menu', 'mrkapowski' ),
				'secondary' => __( 'Secondary Menu', 'mrkapowski' ),
				'social'    => __( 'Social Menu', 'mrkapowski' ),
			)
		);
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'status' ) );
		add_theme_support( 'responsive-embeds' );
		add_post_type_support( 'post', 'post-formats' );
		register_taxonomy_for_object_type( 'post_format', 'post' );
		/**
		 * Enable features from Soil when plugin is activated
		 * @link https://roots.io/plugins/soil/
		 */
		add_theme_support( 'soil-clean-up' );
		add_theme_support( 'soil-jquery-cdn' );
		add_theme_support( 'soil-js-to-footer' );
		add_theme_support( 'soil-nav-walker' );
		add_theme_support( 'soil-nice-search' );
	}
}
add_action( 'after_setup_theme', 'mrkapowski_setup' );

function mrkapowski_semantic_linkbacks() {
	remove_action( 'comment_form_before', array( 'Linkbacks_Handler', 'show_mentions' ) );
	remove_action( 'comment_form_comments_closed', array( 'Linkbacks_Handler', 'show_mentions' ) );
	remove_filter( 'wp_list_comments_args', array( 'Linkbacks_Handler', 'filter_comment_args' ) );

	add_action( 'comment_mentions', array( 'Linkbacks_Handler', 'show_mentions' ) );
}

add_action( 'wp_loaded', 'mrkapowski_semantic_linkbacks' );

function mrkapowski_special_nav_class( $atts, $item, $args ) {
	$class         = 'card-link text-muted';
	$atts['class'] = $class;
	return $atts;
}

/**
 * Filters the Social menu to add social media profile icons
 */
add_filter( 'walker_nav_menu_start_el', 'mrkapowski_nav_menu_social_icons', 10, 4 );

/**
 * Custom Comment Walker template.
 * @since K 0.8.4
 */
require get_template_directory() . '/classes/class-mrkapowski-walker-comment.php';

/**
 * Registers the custom walker for this theme
 * @since K 0.8.4
 */
function mrkapowski_filter_comment_args( $args ) {
	$args['walker'] = new MrKapowski_Walker_Comment();
	return $args;
}

/**
 * Filters wp_list_comments $args to apply our Walker_Comment
 * @since K 0.8.4
 */
add_filter( 'wp_list_comments_args', 'mrkapowski_filter_comment_args' );

/**
 * Adds the reformatted textarea into the comment form
 */
add_action( 'comment_form_defaults', 'mrkapowski_add_textarea' );

/**
 * Filters the comment form, to add our customised submit button
 */
add_filter( 'comment_form_submit_field', 'mrkapowski_submit_button' );

/**
 * Filters Jetpack styles, to stop them being bundled together, allowing us to deregister them
 */
add_filter( 'jetpack_implode_frontend_css', '__return_false' );
/**
 * Deregisters Jetpack inserted stylesheets, to stop them interfering with theme styles
 */
function mrkapowski_deregister_styles() {
	wp_deregister_style( 'dashicons' );
	wp_deregister_style( 'jetpack-widget-social-icons-styles' );
	wp_deregister_style( 'AtD_style' ); // After the Deadline
	wp_deregister_style( 'jetpack_likes' ); // Likes
	wp_deregister_style( 'jetpack_related-posts' ); //Related Posts
	wp_deregister_style( 'jetpack-carousel' ); // Carousel
	wp_deregister_style( 'grunion.css' ); // Grunion contact form
	wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
	wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
	wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
	wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
	wp_deregister_style( 'noticons' ); // Notes
	wp_deregister_style( 'post-by-email' ); // Post by Email
	wp_deregister_style( 'publicize' ); // Publicize
	wp_deregister_style( 'sharedaddy' ); // Sharedaddy
	wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
	wp_deregister_style( 'stats_reports_css' ); // Stats
	wp_deregister_style( 'jetpack-widgets' ); // Widgets
	wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
	wp_deregister_style( 'presentations' ); // Presentation shortcode
	wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
	wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
	wp_deregister_style( 'widget-conditions' ); // Widget Visibility
	wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
	wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget
	wp_deregister_style( 'widget-grid-and-list' ); // Top Posts widget
	wp_deregister_style( 'jetpack-widgets' ); // Widgets
}
/**
 * Removes the deregistered Jetpack stylesheets
 */
add_action( 'wp_print_styles', 'mrkapowski_deregister_styles', 100 );

/**
 * Sets Do-Not-Track for Jetpack stats
 */
// TODO: make this a customisable option
add_filter( 'jetpack_honor_dnt_header_for_stats', '__return_true' );

/**
 * Register  the sidebar Widgets area
 */
function mrkapowski_sidebar() {
	$args = array(
		'id'            => 'main-sidebar',
		'name'          => __( 'Main Sidebar', 'mrkapowski' ),
		'description'   => __( 'Right-side Sidebar.', 'mrkapowski' ),
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
	);
	register_sidebar( $args );
}
/**
 * Adds the widget area to the control panel
 */
add_action( 'widgets_init', 'mrkapowski_sidebar' );

/**
 * Overrides the Webmention comment form with our bundled template
 */
function mrkapowski_webmention_form() {
	return get_stylesheet_directory() . '/webmention-comment-form.php';
}
/**
 * Filters the webmention form, so our custom template is applied
 */
add_filter( 'webmention_comment_form', 'mrkapowski_webmention_form' );

/**
 * Add useful extra classes to images, for layout and MF2
 */
function mrkapowski_add_image_classes( $class ) {
	$classes = array( 'mw-100', 'u-photo' );
	$class  .= ' ';
	$class  .= implode( ' ', $classes );
	return $class;
}
/**
 * Remove width and height from editor images, for responsiveness
 */
function mrkapowski_remove_image_dimensions( $html ) {
	$html = preg_replace( '/( width|height )=\"\d*\"\s/', '', $html );
	return $html;
}
/**
 * Filter inserted images, to apply our customisations
 */
add_filter( 'get_image_tag_class', 'mrkapowski_add_image_classes' );
/**
 * Filter thumbnails, to apply our customisations
 */
add_filter( 'post_thumbnail_html', 'mrkapowski_remove_image_dimensions', 10 );
/**
 * Filter images in the editor, to apply our customisations
 */
add_filter( 'image_send_to_editor', 'mrkapowski_remove_image_dimensions', 10 );

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';
