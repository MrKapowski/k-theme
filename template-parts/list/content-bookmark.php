<?php
$cite = mrkapowski_post_kind_metadata( $post );
set_query_var( 'cite', $cite );
if ( ! $cite ) {
	return;
}
$author = Kind_View::get_hcard( ifset( $cite['author'] ) );
$url    = ifset( $cite['url'], '' );
?>
<article itemscope itemtype="http://schema.org/BlogPosting" itemid="<?php the_permalink(); ?>" <?php post_class( array( 'h-entry', 'hentry', 'post-bookmark', 'post-activity' ) ); ?>>
	<p class="lead p-summary"><?php mrkapowski_post_type_icon(); ?> <?php echo esc_html( Kind_Taxonomy::get_kind_info( get_post_kind_slug(), 'verb' ) ); ?>
		<span class="h-cite u-bookmark-of">
		<?php
		if ( ! array_key_exists( 'name', $cite ) ) {
			$cite['name'] = Kind_View::get_post_type_string( $url );
		}
		if ( isset( $url ) ) {
			echo sprintf( '<a href="%1s" class="p-name u-url">%2s</a>', esc_url( $url ), esc_html( $cite['name'] ) );
		} else {
			echo sprintf( '<span class="p-name">%1s</span>', esc_html( $cite['name'] ) );
		}
		if ( $author ) {
			echo wp_kses(
				' ' . __( 'by', 'indieweb-post-kinds' ) . ' ' . $author,
				array(
					'a' => array(
						'href'  => array(),
						'class' => array(),
						'rel'   => array(),
					),
				)
			);
		}
		if ( array_key_exists( 'publication', $cite ) ) {
			echo sprintf( ' <em>(<span class="p-publication">%1s</span>)</em>', esc_html( $cite['publication'] ) );
		}
		?>
		</span>
		<?php get_template_part( 'template-parts/posts/activity-metadata' ); ?>
	</p>
	<meta class="dt-modified" itemprop="dateModified" content="<?php the_modified_date( 'c' ); ?>">
	<?php get_template_part( 'template-parts/posts/author-details' ); ?>
	<?php get_template_part( 'template-parts/posts/publisher-details' ); ?>
</article>
<?php
//end output
