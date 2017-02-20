<span class="category-sep">
  <?php
    $sep = '';
    foreach ((get_the_category()) as $cat) {
        echo $sep . '<a href="' . get_category_link($cat->term_id) . '"  class="' . $cat->slug . '" title="View all posts in '. esc_attr($cat->name) . '">' . $cat->cat_name . '</a>';
        $sep = ', ';
    }
  ?>
</span>