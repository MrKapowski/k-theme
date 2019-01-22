<?php
/*
 * Like Template
 *
 */

if ( ! $cite ) {
	return;
}
$author = Kind_View::get_hcard( ifset( $cite['author'] ) );
$url    = ifset( $cite['url'], '' );
$embed  = Kind_View::get_embed( $url );
$verb =  Kind_Taxonomy::get_kind_info( get_post_kind_slug(), 'verb' )
?>

<section class="response u-like-of h-cite post-kind post-kind-like">
	<?php
	echo Kind_Taxonomy::get_before_kind( 'like' );
	if ( ! $embed ) {
		if ( ! array_key_exists( 'name', $cite ) ) {
			$cite['name'] = Kind_View::get_post_type_string( $url );
		}
		if ( isset( $url ) ) {
			echo sprintf( '<p class="lead">%1s: <a href="%2s" class="p-name u-url">%3s</a></p>', esc_html( $verb ), esc_url( $url ), esc_html( $cite['name'] ) );
		} else {
			echo sprintf( '<span class="p-name">%1s</span>', esc_html( $cite['name'] ) );
		}
	}
	?>
	<?php if ( $cite && ( ( array_key_exists( 'summary', $cite ) && '' !== $cite['summary'] ) || isset( $embed ) ) ) : ?>
	<blockquote class="e-summary blockquote">
		<?php
		if ( $embed ) {
			echo $embed;
		} elseif ( array_key_exists( 'summary', $cite ) ) {
			echo wpautop( wptexturize( '"' . $cite['summary'] . '"' ) );
		}
		?>
		<?php if ( $author ) : ?>
		<footer class="blockquote-footer"><cite class="u-quotation-of h-cite">
			<?php echo $author; ?>
			<?php
			if ( array_key_exists( 'publication', $cite ) ) {
				echo sprintf( ' <em>(<span class="p-publication">%1s</span>)</em>', esc_html( $cite['publication'] ) );
			}
			?>
		</cite></footer>
		<?php endif; ?>
	</blockquote>
	<?php endif; ?>
	<hr class="text-center w-25">
</section>

<?php
