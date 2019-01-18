<header>
							<?php if ( ! empty( $post->post_title ) ) : ?>
<h2 class="<?php mrkapowski_header_class(); ?> p-name entry-title" itemprop="headline">
								<?php mrkapowski_post_type_icon(); ?> <a href="<?php the_permalink(); ?>" rel="permalink" class="u-url u-uid" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
							</h2>
							<section class="metabox">
								<small>
									<time class="dt-published" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
										<a href="<?php the_permalink(); ?>" class="u-url u-uid" itemprop="mainEntityOfPage" rel="permalink">
										<?php the_time( 'g:i a' ); ?>, <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?> 
										</a>
									</time>
								</small>
								<meta class="dt-modified" itemprop="dateModified" content="<?php the_modified_date( 'c' ); ?>">
								<?php else : ?>
							<section class="metabox">
								<small class="h5">
									<?php mrkapowski_post_type_icon(); ?> <time class="dt-published" itemprop="datePublished" datetime="<?php echo esc_attr( get_the_time( 'c' ) ); ?>">
										<a href="<?php the_permalink(); ?>" class="u-url u-uid" itemprop="mainEntityOfPage" rel="permalink">
											<span itemprop="headline" class="entry-title">
											<?php mrkapowski_post_type(); ?> at <?php the_time( 'g:i a' ); ?>, <?php echo esc_html( get_the_date( 'F j, Y' ) ); ?>
											</span>
										</a>
									</time>
								</small>
								<meta class="dt-modified" itemprop="dateModified" content="<?php the_modified_date( 'c' ); ?>">
								<?php endif; ?>
								<span class="author-details invisible"> by 
									<span itemprop="author" itemtype="http://schema.org/Person">
										<small class="p-author h-card" itemprop="name">
											<a href="<?php echo esc_attr( get_the_author_meta( 'user_url' ) ); ?>" class="u-url"><?php echo esc_html( get_the_author_meta( 'display_name' ) ); ?></a>
											<meta class="u-photo avatar" content="<?php echo esc_attr( get_theme_file_uri( '/assets/img/author.jpg' ) ); ?>">
										</small>
										<meta class="u-url url" content="<?php echo esc_attr( get_the_author_meta( 'user_url' ) ); ?>">
									</span>
								</span>
								<?php
								if ( is_single() ) {
									mrkapowski_the_tags();
								}
								?>
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
						</header>
