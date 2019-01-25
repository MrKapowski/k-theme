<article itemscope itemtype="http://schema.org/BlogPosting" itemid="<?php the_permalink(); ?>" <?php post_class( array( 'h-entry', 'hentry' ) ); ?>>
<?php if ( ! is_single() ) : ?>
<hr class="text-center w-50">
<?php endif; ?>
						<?php get_template_part( 'template-parts/posts/post-header', get_post_format() ); ?>
						<?php
						if ( has_post_kind() ) {
							set_query_var( 'cite', mrkapowski_post_kind_metadata( $post ) );
							get_template_part( 'kind_views/kind', get_post_kind_slug() );
						}
						?>
						<div itemprop="articleBody" class="e-content">
							<?php the_content(); ?>
						</div>
						<?php if ( '' !== $post->post_content ) : ?>
						<hr class="text-center w-50">
						<?php endif; ?>
						<!-- <hr> -->
					</article>

