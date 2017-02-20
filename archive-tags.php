<?php
	
	/* Expand tag results to multiple CPT's */
	
	$query = [
		'post_type'=> 'product',
		'tag'=> $wp_query->query['tag'] 
	];
	
	$dynamics = new WP_Query ($query);

?>

<?php /* if (!isset ($dynamics) || !$dynamics->have_posts()) :  ?>
  <div class="alert alert-warning">
    <?php _e('Sorries, no results were found.', 'sage'); ?>
  </div>
  <?php 
	  
	get_template_part('templates/search-form');
*/

/* Print out posts */
if ($dynamics->have_posts()) : 

	$success = true;

?>
	<style>
		.archive-tag-product header {
			background-color: rgba(0,0,0, .25);
		}
		.archive-tag-product header p {
			color: white;
		} 
	</style>
	
	<div class="row">
		<div data-columns="" id="columns" class="archive-tag-product">
	
	<?php
		while ($dynamics->have_posts()) {
			
			$dynamics->the_post();
			get_template_part('templates/content-productivity', 'product');
		}
	?>

		</div>
	</div>
	
	<hr>

<?php endif;
        
        
        /* Expand tag results to multiple CPT's */
        
        $query = [
                'post_type'=> 'advertorial',
                'tag'=> $wp_query->query['tag'] 
        ];
        
        $dynamics = new WP_Query ($query);


/* Print out posts */
if ($dynamics->have_posts()) : 

        $success = true;

?>
        <style>
                
        </style>
        
        <h2>Company News</h2>
        
        <div class="row">
    <?php while ($dynamics->have_posts()) : $dynamics->the_post(); ?>
      <?php get_template_part('templates/content-archive', get_post_format()); ?>
    <?php endwhile; ?>
        </div>
        
        <hr>

<?php endif;