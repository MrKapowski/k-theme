<?php get_header(); ?>
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php
						/* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'content', get_post_format() );
						?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
				<?php if ( is_home() ) : ?>
					<footer>
						<nav class="post footer">
							<ul class="nav justify-content-center nav-fill">
								<li class="nav-item next">
									&nbsp;
								</li>
								<li class="nav-item prev">
									<a href="/sitemap" title="Older posts can be found in the Archive" class="nav-link">Older posts can be found in the Archive <svg class="icon-arrow-right"><use xlink:href="<?php echo get_theme_file_uri('assets/img/icons.svg#icon-arrow-right'); ?>"></use></svg></a>
								</li>
							</ul>
							<hr>
						</nav>
					</footer>
				<?php endif; ?>
<?php get_footer(); ?>
