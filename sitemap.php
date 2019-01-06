<?php
/**
 * /* Template Name: Sitemap
 * The template for displaying Sitemap pages.
 */
?>
<?php get_header(); ?>
				<h2>A Brief Listing of Everything on <?php bloginfo( 'name' ); ?></h2>
				<?php
				// the query
				$header        = '';
				$last_header   = '';
				$wpb_all_query = new WP_Query(
					array(
						'post_type'      => 'post',
						'post_status'    => 'publish',
						'posts_per_page' => -1,
					)
				);
				?>
				<?php if ( $wpb_all_query->have_posts() ) : ?>
					<!-- the loop -->
					<?php $prev_month = ''; ?>
					<?php while ( $wpb_all_query->have_posts() ) : ?>
						<?php $wpb_all_query->the_post(); ?>
						<?php $curr_month = get_the_date( 'F Y' ); ?>
						<?php if ( $curr_month !== $prev_month ) : ?>
							<?php if ( '' !== $prev_month ) : ?>
						</ul>
							<?php endif; ?>
					<h3><?php the_date( 'F Y' ); ?></h3>
					<ul class="list-unstyled sitemap">
						<?php endif; ?>
						<li><a href="<?php the_permalink(); ?>">
						<?php echo mrkapowski_post_type_icon(); /* phpcs:ignore */ ?>
						<?php if ( ! get_the_title() ) : ?>
							<?php echo mrkapowski_post_type_icon(); /* phpcs:ignore */ ?> at <?php the_time( 'g:i a' ); ?>
						<?php else : ?>
							<?php the_title(); ?>
						<?php endif; ?></a>  | <small content="<?php the_date_xml(); ?>"><a href="<?php the_permalink(); ?>" rel="permalink" class="text-muted"><?php echo get_the_date( 'F j, Y' ); ?></a></small></li>
						<?php $prev_month = $curr_month; ?>
					<?php endwhile; ?>
					</ul>
					<!-- end of the loop -->
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
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
