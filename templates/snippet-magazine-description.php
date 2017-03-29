<?php $term = $wp_query->queried_object; ?>

<div class="col-xs-12">
  <article <?php post_class(''); ?>>
    <div class="entry-content">
      <div class="row">
        <div class="col-xs-12 col-sm-5 marginBottom">
          <div class="post-image bordered-image">

            <?php $magazineimage = wp_get_attachment_image_src(get_field('magazine_taxonomy_image', $term->taxonomy . '_' . $term->term_id), 'full'); ?>
            <img src="<?php echo $magazineimage[0]; ?>" alt="<?php echo get_the_title(get_field('magazine_taxonomy_image')) ?>" class="placeholder" />

          </div>
          <div class="subscribe-links">
            <?php if(get_field('magazine_buy_link', $term->taxonomy . '_' . $term->term_id)) { ?>
              <a class="btn btn-lg btn-default marginRight marginTop text-uppercase" href="<?php the_field('magazine_buy_link', $term->taxonomy . '_' . $term->term_id); ?>" role="button" target="_blank">Buy Issue</a>
            <?php } ?>
            <a class="btn btn-lg btn-default marginTop text-uppercase" href="/back-issues/subscribe" role="button" title="Subscribe">Subscribe</a>
          </div>
        </div>

        <div class="col-xs-12 col-sm-7">
          <?php the_field('magazine_taxonomy_description', $term->taxonomy . '_' . $term->term_id); ?>
        </div>
      </div>
    </div>
  </article>
  <div class="title-wrapper-in-content">
    <h3 class="marginBottom">More Articles From This Issue</h3>
  </div>
</div>