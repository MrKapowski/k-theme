<?php
/*
 * Repost Template
 *
 */

if ( ! $cite ) {
	return;
}
$author = Kind_View::get_hcard( ifset( $cite['author'] ) );
$url    = ifset( $cite['url'] );
$embed  = self::get_embed( $url );

?>

<section class="response u-repost-of h-cite post-kind post-kind-repost">
	<?php
	echo Kind_Taxonomy::get_before_kind( 'repost' );
	if ( ! $embed ) {
		if ( ! array_key_exists( 'name', $cite ) ) {
			$cite['name'] = self::get_post_type_string( $url );
		}
		if ( isset( $url ) ) {
			echo sprintf( '<p class="lead">Reposting: <a href="%1s" class="p-name u-url">%2s</a></p>', $url, $cite['name'] );
		} else {
			echo sprintf( '<p class="lead"><span class="p-name">%1s</span></p>', $cite['name'] );
		}
	}
	?>
	<?php if ( $cite ) : ?>
	<blockquote class="e-summary blockquote">
		<?php
		if ( $embed ) {
			echo $embed;
		} elseif ( array_key_exists( 'summary', $cite ) ) {
			echo wpautop($cite['summary']);
		}
		?>
		<?php if ( $author ) : ?>
		<footer class="blockquote-footer">
			<?php echo $author; ?>
			<?php
			if ( array_key_exists( 'publication', $cite ) ) {
				echo sprintf( ' <em>(<span class="p-publication">%1s</span>)</em>', $cite['publication'] );
			}
			?>
		</footer>
		<?php endif; ?>
		<?php if ( ( ! $author ) && array_key_exists( 'publication', $cite ) ) : ?>
		<footer class="blockquote-footer">
			<?php
				echo sprintf( ' <span class="p-publication">%1s</span>', $cite['publication'] );
			?>
		</footer>
		<?php endif; ?>
	</blockquote>
	<?php endif; ?>
	<hr class="text-center w-25">
</section>

<?php
// Close Response
