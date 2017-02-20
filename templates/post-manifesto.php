<?php
/**
 *	Calendar item
 *	Visualise image, date(s) and title.
 */
global $issue_number;

// Variables
$thumb = has_post_thumbnail ()? wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' ): null;
?>

<article class="item-manifesto col-md-12" id="manifesto">
	<a href="<?=the_permalink()?>" rel="bookmark" title="<?=the_title_attribute()?>">
	
	<?php if($thumb): ?>
			
		<div class="row">
			<div class="col-md-8">
			
				<h1>
					<span class="description caps-title">Manifesto /</span>
					<span class="grey-font"><?=the_title()?></span>
				</h1>
				<h3><?=the_field('sub-title')?></h3>
			
				<?=the_excerpt()?>
				
				<div class='previous'><a href="/category/manifesto">View All</a> <a href="/?issue=damn-<?=$issue_number-1?>#manifesto">/ Previous Manifesto</a></div>
				
			</div>
			<div class="col-md-4 post-image" style="background-image:url(<?=$thumb['0']?>);">
				<a class="home-img-link" href="<?=the_permalink()?>"></a>
			</div>
		</div>

	<?php else: ?>
		
		<h1>
			<span class="description">Manifesto /</span>
			<?=the_title()?>
		</h1>
		<h3><?=the_field('sub-title')?></h3>
	
		<?=the_excerpt()?>

	<?php endif; ?>

	</a>
	
	
	
</article>

