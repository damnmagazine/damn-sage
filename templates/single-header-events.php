<?php
$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
$url = $thumb['0'];
?>

<!-- <div class="title-wrapper event-specific">
  <h1 class="archive-title">
    DAM<sub>N</sub>° <span>EVENTS</span>
  </h1>
</div> -->

<?php
$backgroundimage = wp_get_attachment_image_src(get_field('background_image'), 'full');
if( $backgroundimage ) { ?>
  <div class="single-event-item" style="background-image:url(<?php echo $backgroundimage[0]; ?>);">
<?php } else { ?>
  <div class="single-event-item">
<?php } ?>

  <div class="fade-wrapper">
    <div class="container">
      <div class="row">

        <?php /* left side image */ ?>
        <div class="col-xs-12 col-sm-4">
          <div class="post-image">
            <?php /* hide border/calendar if has post video */ if ( has_post_video()) { ?>
            <?php } else { ?>
              <div class="positioned-border"></div>

              <?php /* calendar box */ if(get_field('start_date')) { ?>
                <?php $date = get_field('start_date');
                  $datemonth = date("M", strtotime($date));
                  $dateday = date("j", strtotime($date));
                  $dateyear = date("Y", strtotime($date));
                ?>

                <div class="calendar-box">
                  <span class="month"><?php echo $datemonth; ?></span>
                  <span class="day"><?php echo $dateday; ?></span>
                  <span class="year"><?php echo $dateyear; ?></span>
                </div>
              <?php } ?>
            <?php } ?>

            <?php /* if has post video, show the video */ if ( has_post_video()) { ?>
              <?php the_post_video(''); ?>
            <?php /* else show featured image */ } elseif (has_post_thumbnail()) { ?>
              <?php the_post_thumbnail('large'); ?>
            <?php } else { ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/default-tall.png" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" />
            <?php } ?>
          </div>
        </div>

        <?php /* right side information */ ?>
        <div class="col-xs-12 col-sm-8">
          <header>
            <?php get_template_part('templates/snippet', 'category-link'); ?>

            <div class="clearthis"></div>

            <div class="entry-meta">
              <?php /* title and sub-title */ ?>
              <h1 class="entry-title"><?php the_title(); ?></h1>

              <?php if(get_field('sub-title')) { ?>
                <h3 class="subtitle">
                  <?php the_field('sub-title'); ?>
                </h3>
              <?php } ?>

              <div class="clearthis"></div>

              <div class="date-links">
                <div class="start-end-date">
                  <?php if(get_field('start_date')) { ?>
                    <span><p><strong>Starts:</strong> <?php the_field('start_date'); ?></p></span>
                  <?php } ?>
                  <?php if(get_field('end_date')) { ?>
                    <span><p><strong>Ends:</strong> <?php the_field('end_date'); ?></p></span>
                  <?php } ?>
                </div>

                <div class="event-links">
                  <?php get_template_part('templates/snippet', 'website-tickets'); ?>
                </div>
              </div>
            </div>
          </header>
        </div>
        <?php /* end right/left side */ ?>

      </div>
    </div>
  </div>

</div>

