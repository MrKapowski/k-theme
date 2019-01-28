<?php get_header(); ?>
				<?php if ( have_posts() ) : ?>
				<header class="archive-header d-flex justify-content-center">
					<?php mrkapowski_archive_title(); ?>
				</header><!-- .page-header -->
					<?php while ( have_posts() ) : ?>
						<?php
						the_post();

						/* Include the Post-Format-specific template for the content.
						* If you want to override this in a child theme then include a file
						* called content-___.php (where ___ is the Post Format name) and that will be used instead.
						*/
						get_template_part( 'template-parts/list/content', ( get_post_kind_slug() ) ? get_post_kind_slug() : get_post_format() );
						?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'template-parts/list/content', 'none' ); ?>
				<?php endif; ?>
					<footer>
						<nav class="">
							<?php mrkapowski_the_posts_navigation(); ?>
						</nav>
						<?php if ( is_home() ) : ?>
						<nav class="post footer">
							<ul class="nav justify-content-center nav-fill">
								<li class="nav-item next">
									&nbsp;
								</li>
								<li class="nav-item prev">
									<a href="/sitemap" title="Older posts can be found in the Archive" class="nav-link">Older posts can be found in the Archive <svg class="icon-arrow-right"><use xlink:href="<?php echo esc_attr( get_theme_file_uri( 'assets/img/solid.svg#arrow-right' ) ); ?>"></use></svg></a>
								</li>
							</ul>
							<hr>
						</nav>
						<?php endif; ?>
					</footer>
<?php get_footer(); ?>
