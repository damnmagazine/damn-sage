<?php if (!have_posts())
    get_template_part('templates/snippet-no-results');

  /**
   *  Featured post.
   *
   *  There can only be one featured post.
   *  It shall be an article. It shall be the most recent one.
   */
  $feat_query = [
    'cat' => '-4315',
    'posts_per_page' => 1,
    'post_type' => 'post',
    'orderby' => 'post_date',
    'order' => 'DESC'
  ];

  /**
   *  Posts stream.
   *
   *  The home posts stream can contain both articles and calendar nodes. EXCLUDES video post format, as those load below main query
   */
  $main_query = [
    'posts_per_page' => 24,
    'post_type' => array ('post','calendar'),
    'orderby' => 'post_date',
    'order' => 'DESC',

    'tax_query' => array(
      array(
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms' => 'post-format-video',
        'operator' => 'NOT IN'
      )
    )
  ];

  /* Only VIDEO POST FORMAT, so these posts can load below the main query */
  $video_query = [
    'posts_per_page' => 2,
    'post_type' => array ('post','calendar'),
    'orderby' => 'post_date',
    'order' => 'DESC',

    'tax_query' => array(
      array(
        'taxonomy' => 'post_format',
        'field' => 'slug',
        'terms' => 'post-format-video',
      )
    )
  ];

  /**
   *  Issue filtering.
   *
   *  If issue string parameter is provided,
   *  show only connected posts and calendars.
   */
  if ($_GET['issue'])

    $feat_query['tax_query'][] =
    $main_query['tax_query'][] = [
      'taxonomy' => 'magazine',
      'field' => 'slug',
      'terms' => [$issue->slug]
    ];

  // Excempt featured post from main stream
  $featured = new WP_Query($feat_query);
  $main_query['post__not_in'] = [$featured->posts[0]->ID];


  // Build featured post row
  $featured->the_post();
  get_template_part('templates/home', 'primary-row');


  // Build second & third row
  $dynamics = new WP_Query($main_query);

  // Build video post format row
  $dynamicsvideo = new WP_Query($video_query);
?>

<?php

/**
 *  Selected Issue
 */
global $issue, $issue_color, $issue_number;

// Some dry data
$issue_acf_id = 'magazine_' . $issue->term_id;
$featurevideo = get_field ('video_embed1', $issue_acf_id);
$post_count = 0;

/**
 *  open a new, basic container div so bootstrap column clears dont count advert wrapper in nth-child and break the layout.
 *  DIV CLOSED after ENDWHILE.
 *  These first 5 items EXCLUDE video post type. Two video post types loads after these 5.
 */
?>

<div class="empty-wrapper row">
<?php

while ($dynamics->have_posts()) : $dynamics->the_post();
  if($post_count++ == 5) break;

  if (has_post_thumbnail () && !has_post_format('quote'))
  {
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $url = $thumb['0'];

    $thumblarge = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $urllarge = $thumblarge['0'];
  }
?>

  <?php if($post_count == 5) { ?>
    <div class="item col-xs-12 col-sm-12 col-md-8 medium-post video-post <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
  <?php } else { ?>
    <div class="item col-xs-12 col-sm-6 col-md-4 <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
  <?php } ?>

    <div class="news-item">

      <?php if ( has_post_format( 'quote' )) { ?>

        <div class="post-image">
          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <?php if($post_count == 5) { ?>
              <?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide-video.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder hidden-xs" />
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-video.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-xs-block" />
            <?php } else { ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
            <?php } ?>
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

        <?php if($post_count == 5 && has_post_thumbnail()) { ?>
        <div class="post-image" style="background-image:url(<?=$urllarge?>);">
        <?php } elseif ( has_post_thumbnail()) { ?>
        <div class="post-image" style="background-image:url(<?=$url?>);">
        <?php } else { ?>
        <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
        <?php } ?>
          <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
            <?php if($post_count == 5) { ?>
              <?php /* show non wide blank-image only on 768-992 so boxes adjust properly, using class "visible-xs-block" */ ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder hidden-xs" />
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-xs-block" />
            <?php } else { ?>
              <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder" />
            <?php } ?>
          </a>
        </div>

      <?php /* REUSED snippet to display title, category, subtitle */ ?>
      <?php get_template_part('templates/snippet', 'feed-header'); ?>
    <?php } ?>

    </div>
  </div>

<?php endwhile; ?>

</div><?php /* close empty-wrapper */ ?>


<?php /* single row to show only Video Post Types */ ?>
<div class="empty-wrapper row">
<?php

while ($dynamicsvideo->have_posts()) : $dynamicsvideo->the_post();
  if($post_count++ == 5) break;

  if (has_post_thumbnail () && !has_post_format('quote'))
  {
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
    $url = $thumb['0'];
  }
?>

  <div class="item col-xs-12 col-sm-12 col-md-6 col-md-large <?php foreach(get_the_category() as $category) { echo $category->slug . ' ';} ?>">
    <div class="news-item">

      <?php if ( has_post_thumbnail()) { ?>
      <div class="post-image" style="background-image:url(<?=$url?>);">
      <?php } else { ?>
      <div class="post-image" style="background-image:url(<?= get_template_directory_uri(); ?>/dist/images/default-tall.png)">
      <?php } ?>
        <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image-wide.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder hidden-xs" />
          <img src="<?= get_template_directory_uri(); ?>/dist/images/blank-image.gif" alt="<?php the_title_attribute(); ?> - <?= get_bloginfo("name"); ?>" class="placeholder visible-xs-block" />
        </a>
      </div>

      <?php /* REUSED snippet to display title, category, subtitle */ ?>
      <?php get_template_part('templates/snippet', 'feed-header'); ?>

    </div>
  </div>

