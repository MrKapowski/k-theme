<!-- Page Footer/Extra links -->
<?php
	$user_info = get_userdata( 1 );
?>
<footer id="meta" class="col-lg-3 col-6 flex-md-first order-last">
					<?php dynamic_sidebar( 'main-sidebar' ); ?>
					<?php /* TODO: this should be a custom widget */ ?>
					<div class="card">
						<div class="h-card vcard" itemprop="author" itemtype="http://schema.org/Person">
							<img src="<?php echo esc_attr( get_theme_file_uri( '/assets/img/author.jpg' ) ); ?>" alt="author image" class="mw-100 card-image-top u-photo">
							<div class="card-body">
								<h5 class="p-name card-title" itemprop="name">
									<a itemprop="url" href="<?php echo esc_attr( $user_info->url ); ?>" rel="me" class="u-url h5">
										<?php echo esc_attr( $user_info->display_name ); ?>
									</a>
								</h5>
								<?php if ( has_nav_menu( 'social' ) ) : ?>
									<?php if ( $user_info->description ) : ?>
								<div class="u-note">
										<?php
											echo wp_kses(
												wpautop( wptexturize( $user_info->description ) ),
												array(
													'a'    => array(
														'href'  => array(),
														'title' => array(),
														'rel'   => array(),
													),
													'span' => array(),
													'p'    => array(),
													'strong' => array(),
													'em'   => array(),
												)
											);
										?>
								</div>
								<?php endif; ?>
								<h6 class="card-subtitle mb-2 text-muted">Social Profiles:</h6>
								<div id="menu-social" class="d-flex justify-content-center social">
									<?php
									echo wp_kses(
										wp_nav_menu(
											array(
												'theme_location' => 'social',
												'container' => 'div',
												'container_id' => 'menu-social',
												'container_class' => 'menu d-flex justify-content-center',
												'menu_id' => 'menu-social-items',
												'menu_class' => 'menu-items',
												'depth'   => 1,
												'fallback_cb' => '',
												'items_wrap' => '%3$s',
												'echo'    => false,
												'link_before' => '<span class="screen-reader-text">',
												'link_after' => '</span>' . mrkapowski_get_svg( array( 'icon' => 'bookmark' ) ),
											)
										),
										array(
											'a'    => array(
												'href'  => array(),
												'title' => array(),
												'rel'   => array(),
											),
											'span' => array(
												'class' => array(),
											),
											'svg'  => array(
												'class' => array(),
											),
											'use'  => array(
												'xlink:href' => array(),
											),
										)
									);
									?>
								</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="card-footer justify-content-center">
							<div class="d-flex justify-content-center">
								<a class="card-link text-muted" href="<?php echo esc_attr( get_feed_link() ); ?>" rel="alternative" type="application/rss+xml" title="Subscribe using RSS">
									<svg class="icon-rss icon-lg"><use xlink:href="<?php echo esc_attr( get_theme_file_uri( '/assets/img/solid.svg#rss' ) ); ?>"></use></svg>
								</a>
							</div>
						</div>
					</div>
				</footer><!-- /End Page Footer/Extra links -->
