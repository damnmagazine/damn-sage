<?php use Roots\Sage\Extras; ?>
<div class="item col-xs-12 col-sm-6 col-md-4 col-lg-4 <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>" id="post-<?php the_ID(); ?>">
	<div class="news-item">

		<?php if ( has_post_format( 'quote' )) { ?>

			<div class="post-image">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
					<img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
				</a>
			</div>

			<header class="quote-format">
				<div class="quote-wrapper-outer">
					<div class="quote-wrapper-inner">
						<blockquote>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
							<p>
								<?= Extras\get_excerpt(140); ?>
							</p>
						</a>
						</blockquote>
					</div>
				</div>
			</header>

		<?php } else { ?>

			<?php /* REUSED snippet to display post image */ ?>
			<?php get_template_part('templates/snippet', 'post-image'); ?>

			<?php /* REUSED snippet to display title, category, subtitle */ ?>
			
			<?php 

				if( is_search() ){ ?>

					<header style="position: absolute !important;" >
						<div class="header-wrapper">
							<?php get_template_part('templates/snippet', 'category-link'); ?>

							<?php /* if video or gallery post format, show just title here */ if ( has_post_format( 'video' ) || has_post_format( 'gallery' )) { ?>

								<h2 class="entry-title">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php the_title(); ?>
									</a>
								</h2>

							<?php } /* else all others types of posts, with variours items left out below, per definition */ else { ?>

								<h2 class="entry-title">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
										<?php if ( has_post_format( 'video' )) { ?>
											<i class="fa fa-play-circle-o play-video-icon"></i>
										<?php } ?>
										<?php the_title(); ?>
									</a>
								</h2>

								<?php   /* dont show on single pages, this would be for the "related posts" area */ ?>
								<?php if (is_single()) { ?>

									<!-- show nothing if is_single -->

								<?php } elseif (is_tax( 'magazine' )) {?>

									<!-- except mag tax page, show subtitle ony-->

									<?php if(get_field('sub-title')) { ?>
										<h3 class="subtitle">
											<?php the_field('sub-title'); ?>
										</h3>
									<?php } ?>

								<?php } else { ?>

									<!-- else all other, show subtitle/excerpt -->

									<?php /* the sub-title */ ?>

									<?php if(get_field('sub-title')) { ?>
										<h3 class="subtitle">
											<?php the_field('sub-title'); ?>
										</h3>

									<?php } else { ?>

									<?php /* or if no sub-title, use the excerpt */ ?>

										<h3 class="subtitle">
											<a href="<?php the_permalink(); ?>" >
												<?php 
													$excerpt = get_the_excerpt(); 
													
													echo strlen ($excerpt) < 8*30? $excerpt: substr ($excerpt, 0, 8*30) . " ...";
												?>
											</a>
										</h3>
									<?php } ?>

								<?php } ?>

								<?php /* if calendar post type, show start/end date */ ?>
								<?php get_template_part('templates/snippet', 'start-end-date'); ?>

							<?php } ?>

						</div>

					</header>

			<?php	} else {

					get_template_part('templates/snippet', 'feed-header'); 

				}
		} 
		?>
	</div>
</div>