<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'page'); ?>

  <?php
    $args = array(
      'taxonomy' => array( 'post_tag', 'category', 'magazine', 'post_format' ),
      'number' => '120',
      'format' => 'list',
      'smallest' => '15',
      'largest' => '28'
    );

    wp_tag_cloud( $args );
  ?>
<?php endwhile; ?>