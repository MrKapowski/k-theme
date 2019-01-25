<?php
/*
 * Like Template
 *
 */

if ( ! $cite ) {
	return;
}
$author = wp_kses(
	Kind_View::get_hcard( ifset( $cite['author'] ) ),
	array(
		'a' => array(
			'href'  => array(),
			'class' => array(),
			'rel'   => array(),
		),
	)
);
$url    = ifset( $cite['url'], '' );
$embed  = Kind_View::get_embed( $url );
$verb   = Kind_Taxonomy::get_kind_info( get_post_kind_slug(), 'verb' );
if ( ! array_key_exists( 'name', $cite ) ) {
	$cite['name'] = Kind_View::get_post_type_string( $url );
}
?>

<section class="response post-kind post-kind-like h-cite u-like-of">
	<?php echo Kind_Taxonomy::get_before_kind( 'like' ); ?>
	<?php if ( ! $embed ) : ?>
		<?php if ( isset( $url ) ) : ?>
		<p class="lead"><?php echo esc_html( $verb ); ?> 
			<a href="<?php echo esc_url( $url ); ?>" class="u-url"><?php echo esc_html( $cite['name'] ); ?></a> 
			<?php if ( $author ) : ?>
			by 
				<?php
				echo wp_kses(
					$author,
					array(
						'a' => array(
							'href'  => array(),
							'class' => array(),
							'rel'   => array(),
						),
					)
				);
				?>
			<?php endif; ?>
		</p>
		<?php else : ?>
		<p class="lead"><?php echo esc_html( $verb ); ?> 
			<span class="p-name"><?php esc_html( $cite['name'] ); ?></span> by 
			<?php
			echo wp_kses(
				$author,
				array(
					'a' => array(
						'href'  => array(),
						'class' => array(),
						'rel'   => array(),
					),
				)
			);
			?>
		</p>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( ( array_key_exists( 'summary', $cite ) && '' !== trim( $cite['summary'] ) ) ) : ?>
	<blockquote class="e-content blockquote">
		<?php
		if ( array_key_exists( 'summary', $cite ) ) {
			echo wpautop( wptexturize( '"' . $cite['summary'] . '"' ) );
		}
		?>
		<?php if ( $author ) : ?>
		<footer class="blockquote-footer"><cite>
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
