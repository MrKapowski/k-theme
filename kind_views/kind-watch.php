<?php
/*
  Watch Template
 *
 */

if ( ! $cite ) {
	return;
}
$author    = Kind_View::get_hcard( ifset( $cite['author'] ) );
$url       = ifset( $cite['url'] );
$site_name = Kind_View::get_site_name( $cite, $url );
$name      = Kind_View::get_cite_title( $cite, $url );
$embed     = $GLOBALS['wp_embed']->autoembed( $url );
$duration  = $mf2_post->get( 'duration', true );
if ( ! $duration ) {
		$duration = calculate_duration( $mf2_post->get( 'dt-start' ), $mf2_post->get( 'dt-end' ) );
}


?>

<section class="response u-watch-of h-cite card">
<header class="card-header">
<?php
echo Kind_Taxonomy::get_before_kind( 'watch' );
if ( $name ) {
	echo $name;
}
if ( $author ) {
	echo ' ' . __( 'by', 'indieweb-post-kinds' ) . ' ' . $author;
}
if ( $site_name ) {
	echo __( ', on ', 'indieweb-post-kinds' ) . $site_name;
}
if ( $duration ) {
	echo '(<data class="p-duration" value="' . $duration . '">' . Kind_View::display_duration( $duration ) . '</data>)';
}
?>
</header>
<main class="card-body">
<?php
if ( $cite ) {
	if ( $embed && ( $url !== $embed ) ) {
		printf( '<div class="embed-responsive embed-responsive-16by9 e-summary">%1s</div>', $embed );
	}
	if ( array_key_exists( 'summary', $cite ) ) {
		echo sprintf( '<blockquote class="e-summary">%1s</blockquote>', $cite['summary'] );
	}
}

// Close Response
?>
</main>
</section>

<?php
