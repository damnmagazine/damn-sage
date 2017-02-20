<?
/*

#1 this is the template for posts on the homepage, the archive page, and the "related posts" on single pages
#2 if is single, the 'item' is 'col-sm-3' because the display is 4 items across on single pages ("Related Post").
#3 if it is home or archive, the 'item' is 'col-sm-4'
#4 if its home and the first post, the first news-item is a wider box and first 'item' is 'col-sm-8', then the rest are 'col-sm-4' like all other home/archives

*/
?>

<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
$wrapperclass = ( $wp_query->current_post%4 == 0 && (int)( $wp_query->current_post / 3 ) < 3 && !is_paged() && is_home() ) ? 'citem col-xs-12 col-sm-8' : 'item col-xs-12 col-sm-6 col-md-4';
?>


  <div class="<?=$wrapperclass?> <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>" id="post-<?php the_ID(); ?>">

  <div class="news-item ">

    <? /* the actual post images are backgrounds. transparent placeholders GIFs fill the actual space, so all blocks are the same size.
      If no post image is present, a default image loads instead */

      /* if is home or news category archive, the first post gets a wider placeholder image. if single, just the normal placeholder for all */
    ?>
    <?php if ( has_post_thumbnail()) { ?>
      <div class="post-image" style="background-image:url(<?=$url?>);">
    <?php } else { ?>
      <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
    <?php } ?>

      <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php if (is_single()) { ?>
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
        <?php } else { ?>
          <?php if( $wp_query->current_post%4 == 0 && (int)( $wp_query->current_post / 3 ) < 3 && !is_paged() && is_home() ) : ?>
            <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
          <?php else : ?>
            <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
          <?php endif; ?>
        <?php } ?>
      </a>
    </div>

    <?php /* REUSED snippet to display title, category, subtitle */ ?>
    <?php get_template_part('templates/snippet', 'feed-header'); ?>
  </div>
</div>