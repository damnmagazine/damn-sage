<?php
/**
 *	Article Item
 *	Visualise image, title and subtitle.
 */

// Variables
$thumb = has_post_thumbnail ()? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ): null;
?>



<div class="item col-md-12 <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
	<div class="news-item">
		
		<div class="post-image" style="background-image:url(<?=$thumb[0]?>);">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
			</a>
		</div>
	
		<?php 
		/* if video post format, center a big play icon */ 
		if ( has_post_format( 'video' )): ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="centerer">
				<i class="fa fa-play-circle-o play-video-icon fa-4x whitecolor"></i>
			</a>
			
		<?php elseif(has_post_format('gallery')): ?>
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="centerer">
				<i class="fa fa-camera fa-3x whitecolor"></i>
			</a>
			
		<?php endif; ?>
		
		<header>

			<h2 class="entry-title">
				<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
				<?php the_title(); ?>
				</a>
			</h2>
			
		<?php 
		/* if video or gallery post format, show just title */ 
		if ( !has_post_format( 'video' ) && !has_post_format( 'gallery' )): ?>
		
			<h3 class="subtitle">
				<?php the_field('sub-title'); ?>
			</h3>
			
		<?php endif; ?>
		
		</header>
	</div>
</div>