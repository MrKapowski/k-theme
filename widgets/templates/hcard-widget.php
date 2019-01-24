<div class="card">
						<div class="h-card hcard vcard p-author" itemprop="author" itemtype="http://schema.org/Person">
							<?php
							echo wp_kses(
								$avatar,
								array(
									'img' => array(
										'src'    => array(),
										'alt'    => array(),
										'srcset' => array(),
										'class'  => array(),
									),
								)
							);
							?>
							<div class="card-body">
								<h5 class="p-name card-title n" itemprop="name">
									<a itemprop="url" href="<?php echo esc_attr( $url ); ?>" rel="me author" class="u-url url fn u-uid h5">
										<?php echo esc_attr( $name ); ?>
									</a>
								</h5>
								<?php if ( $user->has_prop( 'description' ) ) : ?>
								<div class="u-note note">
										<?php
											echo wp_kses(
												wpautop( wptexturize( $user->get( 'description' ) ) ),
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
								<?php if ( has_nav_menu( 'social' ) ) : ?>
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
								<a class="card-link text-muted" href="<?php echo esc_attr( get_feed_link( 'json' ) ); ?>" rel="alternative" type="application/json" title="Subscribe using JSONfeed">
									<svg class="icon-rss icon-lg"><use xlink:href="<?php echo esc_attr( get_theme_file_uri( '/assets/img/solid.svg#rss' ) ); ?>"></use></svg>
								</a>
							</div>
						</div>
					</div>
<?php
