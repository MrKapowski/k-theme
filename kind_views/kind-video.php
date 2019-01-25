<?php
/*
 * Video Template
 *
 */
$mf2_post = new MF2_Post( $post );
$videos      = $mf2_post->get_videos();
if ( is_array( $videos ) ) {
	foreach ( $videos as $video ) {
		$video_attachment = new MF2_Post( $video );
		$cite             = $video_attachment->get();
	}
}
$photos      = $mf2_post->get_images();
$first_photo = null;
if ( is_array( $photos ) ) {
	$first_photo = array_pop( array_reverse( $photos ) );
}
$embed = null;
if ( is_array( $cite ) && ! $videos ) {
	$url       = ifset( $cite['url'] );
	$name      = Kind_View::get_cite_title( $cite );
	$author    = Kind_View::get_hcard( $cite['author'] );
	$site_name = Kind_View::get_site_name( $cite );
	$embed     = $GLOBALS['wp_embed']->autoembed( $url );
	if ( ! $embed ) {
		$embed = kind_video_gallery( $url );
	}
}


?>
<section class="response u-watch-of h-cite">
<header>
<?php
echo Kind_Taxonomy::get_before_kind( 'video' );
//if ( ! $embed ) {
	if ( $name ) {
		echo $name;
	}
	if ( $author ) {
		echo ' ' . __( 'by', 'indieweb-post-kinds' ) . ' ' . $author;
	}
	if ( $site_name ) {
		echo __( ' from ', 'indieweb-post-kinds' ) . '<em>' . $site_name . '</em>';
	}
	if ( $duration ) {
		echo '(<data class="p-duration" value="' . $duration . '">' . Kind_View::display_duration( $duration ) . '</data>)';
	}
//}
?>
</header>
<?php
if ( $embed ) {
	printf( '<div class="embed-responsive embed-responsive-16by9 e-summary">%1s</div>', $embed );
} elseif ( $videos ) {

	$poster = wp_get_attachment_image_url( $first_photo, 'full' );
	echo kind_video_gallery( $videos, array( 'poster' => $poster ) );
}
?>
<?php
if ( $cite ) {
	if ( array_key_exists( 'summary', $cite ) ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', wpautop( $cite['summary'] ) );
	}
}

// Close Response
?>
</section>
<?php
