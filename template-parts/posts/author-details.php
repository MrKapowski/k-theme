<span class="author-details invisible"> by 
	<span itemprop="author" itemtype="http://schema.org/Person">
		<span class="<?php echo esc_attr( ( is_single() ) ? 'p-author h-card' : 'u-author' ); ?>" itemprop="name">
			<a href="<?php echo esc_attr( get_the_author_meta( 'user_url' ) ); ?>" rel="author" class="u-url url"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a>
			<?php if ( is_single() ) : ?>
			<link class="u-photo" href="<?php echo esc_attr( get_theme_file_uri( '/assets/img/author.jpg' ) ); ?>">
			<meta class="avatar" content="<?php echo esc_attr( get_theme_file_uri( '/assets/img/author.jpg' ) ); ?>">
			<?php endif; ?>
		</span>
	</span>
</span>
