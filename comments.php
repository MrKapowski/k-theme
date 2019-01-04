<?php
/**
 * The template for displaying Comments.
 *
 * @package K
 * @since   K 0.5
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<footer>
	<?php if ( have_comments() ) : ?>
	<header>
		<h5 class="comments-title">
			<?php
			printf(
				// translators:
				esc_html( _n( '%s Comment', '%s Comments', get_comments_number(), 'mrkapowski' ) ),
				esc_html( number_format_i18n( get_comments_number() ) ),
				'<span>' . esc_html( get_the_title() ) . '</span>'
			);
			?>
		</h5>
	</header>
	<section>
		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'mrkapowski' ); ?></p>
		<?php endif; ?>
		<ol class="comment-list">
		<?php
			wp_list_comments(
				array(
					'type'     => 'comment',
					'callback' => 'mrkapowski_comment',
				)
			);
		?>
		</ol><!-- .comment-list -->
		<hr>
	</section>
	<?php endif; ?>
	<footer>
	<?php if ( comments_open() ) : ?>
		<div id="commentform-top"></div>
		<?php comment_form( mrkapowski_comment_form_args() ); ?>
	<?php endif; ?>
	</footer>
</footer>
