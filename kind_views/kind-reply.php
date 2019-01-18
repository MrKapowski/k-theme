<?php
/*
 * Reply Template
 *
 */

if ( ! $cite ) {
	return;
}
$url    = ifset( $cite['url'], '' );
if ( ( ! isset( $cite['author']['url'] ) ) && isset( $url ) ) {
	$cite['author']['url'] = $url;
}
$author = Kind_View::get_hcard( ifset( $cite['author'] ) );

$embed  = self::get_embed( $url );

?>

<section class="response u-in-reply-to h-cite post-kind post-kind-reply">
	<?php
	echo Kind_Taxonomy::get_before_kind( 'reply' );
	if ( ! $embed ) {
		if ( ! array_key_exists( 'name', $cite ) ) {
			$cite['name'] = self::get_post_type_string( $url );
		}
		if ( isset( $url ) ) {
			echo sprintf( '<p class="lead">Reply To: <a href="%1s" class="p-name u-url">%2s</a></p>', $url, $cite['name'] );
		} else {
			echo sprintf( '<span class="p-name">%1s</span>', $cite['name'] );
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
				echo sprintf( ' <em>(<span class="p-publication">%1s</span>)</em>', $cite['publication'] );
			}
			?>
		</cite></footer>
		<?php endif; ?>
	</blockquote>
	<?php endif; ?>
	<hr class="text-center w-25">
</section>

<?php
