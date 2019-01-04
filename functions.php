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
		add_theme_support( 'automatic-feed-links' );
		add_theme_support(
			'html5',
			array(
				'comment-list',
				'search-form',
				'comment-form',
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
	}
}
add_action( 'after_setup_theme', 'mrkapowski_setup' );

function mrkapowski_special_nav_class( $atts, $item, $args ) {
	$class         = 'card-link text-muted';
	$atts['class'] = $class;
	return $atts;
}

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function mrkapowski_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'mrkapowski' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'mrkapowski' );
	}

	// Set defaults.
	$defaults = array(
		'icon'     => '',
		'title'    => '',
		'desc'     => '',
		'fallback' => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set ARIA.
	$aria_labelledby = '';

	/*
	 * mrkapowski theme doesn't use the SVG title or description attributes; non-decorative icons are described with .screen-reader-text.
	 *
	 * However, child themes can use the title and description to add information to non-decorative SVG icons to improve accessibility.
	 *
	 * Example 1 with title: <?php echo mrkapowski_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ) ) ); ?>
	 *
	 * Example 2 with title and description: <?php echo mrkapowski_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ), 'desc' => __( 'This is the description', 'textdomain' ) ) ); ?>
	 *
	 * See https://www.paciellogroup.com/blog/2013/12/using-aria-enhance-svg-accessibility/.
	 */
	if ( $args['title'] ) {
		$aria_hidden     = '';
		$unique_id       = uniqid();
		$aria_labelledby = ' aria-labelledby="title-' . $unique_id . '"';

		if ( $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title-' . $unique_id . ' desc-' . $unique_id . '"';
		}
	}

	// Begin SVG markup.
	$svg = '<svg class="icon icon-2x icon-' . esc_attr( $args['icon'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// Display the title.
	if ( $args['title'] ) {
		$svg .= '<title id="title-' . $unique_id . '">' . esc_html( $args['title'] ) . '</title>';

		// Display the desc only if the title is already set.
		if ( $args['desc'] ) {
			$svg .= '<desc id="desc-' . $unique_id . '">' . esc_html( $args['desc'] ) . '</desc>';
		}
	}

	/*
	 * Display the icon.
	 *
	 * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
	 *
	 * See https://core.trac.wordpress.org/ticket/38387.
	 */
	$svg .= ' <use href="' . get_template_directory_uri() . '/assets/img/brands.svg#' . esc_html( $args['icon'] ) . '" xlink:href="' . get_template_directory_uri() . '/assets/img/brands.svg#' . esc_html( $args['icon'] ) . '"></use> ';

	// Add markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= '</svg>';

	return $svg;
}

/**
 * Display an SVG.
 *
 * @param  array  $args  Parameters needed to display an SVG.
 */
function mrkapowski_do_svg( $args = array() ) {
	echo esc_html( mrkapowski_get_svg( $args ) );
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function mrkapowski_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Get supported social icons.
	$social_icons = mrkapowski_social_links_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . mrkapowski_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
			}
		}
	}

	return $item_output;
}
/**
 * Filters the Social menu to add social media profile icons
 */
add_filter( 'walker_nav_menu_start_el', 'mrkapowski_nav_menu_social_icons', 10, 4 );

/**
 * Returns an array of supported social links ( URL and icon name ).
 *
 * @return array $social_links_icons
 */
function mrkapowski_social_links_icons() {
	// Supported social links icons.
	$social_links_icons = array(
		'github.com'      => 'github',
		'twitter.com'     => 'twitter',
		'instagram.com'   => 'instagram',
		'codepen.io'      => 'codepen',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'linkedin.com'    => 'linkedin-alt',
		'mailto:'         => 'mail',
		'pinterest.com'   => 'pinterest-alt',
		'getpocket.com'   => 'pocket',
		'reddit.com'      => 'reddit',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'soundcloud.com'  => 'cloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'vimeo.com'       => 'vimeo',
		'weibo.com'       => 'weibo',
		'wordpress'       => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'youtube.com'     => 'youtube',
	);

	/**
	 * Filters mrkapowski theme social links menu icons.
	 *
	 * @param array $social_links_icons
	 */
	return apply_filters( 'mrkapowski_nav_social_icons', $social_links_icons );
}

/**
 * Returns the number of webmentions, pings/trackbacks the current post has
 */
if ( ! function_exists( 'mrkapowski_comment_count_mentions' ) ) {
	function mrkapowski_comment_count_mentions() {
		$args   = array(
			'post_id'  => get_the_ID(),
			'type__in' => array( 'pings', 'webmention' ),
		);
		$_query = new WP_Comment_Query();
		return count( $_query->query( $args ) );
	}
}
/**
 * Formats the current comment into markup compatible with the K theme.
 */
