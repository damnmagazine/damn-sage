<?php if(!is_single() && !is_front_page() && !is_author()): ?>
	<div class="title-wrapper">

	<?php if(is_archive()): ?>
	
		<h1 class="archive-title">
			<?php the_archive_title(); ?>
		</h1>
		<?php the_archive_description( '<div class="taxonomy-description">', '</div>' ); ?>

	<?php elseif(is_page()): ?>
	
		<h1 class="page-title" itemprop="headline">
		<?php the_title(); ?>
		</h1>
		
	<?php elseif(is_search()): ?>
		
		<?php get_template_part('templates/page', 'header'); ?>
	
	<?php endif; ?>
	</div>
<?php endif; ?>