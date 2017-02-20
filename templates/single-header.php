<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );
$url = $thumb['0'];
?>

<?php  /* if has featured video or video post format, use alternate post header */ if ( has_post_video() || has_post_format( 'video' )) { ?>

  <div class="single-video-item">
    <div class="post-image">
      <?php the_post_video(''); ?>
      <?php /* based on browser size, show one other other image. uses bootstrap visible class to show/hide */ ?>
      <img src="<?= get_template_directory_uri(); ?>/dist/images/default-large-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="visible-md-block visible-lg-block" />
      <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-news-sm-tall.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="visible-xs-block visible-sm-block" />
    </div>

    <div class="relative-header">
      <div class="container">
        <header>
          <?php get_template_part('templates/snippet', 'category-link'); ?>
          <div class="entry-meta">
            <h1 class="entry-title">
              <?php /* if video post format, show play icon */ if ( has_post_format( 'video' )) { ?>
                <i class="fa fa-play-circle-o play-video-icon"></i>
              <?php } ?>
              <?php the_title(); ?>
            </h1>
            <?php if(get_field('sub-title')) { ?>
              <h3 class="subtitle">
                <?php the_field('sub-title'); ?>
              </h3>
            <?php } ?>
          </div>
        </header>
      </div>
    </div>
  </div>

<?php /* else, load normal single post header */ } else { ?>

  <div class="single-news-item">

    <?php if  ( has_post_thumbnail()) { ?>
      <div class="post-image" style="background-image:url(<?=$url?>);">
    <?php } else { ?>
      <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-large.png)">
    <?php } ?>
      <div class="container">

        <?php /* need this to have a full height box so the header can properly bottom align */ ?>
        <div class="header-wrapper positionRelative">
          <?php /* based on browser size, show one other other image. uses bootstrap visible class to show/hide */ ?>
          <img src="<?= get_template_directory_uri(); ?>/dist/images/default-large-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" />

          <header>
            <?php get_template_part('templates/snippet', 'category-link'); ?>
            <div class="entry-meta">
              <h1 class="entry-title"><?php the_title(); ?></h1>
              <?php if(get_field('sub-title')) { ?>
                <h3 class="subtitle">
                  <?php the_field('sub-title'); ?>
                </h3>
              <?php } ?>
            </div>
          </header>
        </div>

      </div>
    </div>

  </div>

<?php /* end if */ } ?>


<?php /* only show share icons and publish date/author here on 768 to 991, since its too wide to fit in the normal place (at this particular view) */ ?>
<?php while (have_posts()) : the_post(); ?>
  <div class="ipad-sized-meta">
    <div class="container">
      <?php get_template_part('templates/entry-meta'); ?>
      <div class="clearthis"></div>
    </div>
  </div>
<?php endwhile; ?>

