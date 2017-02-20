<div class="product-info">
  <?php
    $companylogo = wp_get_attachment_image_src(get_field('company_image'), 'full');
    if( $companylogo ) { ?>
      <div class="company-logo">
        <img src="<?php echo $companylogo[0]; ?>" alt="<?php echo get_the_title(get_field('magazine_feature_feature_image')) ?>" />
      </div>
  <?php } ?>

  <div class="product-creators">
    <h4><strong>CREATOR</strong></h4>
    <p class="noMargin"><?php the_field('creators', false, false); ?></p>
  </div>

  <?php if(get_field('company_website')) { ?>
    <div class="product-links">

      <h4 class="text-uppercase"><strong>More Information</strong></h4>

      <?php // company website ?>
      <span><i class="fa fa-external-link"></i> <a href="http://<?php the_field('company_website'); ?>" target="_blank" title="More Information"><?php the_field('company_website'); ?></a></span>

      <?php // additional URLs ?>
      <?php if(get_field('additional_websites')): ?>
        <?php while(has_sub_field('additional_websites')): ?>
          <span><i class="fa fa-external-link"></i> <a href="http://<?php the_sub_field('product_websites'); ?>" target="_blank" title="More Information"><?php the_sub_field('product_websites'); ?></a></span>
        <?php endwhile; ?>
      <?php endif; ?>

    </div>
  <?php } ?>

  <?php /* MIKE hide buy button until October 16th
  <?php if(get_field('buy_link')) { ?>
    <div class="product-buy-link">
      <a class="btn btn-lg btn-default" href="http://<?php the_field('buy_link'); ?>" role="button" target="_blank" title="Buy This Product">Buy This Product</a>
    </div>
  <?php } ?>
  */ ?>

</div>