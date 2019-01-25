<?php
/**
 * Provides features to support various plugins
 * @since K 0.8.4
 */
/**
 * Allow arbitrary HTML in Post Kinds
 * @since K 0.8.4
 */
define( 'POST_KINDS_KSES', true );

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
	// Other plugins
	wp_deregister_style( 'kind' ); // Post-Kinds
	wp_deregister_style( 'indieweb' ); // IndieWeb
	wp_deregister_style( 'semantic-linkbacks-css' ); // Semantic Linkbacks
	wp_deregister_style( 'syndication-style' ); // Syndication Links
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
 * Provides various overrides to functionality provided by the Semantic Linkbacks Plugin
 * @since K 0.8.4
 */
function mrkapowski_indie_web_plugins() {
	remove_action( 'comment_form_before', array( 'Linkbacks_Handler', 'show_mentions' ) );
	remove_action( 'comment_form_comments_closed', array( 'Linkbacks_Handler', 'show_mentions' ) );
	remove_filter( 'wp_list_comments_args', array( 'Linkbacks_Handler', 'filter_comment_args' ) );
	remove_filter( 'get_comment_text', array( 'Linkbacks_Handler', 'comment_text_add_cite' ), 11 );

	remove_filter( 'the_content', array( 'Kind_View', 'content_response' ), 20 );
	remove_filter( 'the_excerpt', array( 'Kind_View', 'excerpt_response' ), 20 );

	add_action( 'comment_mentions', 'mrkapowski_show_mentions' );
}
/**
 * Actions our Semantic Linkback overrides
 * @since K 0.8.4
 */
add_action( 'wp_loaded', 'mrkapowski_indie_web_plugins' );

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
 * Loads custom template for Semantic Linkbacks mentions.
 * @since K 0.8.4
 */
function mrkapowski_show_mentions() {
	get_template_part( 'template-parts/webmentions' );
}

/**
 * Overrides Post-Kinds Author output
 * @since K 0.8.4
 */
function mrkapowski_kind_hcard( $string, $author, $args ) {
	return sprintf( '<a class="h-card p-author" rel="external" href="%1s">%2s</a>', $author['url'], $author['name'] );
}
/**
 * Filters the webmention form, so our custom template is applied
 */
add_filter( 'get_hcard', 'mrkapowski_kind_hcard', 10, 3 );
