<?php
/*
 * Read Template
 *
 */

if ( ! $cite ) {
	return;
}
$author = Kind_View::get_hcard( ifset( $cite['author'] ) );
$url    = ifset( $cite['url'] );
$embed  = self::get_embed( $url );
$read   = $mf2_post->get( 'read-status', true );

?>

<section class="u-read-of h-cite post-kind post-kind-read">
	<p class="lead read">
	<?php
	echo Kind_Taxonomy::get_before_kind( 'read' );
	if ( ! $embed ) {
		if ( ! array_key_exists( 'name', $cite ) ) {
			$cite['name'] = self::get_post_type_string( $url );
		}
		if ( $read ) {
			echo sprintf( ' - <span class="p-read-status">%1s</span>', Kind_View::read_text( $read ) );
		}
		if ( isset( $url ) ) {
			echo sprintf( '<a href="%1s" class="p-name u-url">%2s</a>', $url, $cite['name'] );
		} else {
			echo sprintf( '<span class="p-name">%1s</span>', $cite['name'] );
		}
	}
	?>
	</p>
	<?php if ( $cite ) : ?>
	<blockquote class="e-summary blockquote">
		<?php
		if ( $embed ) {
			echo $embed;
		} elseif ( array_key_exists( 'summary', $cite ) ) {
			echo wpautop( wptexturize( '"' . $cite['summary'] . '"' ) );
		}
		?>
		<?php if ( $author ) : ?>
		<footer class="blockquote-footer">
			<cite>
				<?php echo $author; ?>
				<?php
				if ( array_key_exists( 'publication', $cite ) ) {
					echo sprintf( ' <em>(<span class="p-publication">%1s</span>)</em>', $cite['publication'] );
				}
				?>
			</cite>
		</footer>
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
