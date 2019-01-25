<?php
/*
 * Photo Template
 *
 */
$mf2_post = new MF2_Post( $post );
$photos = $mf2_post->get_images();
$embed  = null;
if ( ! $photos && is_array( $cite ) ) {
	$url   = ifset( $cite['url'] );
	$embed = Kind_View::get_embed( $url );
	if ( ! $embed ) {
		$embed = kind_photo_gallery( $url );
	}
}
?>
<section class="photo">
<header>
<?php
echo Kind_Taxonomy::get_before_kind( 'photo' );
?>
</header>
</section>
<?php
if ( $embed ) {
	printf( '<blockquote class="e-summary">%1s</blockquote>', $embed );
} elseif ( $photos ) {
	echo kind_photo_gallery( $photos );
}
