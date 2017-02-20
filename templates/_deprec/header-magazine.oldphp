<?php

/**
 *	Selected Issue
 */
global $issue, $issue_color, $issue_number;

// Some dry data
$issue_acf_id = 'magazine_' . $issue->term_id;
$contrast = (int) get_field ('colour_scheme', $issue_acf_id);
$issue_link = get_term_link($issue->term_id, 'magazine');
$header_image = get_field ('header_image', $issue_acf_id);
$issue_cat = get_field ('primary_category', $issue_acf_id);
$header_highlight = get_field ('header_highlight', $issue_acf_id);
$header_subtitle = get_field ('header_subtitle', $issue_acf_id);

?>

<meta property="og:image" content="<?=$header_image?>" />


<?php if ($header_image): ?>
<div class="single-news-item">

	<?php /* advertorial, if present */ ?>

		<?php
			$custom_query = new WP_Query( array( 'post_type' => array( 'advertorial' ), 'posts_per_page' => 1));
			while($custom_query->have_posts()) : $custom_query->the_post();
			?>
				<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="advertorial-badge">
					<?php the_title(); ?>
					<?php if(get_field('sub-title')) { ?>
	          <h3 class="subtitle">
	            <?php the_field('sub-title'); ?>
	          </h3>
	        <?php } ?>
				</a>
			<?php endwhile; ?>
		<?php wp_reset_postdata(); // reset the query ?>

	<?php /* advertorial, end */ ?>

	<div class="post-image">
		<a href="<?=$issue_link?>" rel="bookmark" title="<?=$header_highlight?>">
			<img src="<?=$header_image?>" alt="<?=$issue->name?>" />
		</a>
	</div>

	<header>
		<div class="container">

			<?php if ($issue_cat): ?>
			<div class="category-link">
				<a href="<?=get_category_link($issue_cat->term_id)?>"  class="<?=$issue_cat->slug?>" title="View all posts in <?=$issue_cat->name?>"><?=$issue_cat->name?></a>
			</div>
			<?php endif; ?>

			<h1 class="entry-title">
				<a href="<?=$issue_link?>" rel="bookmark" title="<?=$header_highlight?>"><?=$header_highlight?></a>
			</h1>
			<h3 class="subtitle"><?=$header_subtitle?></h3>

		</div>
	</header>
</div>
<?php endif; ?>

<?php get_template_part('templates/snippet', 'header-nav'); ?>