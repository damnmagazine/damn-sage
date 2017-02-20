<?php $orig_post = $post;
function damn_get_related_posts( $post_id, $related_count, $args = array() ) {
  $args = wp_parse_args( (array) $args, array(
    'orderby' => 'rand',
    'return'  => 'query',
  ));

  $related_args = array(
    'post_type'      => array('post','product','calendar'),
    'posts_per_page' => $related_count,
    'post_status'    => 'publish',
    'post__not_in'   => array( $post_id ),
    'orderby'        => $args['orderby'],
    'tax_query'      => array()
  );

  $post = get_post( $post_id );
  $taxonomies = get_object_taxonomies( $post, 'names' );

  foreach( $taxonomies as $taxonomy ) {
    $terms = get_the_terms( $post_id, $taxonomy );
    if ( empty( $terms ) ) continue;
    $term_list = wp_list_pluck( $terms, 'slug' );
    $related_args['tax_query'][] = array(
        'taxonomy' => $taxonomy,
        'field'    => 'slug',
        'terms'    => $term_list
    );
  }

  if( count( $related_args['tax_query'] ) > 1 ) {
    $related_args['tax_query']['relation'] = 'OR';
  }

  if( $args['return'] == 'query' ) {
    return new WP_Query( $related_args );
  } else {
    return $related_args;
  }
}

$related = damn_get_related_posts( get_the_ID(), 3 );

if( $related->have_posts() ):
  ?>
  <div class="related-posts clearfix">
    <h3>Related posts</h3>
    <div class="row no-gutters related-post-list marginTop">
      <?php while( $related->have_posts() ): $related->the_post(); ?>
        <?php get_template_part('templates/content-archive', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
      <?php endwhile; ?>
    </div>
  </div>
  <?php
endif;
wp_reset_postdata();
?>