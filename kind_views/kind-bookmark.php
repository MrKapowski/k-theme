<?php
/*
 * Bookmark Template
 *
 */

if ( ! $cite ) {
	return;
}
$author = Kind_View::get_hcard( ifset( $cite['author'] ) );
$url    = ifset( $cite['url'] );
$embed  = self::get_embed( $url );

?>

<section class="h-cite post-kind post-kind-bookmark">
	<!-- <header> -->
	<?php
	echo Kind_Taxonomy::get_before_kind( 'bookmark' );
	if ( ! $embed ) {
		if ( ! array_key_exists( 'name', $cite ) ) {
			$cite['name'] = self::get_post_type_string( $url );
		}
		if ( isset( $url ) ) {
			echo sprintf( '<p class="lead">Bookmarked: <a href="%1s" class="u-bookmark-of p-name u-url">%2s</a></p>', $url, $cite['name'] );
		} else {
			echo sprintf( '<p class="lead"><span class="p-name">%1s</span></p>', $cite['name'] );
		}
	}
	?>
	<!-- </header> -->

	<?php if ( ( array_key_exists( 'summary', $cite ) && '' !== trim( $cite['summary'] ) ) || isset( $embed ) ) : ?>
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
				echo sprintf( ' <em>(<span class="p-publication">%1s</span>)</em>', $cite['publication'] );
			}
			?>
		</cite></footer>
		<?php endif; ?>
		<?php if ( ( ! $author ) && array_key_exists( 'publication', $cite ) ) : ?>
		<footer class="blockquote-footer"><cite>
			<?php
				echo sprintf( ' <span class="p-publication">%1s</span>', $cite['publication'] );
			?>
		</cite></footer>
		<?php endif; ?>
	</blockquote>
	<?php endif; ?>
	<hr class="text-center w-25">
</section>

<?php
// Close Response
