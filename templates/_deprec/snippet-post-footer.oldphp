<footer class="post-footer">
  <?php if (is_singular('product') || (is_singular('calendar'))) { ?>
  <?php } else { ?>
    <?php /* Author Info */ ?>
    <div class="author-wrapper">
      <?php get_template_part('templates/author-info'); ?>
    </div>
  <?php } ?>

  <?php /* Tag Wrapper */ ?>
  <?php the_tags( '<div class="tags-wrapper"><p class="noMargin">Tags: ', ', ', '</p></div>' ); ?>

  <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>

  <?php /* Story Navigation */ ?>
  <div class="story-navigation">
    <?php $nextPost = get_next_post(); if($nextPost) { ?>
      <div class="nav-next col-xs-6">
        <?php $nextthumbnail = get_the_post_thumbnail($nextPost->ID, 'thumbnail'); ?>
        <?php next_post_link('%link',"$nextthumbnail &larr; <strong>PREV / </strong> %title"); ?>
      </div>
    <?php } ?>
    <?php $prevPost = get_previous_post(); if($prevPost) { ?>
      <div class="nav-previous col-xs-6 text-right pull-right">
        <?php $prevthumbnail = get_the_post_thumbnail($prevPost->ID, 'thumbnail' );?>
        <?php previous_post_link('%link',"$prevthumbnail %title <strong> / NEXT:</strong> &rarr;"); ?>
      </div>
    <?php } ?>
  </div>
</footer>