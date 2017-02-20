<?php
/*
Template Name: Join DAMN Plus
*/
?>

<?php while (have_posts()) : the_post(); ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="page-featured-image color-box">
      <?php the_post_thumbnail('large'); ?>
    </div>
  <?php } ?>

  <div class="row join-damn-plus-info">
    <div class="col-xs-12 col-sm-3 col-md-4 magazine-cover">

      <?php get_template_part('templates/snippet-latest-cover'); ?>

    </div>

    <div class="col-xs-12 col-sm-9 col-md-8 join-damn-plus-form">
      <article <?php post_class(''); ?>>

        <div class="entry-content">
          <?php the_content(); ?>

          <?php if(get_field('profile_shortcode')) { ?>
            <div class="panel panel-default">
              <div class="panel-body">
                <?php the_field('profile_shortcode'); ?>
              </div>
            </div>
          <?php } ?>
        </div>

      </article>
    </div>
  </div>

<?php endwhile; ?>
