<div class="comment-respond">
	<h3 class="comment-reply-title"><?php esc_html_e( 'Webmention', 'webmention' ); ?></h3>
	<p class="text-muted">
<small><?php echo get_webmention_form_text( get_the_ID() /*phpcs:ignore*/); ?></small>
	</p>
	<form id="webmention-form" class="form-inline" action="<?php echo esc_url( get_webmention_endpoint() ); ?>" method="post">
		<input id="webmention-source" type="url" name="source" class="form-control mb-2 mr-2" placeholder="<?php esc_attr_e( 'URL/Permalink of your article', 'webmention' ); ?>" />
		<button id="webmention-submit" type="submit" name="submit" class="btn btn-primary mb-2 ml-2"><?php esc_html_e( 'Ping me!', 'webmention' ); ?></button>
		<input id="webmention-format" type="hidden" name="format" value="html" />
		<input id="webmention-target" type="hidden" name="target" value="<?php the_permalink(); ?>" />
	</form>
</div>
