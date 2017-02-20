<div class="item col-xs-12 col-sm-12 col-md-8 medium-post video-post <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
  <div class="news-item">

    <?php if ( has_post_format( 'quote' )) { ?>

      <div class="post-image">
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide-video.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder hidden-xs" />
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-video.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-xs-block" />
        </a>
      </div>

      <header class="quote-format">
        <div class="quote-wrapper-outer">
          <div class="quote-wrapper-inner">
            <blockquote>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <?php the_excerpt(); ?>
            </a>
            </blockquote>
          </div>
        </div>
      </header>

    <?php } else { ?>

      <?php if ( has_post_thumbnail()) { ?>
      <div class="post-image" style="background-image:url(<?=$url?>);">
      <?php } else { ?>
      <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
      <?php } ?>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder hidden-xs" />
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-video.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-xs-block" />
        </a>
      </div>

    <?php /* REUSED snippet to display title, category, subtitle */ ?>
    <?php get_template_part('templates/snippet', 'feed-header'); ?>
  <?php } ?>

  </div>
</div>