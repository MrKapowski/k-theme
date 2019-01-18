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
	function mrkapowski_post_type() {
		// Check if we have a Post Kind:
		if ( function_exists( 'has_post_kind' ) && has_post_kind() ) {
			$output = get_post_kind();
		} else {
			$output = get_post_type();
		}
		echo esc_html( $output );
	}
}
/**
 * Displays an icon for Post Kind if there is one, a Post Format, or nothing
 *
 * @since K 0.8.4
 */
if ( ! function_exists( 'mrkapowski_post_type_icon' ) ) {
	function mrkapowski_post_type_icon() {
		$output = '';
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
		echo wp_kses(
			$output,
			array(
				'svg'   => array(
					'class'           => array(),
					'aria-hidden'     => array(),
					'aria-labelledby' => array(),
					'role'            => array(),
				),
				'span'  => array(
					'class' => array(),
				),
				'use'   => array(
					'href'       => array(),
					'xlink:href' => array(),
				),
				'title' => array(),
				'desc'  => array(),
			)
		);
	}
}

if ( ! function_exists( 'mrkapowski_the_tags' ) ) {
	function mrkapowski_the_tags() {
		$tags = get_the_tags();
		$html = '';
		if ( $tags ) {
			$html = '<ul class="post_tags list-inline small">';
			foreach ( $tags as $tag ) {
				$tag_link = get_tag_link( $tag->term_id );

				$html .= '<li class="list-inline-item">' . "<a href='{$tag_link}' title='{$tag->name} Tag' class='{$tag->slug} p-category'>";
				$html .= mrkapowski_get_svg(
					array(
						'icon'    => 'tag',
						'set'     => 'solid',
						'classes' => 'icon',
					)
				);
				$html .= " {$tag->name}</a></li>";
			}
			$html .= '</span>';
		}
		echo $html;
	}
}
