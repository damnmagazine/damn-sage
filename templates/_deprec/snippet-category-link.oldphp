<?php /* if video post format, setup css to just show DAMN + link (so if in DAMN +, there is a visual indicator) */ if ( has_post_format( 'video' )) { ?>
  <div class="category-link has-format-video">
<?php } else { ?>
  <div class="category-link">
<?php } ?>
  <?php
    $sep = '';
    foreach ((get_the_category()) as $cat) {
        echo $sep . '<a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="View all posts in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a>';
        $sep = '';
    }
  ?>
</div>