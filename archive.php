<?php

	/* Process tag page in separate page */
	if (is_tag ())
	
		include 'archive-tags.php';
	
	//else {

	/**
	 *	Issue filtering.
	 *
	 *	If issue string parameter is provided,
	 *	show only connected posts or calendars.
	 */
	$main_query = [
		'post_type' => [],
		'orderby' => 'post_date',
		'order' => 'DESC',
    'paged' => $paged,
	];

	if (is_post_type_archive ([ 'product' ]))
	{
		$pass = false;
		$main_query ['post_type'][] = 'product';
	}

	/*if (is_post_type_archive([ 'calendar' ]))
	{
		exit ('In cal');

		$pass = false;
		$main_query ['post_type'][] = 'calendar';
	}*/

	if ( isset( $_GET['issue'] ) )
		$main_query['tax_query'][] = [
			'taxonomy' => 'magazine',
			'field' => 'slug',
			'terms' => [$issue->slug]
		];


	if ( !isset( $pass ) )
	{
		//global $dynamics;
		$dynamics = new WP_Query($main_query);
	}
?>


<?php if (!isset ($success) && !have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_template_part('templates/search-form'); ?>
<?php endif; ?>

<?php 
/* if Productivity */
if (is_post_type_archive(array( 'product' ))) {

  // Could use a bit more DRY
  if (isset ($dynamics))
  { ?>

    <div class="row">
	  	<?php if (have_posts()) : ?>
	      <div data-columns="" id="columns">
	        <?php while ($dynamics->have_posts()) : $dynamics->the_post(); ?>
	          <?php get_template_part('templates/content-productivity', 'product'); ?>
	        <?php endwhile; ?>
	      </div>
		  <?php endif; ?>
    </div>

  <?php } else { ?>

    <div class="row">
  		<?php if (have_posts()) : ?>
        <div data-columns="" id="columns">
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/content-productivity', get_post_type() != 'product' ? get_post_type() : get_post_format()); ?>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>

  <?php } ?>

<?php }
/* If Magazine Taxonomy */
elseif (is_tax(array( 'magazine' ))) { ?>

  <div class="row">
    <?php if( !is_paged() ) { ?>
      <?php get_template_part('templates/snippet-magazine-description'); ?>
    <?php } ?>

    <div class="all-articles">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content-magazine', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
      <?php endwhile; ?>
    </div>
  </div>

<?php }
/* If Calendar */
elseif (is_post_type_archive(array( 'calendar' ))) {


	  // Could use a bit more DRY
 /* if (isset ($dynamics))
  {
	  exit ('In cal');
  ?>

    <div class="row">
	    <?php if (have_posts()) : ?>
	      <div data-columns="" id="columns-calendar">
	        <?php while ($dynamics->have_posts()) : $dynamics->the_post(); ?>
	          <?php get_template_part('templates/content-calendar', get_post_type() != 'calendar' ? get_post_type() : get_post_format()); ?>
	        <?php endwhile; ?>
	      </div>
	    <?php endif; ?>
    </div>

  <?php } else { ?>

    <div class="row">
	    <?php if (have_posts()) : ?>
	      <div data-columns="" id="columns-calendar">
	        <?php while (have_posts()) : the_post(); ?>
	          <?php get_template_part('templates/content-calendar', get_post_type() != 'calendar' ? get_post_type() : get_post_format()); ?>
	        <?php endwhile; ?>
	      </div>
	    <?php endif; ?>
    </div>

  <?php } */ ?>



    <div class="row">
  		<?php if (have_posts()) : ?>
        <div data-columns="" id="columns-calendar">
          <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('templates/content-calendar', get_post_type() != 'calendar' ? get_post_type() : get_post_format()); ?>
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
    </div>

<?php }
/* If Events */
elseif (is_post_type_archive(array( 'events' ))) { ?>

  <?php if (have_posts()) : ?>
    <div class="border-wrapper">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content-events'); ?>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>

<?php }

/* If projects */
elseif (is_post_type_archive(array( 'projects' ))) { ?>

  <?php if ( have_posts() ) {  ?>
    <div class="border-wrapper projects-wrapper">
      <?php while (have_posts()) {
        the_post(); ?>
        <?php get_template_part('templates/content-projects'); ?>
      <?php } ?>
    </div>
  <?php } ?>

<?php }

/* If Author Archive */
elseif (is_author()) { ?>

  <div class="row">
    <div class="col-xs-12">
      <div class="author-page-info marginBottom2em">
        <?php /* Author Info */ ?>
        <div class="author-wrapper">
          <?php get_template_part('templates/author-info'); ?>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content-archive'); ?>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>

<?php }
/* Else if all others */
else { ?>

  <div class="row">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content-archive', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
    <?php endwhile; ?>
  </div>

<?php } ?>


<?php get_template_part('templates/page-navi'); ?>

<?php /* End non-tag archive  } */ ?>