<?php global $issue_number;
/**
 *	Article Item
 *	Visualise image, title, subtitle and excerpt.
 */

// Variables
$thumb = has_post_thumbnail ()? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ): null;
?>

<a href="<?=the_permalink()?>" rel="bookmark" title="<?=the_title_attribute()?>">
<article class="col-md-12">
	<div class="post-image" style="background-image:url(<?=$thumb['0']?>);">
		
		<div class="content">
			<h1>
				<?=the_title()?> <span class="description">#<?=$issue_number?></span>
			</h1>
			<h3>
				<?=the_field('sub-title')?>
			</h3>
			
			<?=the_excerpt()?>
		</div>
		
	</div>
</article>
</a>