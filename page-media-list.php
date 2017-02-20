<?php
/*
Template Name: Media list
*/
?>

<?php
$paged = get_query_var('paged') ? get_query_var('paged') : 1; //The magic, ternary if statement
$args  = array(
    'posts_per_page' => 15,
    'post_type' => array('post', 'advertorials'),
    'tax_query' => array(
        array(
          'taxonomy' => 'post_format',
          'field' => 'slug',
          'terms' => array( 'post-format-gallery', 'post-format-video' ),
        )
      ),
    'paged' => $paged
);
query_posts($args);
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
  <?php get_template_part('templates/content-archive'); ?>
<?php endwhile; ?>
  <?php get_template_part('templates/page-navi'); ?>
<?php endif; ?>