if ( ! function_exists( 'mrkapowski_comment' ) ) {
	function mrkapowski_comment( $comment, $args, $depth ) {
		$GLOBALS['comment']    = $comment; // TODO: Can this be changed to get rid of the $GLOBALS[]?
		$comment_content_class = ''; // Used to style the comment-content differently when comment is awaiting moderation ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<?php echo get_avatar( $comment, 64 ); ?>
			<div class="comment">
				<div class="comment-author vcard h-card">
					<h6 class="">
						<span class="fn"><?php comment_author_link(); ?></span>
						<small class="text-muted"> @ <a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>" class="card-link">
							<time pubdate datetime="<?php comment_time( 'c' ); ?>">
								<?php echo esc_html( get_comment_date() ); ?>
							</time>
						</a></small></h6>
					<?php if ( '0' === $comment->comment_approved ) : ?>
						<?php $comment_content_class = 'unapproved'; ?>
						<em><?php esc_html_e( ' - Your comment is awaiting moderation.', 'mrkapowski' ); ?></em>
					<?php endif; ?>
			</div>
			<div class="comment-body">
				<div class="comment-content card-text <?php echo esc_html( $comment_content_class ); ?>"><?php comment_text(); ?></div>
				<?php
				comment_reply_link(
					array_merge(
						$args,
						array(
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'class'     => 'card-link',
						)
					)
				);
				?>
				<hr>
			</div>
		</div>
		<?php
	}
}

/**
 * Formats the comment form into markup compatible with the K theme.
 */
if ( ! function_exists( 'mrkapowski_comment_form_args' ) ) {
	function mrkapowski_comment_form_args() {
		if ( ! is_user_logged_in() ) {
			$comment_notes_before = '';
			$comment_notes_after  = '';
		} else {
			$comment_notes_before = '';
			$comment_notes_after  = '';
		}

		$user          = wp_get_current_user();
		$commenter     = wp_get_current_commenter();
		$req           = get_option( 'require_name_email' );
		$aria_req      = ( $req ? " aria-required='true'" : '' );
		$consent       = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		$login_link    = sprintf(// translators:
			__( 'You must be <a href="%s">logged in</a> to post a comment.', 'mrkapowski' ),
			wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
		);
		$loggedin_link = sprintf(// translators:
			__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'mrkapowski' ),
			admin_url( 'profile.php' ),
			$user->display_name,
			wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )
		);

		$args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit',
			'title_reply'          => 'Leave a comment',
			// translators:
			'title_reply_to'       => __( 'Leave a Reply for %s', 'mrkapowski' ),
			'cancel_reply_link'    => __( 'Cancel Reply', 'mrkapowski' ),
			'label_submit'         => __( 'Submit Comment', 'mrkapowski' ),
			'must_log_in'          => '<p class="form-text must-log-in text-muted">' . $login_link . '</p>',
			'logged_in_as'         => '<p class="form-text text-muted logged-in-as">' . $loggedin_link . '</p>',
			'comment_notes_before' => $comment_notes_before,
			'comment_notes_after'  => $comment_notes_after,
			'fields'               => apply_filters(
				'comment_form_default_fields',
				array(
					'author'  =>
						'<div class="form-row"><div class="comment-form-author form-group col-md-4"><label for="author" class="sr-only">' . __( 'Name', 'mrkapowski' ) . '</label>' . ( $req ? '' : '' ) .
						'<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
						'"' . $aria_req . ' placeholder=' . __( 'Name', 'mrkapowski' ) . '></div>',
					'email'   =>
						'<div class="comment-form-email form-group col-md-4"><label for="email" class="sr-only">' . __( 'Email', 'mrkapowski' ) . '</label>' . ( $req ? '' : '' ) .
						'<input id="email" class="form-control" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
						'"' . $aria_req . ' placeholder=' . __( 'Email', 'mrkapowski' ) . '></div>',
					'url'     =>
						'<div class="comment-form-url form-group col-md-4"><label for="url" class="sr-only">' . __( 'Website', 'mrkapowski' ) . '</label>' .
						'<input id="url" class="form-control" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
						'" placeholder=' . __( 'Website', 'mrkapowski' ) . '></div></div>',
					'cookies' => '<div class="comment-form-consent form-group form-check col-md-12"><input class="form-check-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
					'<label for="wp-comment-cookies-consent" class="form-check-label">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'mrkapowski' ) . '</label></div>',
				)
			),
		);

		return $args;
	}
}

/**
 * Recreates the comment form textarea HTML for reinclusion in comment form
 */
if ( ! function_exists( 'mrkapowski_add_textarea' ) ) {
	function mrkapowski_add_textarea() {
		$arg['comment_field'] = '<div class="form-row"><div class="form-group col-md-12 comment-form-comment"><label for="comment">' . __( 'Comment', 'mrkapowski' ) . '</label>' .
		'<textarea class="form-control" id="comment" name="comment" cols="60" rows="6" aria-required="true"></textarea></div></div>';
		return $arg;
	}
}
/**
 * Adds the reformatted textarea into the comment form
 */
add_action( 'comment_form_defaults', 'mrkapowski_add_textarea' );

/**
 * Adds additional classes to the submit button on the comment form
 */
if ( ! function_exists( 'mrkapowski_submit_button' ) ) {
	function mrkapowski_submit_button( $submit_field ) {
		$changed_submit = str_replace( 'name="submit" type="submit" id="submit"', 'name="submit" type="submit" id="submit" class="btn btn-primary"', $submit_field );
		return $changed_submit;
	}
}
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
 * Enable features from Soil when plugin is activated
 * @link https://roots.io/plugins/soil/
 */
add_theme_support( 'soil-clean-up' );
add_theme_support( 'soil-jquery-cdn' );
add_theme_support( 'soil-js-to-footer' );
add_theme_support( 'soil-nav-walker' );
add_theme_support( 'soil-nice-search' );
