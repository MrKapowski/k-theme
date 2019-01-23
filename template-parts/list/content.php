<article itemscope itemtype="http://schema.org/BlogPosting" itemid="<?php the_permalink(); ?>" <?php post_class( array( 'h-entry', 'hentry' ) ); ?>>
<?php if ( ! is_single() ) : ?>
<hr class="text-center w-50">
<?php endif; ?>
						<?php get_template_part( 'template-parts/posts/post-header', get_post_format() ); ?>
						<div itemprop="articleBody" class="e-content">
							<?php the_content(); ?>
						</div>
						<?php if ( '' !== $post->post_content ) : ?>
						<hr class="text-center w-50">
						<?php endif; ?>
						<!-- <hr> -->
					</article>
					<?php if ( is_single() ) : ?>
					<footer class="comments-area">
						<nav class="post footer">
							<ul class="nav flex-column flex-sm-row justify-content-center nav-fill">	
								<li class="nav-item next">
									<?php if ( get_next_post_link() ) : ?>
										<?php
										next_post_link(
											'%link',
											'<svg class="icon-arrow-left"><use xlink:href="' . get_theme_file_uri( 'assets/img/solid.svg#arrow-left' ) . '"></use></svg> Newer: %title'
										);
										?>
									<?php endif; ?>
								</li>

								<li class="nav-item prev">
									<?php if ( get_previous_post_link() ) : ?>
										<?php
										previous_post_link(
											'%link',
											'Older: %title <svg class="icon-arrow-right"><use xlink:href="' . get_theme_file_uri( 'assets/img/solid.svg#arrow-right' ) . '"></use></svg>'
										);
										?>
									<?php endif; ?>
								</li>

							</ul>
							<hr>
						</nav>
					</footer>
						<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' !== get_comments_number() ) {
							comments_template( '', true );
						}
						?>
					<?php endif; ?>
