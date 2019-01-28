<?php
/**
 * Custom template functions for this theme
 *
 * @package K
 * @since 0.8.4
 */

/**
 * Returns the number of webmentions, pings/trackbacks the current post has.
 * Originally found in functions.php
 * @since 0.3
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
 * Adds additional classes to the submit button on the comment form
 */
if ( ! function_exists( 'mrkapowski_submit_button' ) ) {
	function mrkapowski_submit_button( $submit_field ) {
		$changed_submit = str_replace( 'name="submit" type="submit" id="submit"', 'name="submit" type="submit" id="submit" class="btn btn-primary"', $submit_field );
		return $changed_submit;
	}
}

if ( ! function_exists( 'mrkapowski_header_class' ) ) {
	function mrkapowski_header_class() {
		if ( ( ! has_post_format() ) || has_post_kind( 'article' ) || is_single() ) {
			echo esc_attr( 'h1' );
		} else {
			echo esc_attr( 'h3' );
		}
	}
}

/**
 * Add useful extra classes to images, for layout and MF2
 */
function mrkapowski_add_image_classes( $class ) {
	$classes = array( 'img-fluid', 'u-photo' );
	$class  .= ' ';
	$class  .= implode( ' ', $classes );
	return $class;
}
/**
 * Remove width and height from editor images, for responsiveness
 */
function mrkapowski_remove_image_dimensions( $html ) {
	$html = preg_replace( '/(height|width)=\"\d*\"\s?/', '', $html );
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
 * Filter images in the content, to apply our customisations
 */
add_filter( 'the_content', 'mrkapowski_remove_image_dimensions', 30 );

function mrkapowski_attachment_attr( $attr, $attachment, $size ) {
	if ( isset( $attr['class'] ) ) {
		$attr['class'] .= ' img-fluid u-photo';
	}
	return $attr;
}
add_filter( 'wp_get_attachment_image_attributes', 'mrkapowski_attachment_attr', 10, 3 );

/**
 * Re-enable the built-in Links manager
 */
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/**
 * Get Post-Kind metadata
 */
function mrkapowski_post_kind_metadata( $post ) {
	$mf2_post = new MF2_Post( $post );
	$kind     = $mf2_post->get( 'kind', true );
	$info     = Kind_Taxonomy::get_kind_info( $kind, 'property' );
	$cite     = $mf2_post->fetch( $info );
	return $cite;
}

function mrkapowski_post_navigation() {
	if ( is_singular() ) {
		return;
	}
	global $wp_query;
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );
	/** Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}
	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	$html = '<ul class="pagination justify-content-center">';
	/** Previous Post Link */
	if ( get_previous_posts_link() ) {
		$html .= sprintf( '<li class="page-item">%s</li>' . "\n", get_previous_posts_link() );
	} else {
		$html .= sprintf( '<li class="page-item disabled"><span class="page-link">« %1s</span></li>' . "\n", __( 'Previous Page', 'mrkapowski' ) );
	}
	/** Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links, true ) ) {
		$class = ( 1 === $paged ) ? ' class="page-item active"' : '';
		$html .= sprintf( '<li%s><a href="%s" class="page-link">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		if ( ! in_array( 2, $links, true ) ) {
			$html .= '<li class="page-item disabled"><span class="page-link">…</span></li>';
		}
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = ( $paged === $link ) ? ' class="page-item active"' : '';
		$html .= sprintf( '<li%s><a href="%s" class="page-link">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/** Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links, true ) ) {
		if ( ! in_array( $max - 1, $links, true ) ) {
			$html .= '<li class="page-item disabled"><span class="page-link">…</span></li>' . "\n";
		}

		$class = ( $paged === $max ) ? ' class="page-item active"' : '';
		$html .= sprintf( '<li%s><a href="%s" class="page-link">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/** Next Post Link */
	if ( get_next_posts_link() ) {
		$html .= sprintf( '<li class="page-item">%s</li>' . "\n", get_next_posts_link() );
	} else {
		$html .= '<li class="page-item disabled"><span class="page-link">Next Page »</span></li>' . "\n";
	}

	$html .= '</ul>' . "\n";

	echo wp_kses(
		$html,
		array(
			'ul'   => array(
				'class' => array(),
			),
			'li'   => array(
				'class' => array(),
			),
			'a'    => array(
				'class' => array(),
				'title' => array(),
				'href'  => array(),
			),
			'span' => array(
				'class' => array(),
			),
		)
	);
}

function posts_link_attributes() {
	return 'class="page-link"';
}
add_filter( 'next_posts_link_attributes', 'posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'posts_link_attributes' );
