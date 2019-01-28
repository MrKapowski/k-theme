<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<article itemscope itemtype="http://schema.org/BlogPosting" itemid="<?php the_permalink(); ?>" <?php post_class( array( 'h-entry', 'hentry' ) ); ?>>
						<header>
							<h2 class="h1 p-name entry-title" itemprop="headline">
								<a href="<?php the_permalink(); ?>" rel="permalink" class="u-url u-uid" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2>
							<div class="metabox">
								<small>
									First published: 
									<time class="dt-published" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
										<a href="<?php the_permalink(); ?>" class="u-url u-uid" itemprop="mainEntityOfPage" rel="permalink">
										<?php the_time( 'g:i a' ); ?>, <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?> 
										</a>
									</time>
									Last modified: 
									<time class="dt-modified" itemprop="dateModified" datetime="<?php the_modified_date( 'c' ); ?>">
										<?php the_modified_date( 'F j, Y' ); ?>
									</time>
								</small>
								<?php get_template_part( 'template-parts/posts/author-details' ); ?>
								<?php get_template_part( 'template-parts/posts/publisher-details' ); ?>
							</div>
							<hr class="grad">
						</header>
						<div itemprop="articleBody" class="e-content">
							<?php the_content(); ?>
						</div>
						<hr>
					</article>
						<?php if ( is_single() ) : ?>
							<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' !== get_comments_number() ) {
								comments_template( '', true );
							}
							?>
						<?php endif; ?>

						<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
<?php get_footer(); ?>
