<?php
/**
 *	Article Quote
 *	Visualise image, title and subtitle.
 */
?>

<div class="item col-md-12 <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
	<div class="news-item">
	
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
							<?= the_excerpt () ?>
						</a>
					</blockquote>
				</div>
			</div>
		</header>

	</div>
</div>