<?php endwhile; ?>

</div><?php /* close empty-wrapper */ ?>


<?php /* sponsored content */ ?>
<div class="row sponsored-content-wrapper">
  <div class="col-xs-12">
    <div class="advert middle advert">
      <?php if (function_exists('adrotate_group')) echo adrotate_group(6); ?>
    </div>
  </div>
</div>


<?php /* 4 up category feeds */ ?>
<div class="row home-category-feeds">
<?php

/**
 *  Dynamic taxonomy column build
 *  We might use an ad-hoc function...
 */

function cattable ($cat, $post_cats)
{
  return isset ($cat) && (!isset ($post_cats[$cat->term_id]) || $post_cats[$cat->term_id] !== false);
}

$post_cats = [];
$cats_count = 0;

while ($dynamics->have_posts()) : $dynamics->the_post();

    // Build Cat info
    $categories = get_the_category();
  if (count ($categories) > 1) shuffle ($categories);

  $cat = null;

  // Prevent cat overkill
  for ($n = 0; $n <= 3;  $n++)
    if (cattable ($categories[$n], $post_cats))
    {
      $cat = $categories[$n]->term_id;
      $name = $categories[$n]->name;
      break;
    }

    if ($cat)
    {
      if(!isset ($post_cats[$cat]))

        $post_cats[$cat] = [];

      // Dirty fetch post
      ob_start();
      get_template_part('templates/content-home-small-feeds', get_post_type() != 'post' ? get_post_type() : get_post_format());

      $post_cats[$cat][] = ob_get_clean();


      // Output if possible
      if (count ($post_cats[$cat]) == 2)
      {

      ?>

    <div class="col-xs-12 col-sm-6 col-md-3">
      <h3 class="archive-title"><?=$name?></h3>
      <?php

        echo implode ("<br>", $post_cats[$cat]);
        $post_cats[$cat] = false;

      ?>
      </div>
      <?php

      if (++$cats_count == 4) break;
    }
  }
endwhile;
  ?>

  </div>
</div>

<?php /* 4 up products feed */ ?>
<?php
  $product_query = [
  'posts_per_page' => 4,
  'post_type' => 'product',
  'orderby' => 'post_date',
  'order' => 'DESC'
  ];

  if ($_GET['issue'])
  $product_query['tax_query'][] = [
  'taxonomy' => 'magazine',
  'field' => 'slug',
  'terms' => [$issue->slug]
  ];

  $products = new WP_Query($product_query);

  if ($products->have_posts()) : ?>

<div class="products-row">
  <div class="container">
    <div class="product-feed-home row">

      <div class="col-xs-12">
        <h3 class="archive-title">Productivity</h3>
      </div>
      <?php /* display as table above 768, so heights all line up / 768 - 991, table cell is 50% height, since there are 2 per row, 100% height at 992 +, as all 4 fit across one row / css home.scss */ ?>
      <div class="table-display">
      <?php while ($products->have_posts()) : $products->the_post(); ?>
        <div class="col-xs-12 col-sm-6 col-md-3 table-cell">

        <?php get_template_part('templates/content-productivity', get_post_type() != 'product' ? get_post_type() : get_post_format()); ?>

        <div class="clearthis"></div>
        </div>
      <?php endwhile; ?>
      </div>

    </div>
  </div>
</div>

  <?php endif; ?>

<div class="container">

<?php /* 3 bottom widgets */ ?>
<div class="row bottom-widgets">
  <div class="col-xs-12 col-sm-6 col-md-4 table-cell">
    <?php if ( is_active_sidebar( 'sidebar-homepage-agenda' ) ) : dynamic_sidebar( 'sidebar-homepage-agenda' ); endif; ?>
  </div>

  <div class="col-xs-12 col-sm-6 col-md-4">
    <?php if ( is_active_sidebar( 'sidebar-homepage-socials' ) ) : dynamic_sidebar( 'sidebar-homepage-socials' ); endif; ?>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-4">
    <div class="widget">
      <h3 class="widget-title">Join DAM<sub>N°</sub> +</h3>
        <div class="join-damn-plus-home-image">
          <?php $joinimage = wp_get_attachment_image_src(get_field('join_damn_plus_image', 'option'), 'full'); ?>
          <?php $joinimagewide = wp_get_attachment_image_src(get_field('join_damn_plus_image_wide', 'option'), 'full'); ?>
          <a href="/join-damn-plus" title="Join DAMN +">
            <?php if(get_field('join_damn_plus_image', 'option')) { ?>
              <img src="<?php echo $joinimage[0]; ?>" alt="Join DAMN +" class="visible-md-block visible-lg-block">
            <?php } ?>
            <?php if(get_field('join_damn_plus_image_wide', 'option')) { ?>
              <img src="<?php echo $joinimagewide[0]; ?>" alt="Join DAMN +" class="visible-xs-block visible-sm-block">
            <?php } ?>
          </a>
        </div>
    </div>
  </div>
</div>

