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
				'classes' => 'align-baseline',
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
function mrkapowski_caption( $output, $attr, $content = null ) {
	extract(
		shortcode_atts(
			array(
				'id'      => '',
				'align'   => 'alignnone',
				'width'   => '',
				'caption' => '',
			),
			$attr
		)
	);

	if ( empty( $caption ) ) {
		return $content;
	}

	if ( $id ) {
		$id = 'id="' . $id . '" ';
	}

	return '<figure ' . $id . 'class="card wp-caption ' . $align . '">'
	. do_shortcode( $content ) . '<figcaption class="card-body wp-caption-text">' . $caption . '</figcaption></figure>';
}

add_filter( 'img_caption_shortcode', 'mrkapowski_caption', 3, 10 );

function mrkapowski_gallery( $output, $attr, $instance ) {
	$atts = shortcode_atts(
		array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post ? $post->ID : 0,
			'itemtag'    => $html5 ? 'figure' : 'dl',
			'icontag'    => $html5 ? 'div' : 'dt',
			'captiontag' => $html5 ? 'figcaption' : 'dd',
			'columns'    => 3,
			'size'       => 'thumbnail',
			'include'    => '',
			'exclude'    => '',
			'link'       => '',
		),
		$attr,
		'gallery'
	);

	$id = intval( $atts['id'] );

	if ( ! empty( $atts['include'] ) ) {
		$_attachments = get_posts(
			array(
				'include'        => $atts['include'],
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
			)
		);

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	} elseif ( ! empty( $atts['exclude'] ) ) {
		$attachments = get_children(
			array(
				'post_parent'    => $id,
				'exclude'        => $atts['exclude'],
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
			)
		);
	} else {
		$attachments = get_children(
			array(
				'post_parent'    => $id,
				'post_status'    => 'inherit',
				'post_type'      => 'attachment',
				'post_mime_type' => 'image',
				'order'          => $atts['order'],
				'orderby'        => $atts['orderby'],
			)
		);
	}

	if ( empty( $attachments ) ) {
			return '';
	}

	if ( is_feed() ) {
		$output = "\n";
		foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $atts['size'], true ) . "\n";
		}
		return $output;
	}

	$itemtag    = tag_escape( $atts['itemtag'] );
	$captiontag = tag_escape( $atts['captiontag'] );
	$icontag    = tag_escape( $atts['icontag'] );
	$valid_tags = wp_kses_allowed_html( 'post' );
	if ( ! isset( $valid_tags[ $itemtag ] ) ) {
			$itemtag = 'div';
	}
	if ( ! isset( $valid_tags[ $captiontag ] ) ) {
			$captiontag = 'figcaption';
	}
	if ( ! isset( $valid_tags[ $icontag ] ) ) {
			$icontag = 'figure';
	}

	$columns   = intval( $atts['columns'] );
	$itemwidth = floor(12 / $columns ); //$columns > 0 ? floor( 100 / $columns ) : 100;
	$float     = is_rtl() ? 'right' : 'left';

	$selector = "gallery-{$instance}";

	$gallery_style = '';

	$size_class  = sanitize_html_class( $atts['size'] );
	$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} card-columns'>";

	/**
		* Filters the default gallery shortcode CSS styles.
		*
		* @since 2.5.0
		*
		* @param string $gallery_style Default CSS styles and opening HTML div container
		*                              for the gallery shortcode output.
		*/
	$output = apply_filters( 'gallery_style', $gallery_style . $gallery_div );

	$i = 0;
	foreach ( $attachments as $id => $attachment ) {

		$attr = ( trim( $attachment->post_excerpt ) ) ? array( 'aria-describedby' => "$selector-$id" ) : '';
		if ( ! empty( $atts['link'] ) && 'file' === $atts['link'] ) {
				$image_output = wp_get_attachment_link( $id, $atts['size'], false, false, false, $attr );
		} elseif ( ! empty( $atts['link'] ) && 'none' === $atts['link'] ) {
				$image_output = wp_get_attachment_image( $id, $atts['size'], false, $attr );
		} else {
				$image_output = wp_get_attachment_link( $id, $atts['size'], true, false, false, $attr );
		}
		$image_meta = wp_get_attachment_metadata( $id );

		$orientation = '';
		if ( isset( $image_meta['height'], $image_meta['width'] ) ) {
				$orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
		}
		$output .= "<{$itemtag} class='gallery-item card'>";
		$output .= "
				<{$icontag} class='gallery-icon card-img-top {$orientation}'>
						$image_output
				</{$icontag}>";
		if ( $captiontag && trim( $attachment->post_excerpt ) ) {
				$output .= "
						<{$captiontag} class='wp-caption-text gallery-caption card-body' id='$selector-$id'>
						<div class='card-text'>" . wptexturize( $attachment->post_excerpt ) . "</div>
						</{$captiontag}>";
		}
		$output .= "</{$itemtag}>";
	}

	$output .= "
			</div>\n";

	return $output;
}
add_filter( 'post_gallery', 'mrkapowski_gallery', 3, 10 );
