<?php use Roots\Sage\Extras; ?>

<div class="item <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>" id="post-<?php the_ID(); ?>">
  <div class="news-item row no-gutters">

    <div class="col-sm-6 event-image">
      <?php /* REUSED snippet to display post image */ ?>
      <?php get_template_part('templates/snippet', 'post-image'); ?>
    </div>

    <div class="col-sm-6 positionRelative event-details">
      <?php /* add same placeholder image on right side so columns have even height for absolutely positioned 'feed-header' items to display properly */ ?>
      <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-news-sm-tall.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />

      <?php /* REUSED snippet to display title, category, subtitle */ ?>
      <?php get_template_part('templates/snippet', 'feed-header'); ?>
    </div>

  </div>
</div>