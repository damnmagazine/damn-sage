<?php


	/**
	 *	Issue filtering.
	 *
	 *	If issue string parameter is provided,
	 *	show only connected posts or calendars.

	$main_query = [
		'post_type' => [],
		'orderby' => 'post_date',
		'order' => 'DESC'
	];

	if (is_post_type_archive ([ 'product' ]))
	{
		$pass = false;
		$main_query ['post_type'][] = 'product';
	} */

	/*if (is_post_type_archive([ 'calendar' ]))
	{
		exit ('In cal');

		$pass = false;
		$main_query ['post_type'][] = 'calendar';
	}*/

	/*

	if ($_GET['issue'])
		$main_query['tax_query'][] = [
			'taxonomy' => 'magazine',
			'field' => 'slug',
			'terms' => [$issue->slug]
		];


	if (!$pass)
	{
		//global $dynamics;
		$dynamics = new WP_Query($main_query);
	}
	*/


?>

<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<div class="row">
  <?php
  /* if Productivity */
  if (is_post_type_archive(array( 'product' ))) {

	  // Could use a bit more DRY
	  if (isset ($dynamics))
	  { ?>

	  	 <?php if (have_posts()) : ?>
	      <div data-columns="" id="columns">
	        <?php while ($dynamics->have_posts()) : $dynamics->the_post(); ?>
	          <?php get_template_part('templates/content-productivity', 'product'); ?>
	        <?php endwhile; ?>
	      </div>
		  <?php endif; ?>

	  <?php } else { ?>

		 <?php if (have_posts()) : ?>
	      <div data-columns="" id="columns">
	        <?php while (have_posts()) : the_post(); ?>
	          <?php get_template_part('templates/content-productivity', get_post_type() != 'product' ? get_post_type() : get_post_format()); ?>
	        <?php endwhile; ?>
	      </div>
	    <?php endif; ?>


	  <?php } ?>

  <?php }
  /* If Magazine Taxonomy */
  elseif (is_tax(array( 'magazine' ))) { ?>

    <?php if( !is_paged() ) { ?>
      <?php get_template_part('templates/snippet-magazine-description'); ?>
    <?php } ?>

    <div class="all-articles">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content-magazine', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
      <?php endwhile; ?>
    </div>

  <?php }
  /* If Calendar */
  elseif (is_post_type_archive(array( 'calendar' ))) {

  	  // Could use a bit more DRY
	 /* if (isset ($dynamics))
	  {

		  exit ('In cal');


	  ?>

		    <?php if (have_posts()) : ?>
		      <div data-columns="" id="columns-calendar">
		        <?php while ($dynamics->have_posts()) : $dynamics->the_post(); ?>
		          <?php get_template_part('templates/content-calendar', get_post_type() != 'calendar' ? get_post_type() : get_post_format()); ?>
		        <?php endwhile; ?>
		      </div>
		    <?php endif; ?>

	  <?php } else { ?>

		    <?php if (have_posts()) : ?>
		      <div data-columns="" id="columns-calendar">
		        <?php while (have_posts()) : the_post(); ?>
		          <?php get_template_part('templates/content-calendar', get_post_type() != 'calendar' ? get_post_type() : get_post_format()); ?>
		        <?php endwhile; ?>
		      </div>
		    <?php endif; ?>


	  <?php } */ ?>


	  		<?php if (have_posts()) : ?>
		      <div data-columns="" id="columns-calendar">
		        <?php while (have_posts()) : the_post(); ?>
		          <?php get_template_part('templates/content-calendar', get_post_type() != 'calendar' ? get_post_type() : get_post_format()); ?>
		        <?php endwhile; ?>
		      </div>
		    <?php endif; ?>


  <?php }
  /* Else if all others */
  else { ?>

    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content-archive', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <?php endwhile; ?>

  <?php } ?>
</div>

<?php get_template_part('templates/page-navi'); ?>