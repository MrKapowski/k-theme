<span class="text-muted"> at
	<?php if ( ( array_key_exists( 'summary', $cite ) && '' !== trim( $cite['summary'] ) ) || ! empty( get_the_content() ) ) : ?>
	<time class="dt-published" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
		<span itemprop="headline" class="entry-title">
			<?php the_time( 'g:i a' ); ?>, <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
		</span>
	</time>
	<a href="<?php the_permalink(); ?>" class="u-url u-uid" itemprop="mainEntityOfPage" rel="permalink">(more…)</a>
	<?php else : ?>
	<time class="dt-published" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
		<a href="<?php the_permalink(); ?>" class="u-url u-uid text-muted" itemprop="mainEntityOfPage" rel="permalink">
			<span itemprop="headline" class="entry-title">
				<?php the_time( 'g:i a' ); ?>, <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
			</span>
		</a>
	</time>
	<?php endif; ?>
</span>
<?php
