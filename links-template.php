<?php
/**
 * /* Template Name: Links Page
 * The template for displaying Link directory pages.
 */
?>
<?php get_header(); ?>
<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<article itemscope itemtype="http://schema.org/BlogPosting" itemid="<?php the_permalink(); ?>" <?php post_class( array( 'h-entry', 'hentry' ) ); ?>>
						<header>
							<?php if ( ( ! empty( $post->post_title ) ) && ( ! ( ( has_post_format( 'aside' ) || has_post_kind( 'note' ) ) && is_home() ) ) ) : ?>
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
								<?php else : ?>
								<small>
									<time class="dt-published" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
										<a href="<?php the_permalink(); ?>" class="u-url u-uid" itemprop="mainEntityOfPage" rel="permalink">
											<span itemprop="headline" class="entry-title">
											<?php mrkapowski_post_type_icon(); ?> <?php mrkapowski_post_type(); ?> at <?php the_time( 'g:i a' ); ?>, <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
											</span>
										</a>
									</time>
								</small>
								<meta class="dt-modified" itemprop="dateModified" content="<?php the_modified_date( 'c' ); ?>">
								<?php endif; ?>
								<span itemprop="author" itemtype="http://schema.org/Person">
									<small class="p-author h-card" itemprop="name">
										<a href="<?php echo esc_attr( get_the_author_meta( 'user_url' ) ); ?>" class="u-url"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a>
										<meta class="u-photo avatar" content="<?php echo esc_attr( get_theme_file_uri( '/assets/img/author.jpg' ) ); ?>">
									</small>
									<meta class="u-url url" content="<?php echo esc_attr( get_the_author_meta( 'user_url' ) ); ?>">
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
							</div>
							<hr class="grad">
						</header>
						<div itemprop="articleBody" class="e-content">
							<?php the_content(); ?>
							<ul class="list-unstyled">
							<?php
							wp_list_bookmarks(
								array(
									'title_before' => '<h3>',
									'title_after'  => '</h3>',
								)
							);
							?>
							</ul>
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
					<footer>
						<nav class="post footer">
							<ul class="nav justify-content-center nav-fill">
								<li class="nav-item next">
									&nbsp;
								</li>
								<li class="nav-item prev">
									&nbsp;
								</li>
							</ul>
							<hr>
						</nav>
					</footer>
<?php get_footer(); ?>
