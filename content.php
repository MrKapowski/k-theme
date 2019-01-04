<article itemscope itemtype="http://schema.org/BlogPosting" itemid="<?php the_permalink(); ?>" <?php post_class( array( 'h-entry', 'hentry' ) ); ?>>
						<header>
							<?php if ( ( ! empty( $post->post_title ) ) && ( ! ( ( has_post_format( 'aside' ) || has_post_kind( 'note' ) ) && is_home() ) ) ) : ?>
							<h2 class="h1 p-name entry-title" itemprop="headline">
								<a href="<?php the_permalink(); ?>" rel="permalink" class="u-url u-uid" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2>
							<small>
								<time class="dt-published" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
									<a href="<?php the_permalink(); ?>" class="u-url u-uid" itemprop="mainEntityOfPage" rel="permalink">
										<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?> at <?php the_time( 'g:i a' ); ?>
									</a>
								</time>
							</small>
							<meta class="dt-modified" itemprop="dateModified" content="<?php the_modified_date( 'c' ); ?>">
							<?php else : ?>
							<small>
								<time class="dt-published" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
									<a href="<?php the_permalink(); ?>" class="u-url u-uid" itemprop="mainEntityOfPage" rel="permalink">
										<span itemprop="headline" class="entry-title">
											<?php echo esc_html( get_the_date( 'F j, Y' ) ); ?> at <?php the_time( 'g:i a' ); ?>
										</span>
									</a>
								</time>
							</small>
							<meta class="dt-modified" itemprop="dateModified" content="<?php the_modified_date( 'c' ); ?>">
							<?php endif; ?>
							<div itemprop="author" itemtype="http://schema.org/Person">
								<small class="p-author h-card" itemprop="name">
									<a href="<?php echo esc_attr( get_the_author_meta( 'user_url' ) ); ?>" class="u-url"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a>
									<meta class="u-photo avatar" content="<?php echo esc_attr( get_theme_file_uri( '/assets/img/author.jpg' ) ); ?>">
								</small>
								<meta class="u-url url" content="<?php echo esc_attr( get_the_author_meta( 'user_url' ) ); ?>">
							</div>
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
						</header>
						<div itemprop="articleBody" class="e-content">
							<?php the_content(); ?>
							<p><a href="<?php the_permalink(); ?>" rel="permalink" itemprop="mainEntityOfPage" class="u-url" >
								<svg class="icon-bookmark"><use xlink:href="<?php echo esc_attr( get_theme_file_uri( 'assets/img/icons.svg#icon-bookmark' ) ); ?>"></use></svg>
							</a></p>
						</div>
						<hr>
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
											'<svg class="icon-arrow-left"><use xlink:href="' . get_theme_file_uri( 'assets/img/icons.svg#icon-arrow-left' ) . '"></use></svg> Newer: %title'
										);
										?>
									<?php endif; ?>
								</li>

								<li class="nav-item prev">
									<?php if ( get_previous_post_link() ) : ?>
										<?php
										previous_post_link(
											'%link',
											'Older: %title <svg class="icon-arrow-right"><use xlink:href="' . get_theme_file_uri( 'assets/img/icons.svg#icon-arrow-right' ) . '"></use></svg>'
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
