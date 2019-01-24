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
 * Custom Comment Walker template.
 * @since K 0.8.4
 */
require get_template_directory() . '/classes/class-mrkapowski-walker-comment.php';

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

/**
 * Plugin support for the theme.
 */
require get_template_directory() . '/inc/plugin-support.php';

require get_template_directory() . '/widgets/class-mrkapowski-hcard-widget.php';
