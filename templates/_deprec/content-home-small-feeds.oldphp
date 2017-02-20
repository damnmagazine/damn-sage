<?php use Roots\Sage\Extras; ?>

<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="item <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
  <div class="news-item">

    <?php if ( has_post_format( 'quote' )) { ?>

      <div class="post-image">
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
        </a>
      </div>

      <header class="quote-format">
        <div class="quote-wrapper-outer">
          <div class="quote-wrapper-inner">
            <blockquote>
            <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
              <p>
                <?= Extras\get_excerpt(140); ?>
              </p>
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
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
        </a>
      </div>

      <?php /* if video post format, center a big play icon */ if ( has_post_format( 'video' )) { ?>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>" class="centerer">
        <i class="fa fa-play-circle-o play-video-icon fa-4x whitecolor"></i>
        </a>
      <?php } ?>

      <header>
        <?php get_template_part('templates/snippet', 'category-link'); ?>

        <h3 class="entry-title">
          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <?php /* if calendar post type, show calendar icon */ if ( get_post_type() == 'calendar' ){ ?>
             <!--  <i class="fa fa-calendar"></i> -->
            <?php } ?>
            <?php the_title(); ?>
          </a>
        </h3>

        <?php /* if calendar post type, show start/end date */ ?>

        <?php get_template_part('templates/snippet', 'start-end-date'); ?>
      </header>

    <?php } ?>
  </div>
</div>