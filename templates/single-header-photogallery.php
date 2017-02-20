<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<div class="single-gallery-item">

  <div class="container">
    <div class="row">

      <?php if (has_post_thumbnail()) { ?>
        <div class="col-xs-12 col-sm-4">
          <div class="post-image bordered-image">
            <?php the_post_thumbnail('large'); ?>
          </div>
        </div>
      <?php } ?>

      <div class="col-xs-12 col-sm-8">
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

        <?php get_template_part('templates/entry-meta'); ?>
      </div>

    </div>
  </div>

</div>

