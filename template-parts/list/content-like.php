<?php
$mf2_post = new MF2_Post( $post );
$kind     = $mf2_post->get( 'kind', true );
$info     = Kind_Taxonomy::get_kind_info( $kind, 'property' );
$cite     = $mf2_post->fetch( $info );
if ( ! $cite ) {
	return;
}
$author = Kind_View::get_hcard( ifset( $cite['author'] ) );
$url    = ifset( $cite['url'], '' );
?>
<article itemscope itemtype="http://schema.org/BlogPosting" itemid="<?php the_permalink(); ?>" <?php post_class( array( 'h-entry', 'hentry', ' u-like-of', 'u-summary' ) ); ?>>
	<p class="lead p-summary"><?php mrkapowski_post_type_icon(); ?> <?php echo esc_html( Kind_Taxonomy::get_kind_info( get_post_kind_slug(), 'verb' ) ); ?>
	<?php
	if ( ! array_key_exists( 'name', $cite ) ) {
		$cite['name'] = Kind_View::get_post_type_string( $url );
	}
	if ( isset( $url ) ) {
		echo sprintf( '<a href="%1s" class="p-name u-url">%2s</a>', $url, $cite['name'] );
	} else {
		echo sprintf( '<span class="p-name">%1s</span>', $cite['name'] );
	}
	if ( $author ) {
		echo ' ' . __( 'by', 'indieweb-post-kinds' ) . ' ' . $author;
	}
	if ( array_key_exists( 'publication', $cite ) ) {
		echo sprintf( ' <em>(<span class="p-publication">%1s</span>)</em>', $cite['publication'] );
	}
	?>
	</p>
	<section class="text-right">
		<small class="text-muted">
			<time class="dt-published" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
				<a href="<?php the_permalink(); ?>" class="u-url u-uid" itemprop="mainEntityOfPage" rel="permalink">
					<span itemprop="headline" class="entry-title">
						<?php mrkapowski_post_type(); ?> at <?php the_time( 'g:i a' ); ?>, <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
					</span>
				</a>
			</time>
		</small>
		<meta class="dt-modified" itemprop="dateModified" content="<?php the_modified_date( 'c' ); ?>">
		<span class="author-details invisible"> by 
			<span itemprop="author" itemtype="http://schema.org/Person">
				<small class="<?php echo esc_attr( ( is_single() ) ? 'p-author h-card' : 'u-author' ); ?>" itemprop="name">
					<a href="<?php echo esc_attr( get_the_author_meta( 'user_url' ) ); ?>" rel="author" class="u-url"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a>
					<meta class="u-photo avatar" content="<?php echo esc_attr( get_theme_file_uri( '/assets/img/author.jpg' ) ); ?>">
				</small>
				<meta class="u-url url" content="<?php echo esc_attr( get_the_author_meta( 'user_url' ) ); ?>">
			</span>
		</span>
		<meta itemprop="image" content="<?php echo esc_attr( get_theme_file_uri( 'assets/img/kapow_magenta.png' ) ); ?>">
		<div itemprop="publisher" itemscope itemtype="http://schema.org/Organization">
			<meta itemprop="url" content="<?php bloginfo( 'url' ); ?>">
			<meta itemprop="name" content="<?php bloginfo( 'name' ); ?>">
			<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
				<meta itemprop="url" content="<?php echo esc_attr( get_theme_file_uri( 'assets/img/kapow_magenta.png' ) ); ?>">
				<meta itemprop="height" content="295px">
				<meta itemprop="width" content="300px">
			</div>
		</div>
	</section>
</article>
<?php
//end output
