<?php the_content(); ?>

<div class="row profile-mods">
  <div class="col-xs-12">
    <div class="panel panel-default">
      <div class="panel-body">

        <div class="row">
          <div class="col-xs-12 col-sm-7 edit-profile">
            <h3 class="widget-title marginBottom bottomBorderInline">Edit Profile</h3>
            <?php if(get_field('shortcode_for_showing_profile')) { ?>
              <?php the_field('shortcode_for_showing_profile'); ?>
            <?php } else { ?>
              <?php echo do_shortcode("[s2Member-Profile /]"); ?>
            <?php } ?>
          </div>

          <div class="col-xs-12 col-sm-5 cancel-button">
            <h3 class="widget-title marginBottom bottomBorderInline">Cancel Subscription</h3>
            <?php if(get_field('shortcode_for_cancellation_button')) { ?>
              <?php the_field('shortcode_for_cancellation_button'); ?>
            <?php } else { ?>
              <?php echo do_shortcode('[s2Member-Pro-PayPal-Form cancel="1" desc="Do you want to cancel your subscription?" unsub="0" captcha="0" /]'); ?>
            <?php } ?>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
</div>