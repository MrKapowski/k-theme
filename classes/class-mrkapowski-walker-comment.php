<?php
/**
 * Custom comment walker for this theme
 *
 * @package K
 * @since 0.8.4
 */

/**
 * This class outputs custom comment walker for HTML5 friendly WordPress comment and threaded replies.
 *
 * @since 0.8.4
 */
class MrKapowski_Walker_Comment extends Walker_Comment {
	/**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {
		$comment_content_class = ''; // Used to style the comment-content differently when comment is awaiting moderation ?>
			<li <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?> id="li-comment-<?php comment_ID( $comment ); ?>">
			<?php echo get_avatar( $comment, 64 ); ?>
			<div class="comment walker">
				<div class="comment-author vcard h-card">
					<h6 class="">
						<span class="fn"><?php comment_author_link( $comment ); ?></span>
						<small class="text-muted"> @ <a href="<?php echo esc_url( get_comment_link() ); ?>" class="card-link">
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
