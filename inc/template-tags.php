<?php
/**
 * Custom template tags for this theme
 *
 * @package K
 * @since 0.8.4
 */

/**
 * Display an SVG.
 *
 * @param  array  $args  Parameters needed to display an SVG.
 * @since K 0.6.1
 */
function mrkapowski_do_svg( $args = array(), $echo = true ) {
	if ( true === $echo ) {
		echo esc_html( mrkapowski_get_svg( $args ) );
	} else {
		return mrkapowski_get_svg( $args );
	}
}
/**
 * Displays a Post Kind if there is one, a Post Format, or nothing
 *
 * @since K 0.8.4
 */
if ( ! function_exists( 'mrkapowski_post_type' ) ) {
	function mrkapowski_post_type( $icon = false ) {
		// Check if we have a Post Kind:
		if ( function_exists( 'has_post_kind' ) && has_post_kind() ) {
			$output = get_post_kind();
		} else {
			$output = get_post_type();
		}
		return $output;
	}
}
/**
 * Displays an icon for Post Kind if there is one, a Post Format, or nothing
 *
 * @since K 0.8.4
 */
if ( ! function_exists( 'mrkapowski_post_type_icon' ) ) {
	function mrkapowski_post_type_icon() {
		// Check if we have a Post Kind:
		if ( function_exists( 'has_post_kind' ) && has_post_kind() ) {
			$type = get_post_kind();
		} else {
			$type = get_post_type();
		}
		if ( '' !== $type ) {
			$map    = array(
				'article'   => 'file-alt',
				'standard'  => 'file-alt',
				'post'      => 'file-alt',
				'note'      => 'sticky-note',
				'aside'     => 'sticky-note',
				'status'    => 'comment',
				'photo'     => 'image',
				'gallery'   => 'images',
				'bookmark'  => 'link',
				'link'      => 'link',
				'repost'    => 'retweet',
				'reply'     => 'reply',
				'like'      => 'heart',
				'favourite' => 'heart',
				'read'      => 'book',
				'quote'     => 'quote-right',
				'audio'     => 'volume-up',
				'listen'    => 'volume-up',
				'watch'     => 'eye',
				'video'     => 'film',
				'checkin'   => 'map-pin',
				'play'      => 'gamepad',
				'jam'       => 'guitar',
				'rsvp'      => 'calendar-alt',
				'issue'     => 'exclamation-circle',
			);
			$args   = array(
				'icon'    => $map[ strtolower( $type ) ],
				'set'     => 'solid',
				'classes' => '',
			);
			$output = mrkapowski_get_svg( $args, false );
		}
		return $output;
	}
}
