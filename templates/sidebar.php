<?php
/* if Productivity */
if (is_singular('product')) { ?>

  <?php /* Product Information - Post Relation below this */ ?>

  <?php if(get_field('creators')) { ?>
    <section class="widget product-info-wrapper visible-sm-block visible-md-block visible-lg-block">
      <h3 class="widget-title">
        Product Info
      </h3>
      <?php get_template_part('templates/snippet', 'product-info'); ?>
    </section>
  <?php } ?>
  <?php /* end if get field = creators */ ?>

<?php /* end if Productivity */ } ?>


<?php /* DAMN + specific form */ ?>
<?php if (is_page('join-damn-plus') || is_page('damn-plus') || is_page('profile')) { ?>
  <div class="damn-plus-login-form">
    <?php if ( is_active_sidebar( 'sidebar-damn-plus-widget' ) ) : dynamic_sidebar( 'sidebar-damn-plus-widget' ); endif; ?>
  </div>
<?php } ?>

<?php /* Top Advert 300 x 600 */ ?>
<div class="advert advert-sidebar-top">
  <?php if (function_exists('adrotate_group')) echo adrotate_group(3); ?>
</div>

<?php /* if Magazine detail page or Calendar detal page, else normal */ ?>
<?php if(is_tax( 'magazine' )) { ?>
  <?php if ( is_active_sidebar( 'magazine-detail-widget' ) ) : dynamic_sidebar( 'magazine-detail-widget' ); endif; ?>
<?php } elseif(is_singular( 'calendar' )) { ?>
  <?php if ( is_active_sidebar( 'calendar-detail-widget' ) ) : dynamic_sidebar( 'calendar-detail-widget' ); endif; ?>
<?php } elseif(is_singular( 'events' )) { ?>
  <?php if ( is_active_sidebar( 'event-detail-widget' ) ) : dynamic_sidebar( 'event-detail-widget' ); endif; ?>
<?php } elseif(is_singular( 'product' )) { ?>
  <?php if ( is_active_sidebar( 'product-detail-widget' ) ) : dynamic_sidebar( 'product-detail-widget' ); endif; ?>
<?php } else { ?>
  <?php if ( is_active_sidebar( 'sidebar-primary' ) ) : dynamic_sidebar( 'sidebar-primary' ); endif; ?>
<?php } ?>

<?php /* 300 x 250 */ ?>
<div class="advert advert-sidebar-bottom">
  <?php if (function_exists('adrotate_group')) echo adrotate_group(4); ?>
</div>