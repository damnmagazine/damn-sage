<?php
/*
Template Name: Subscribe
*/
?>

<?php while (have_posts()) : the_post(); ?>

  <?php if ( has_post_thumbnail()) { ?>
    <div class="page-featured-image color-box">
      <?php the_post_thumbnail('large'); ?>
    </div>
  <?php } ?>

  <div class="row subscribe-page">
    <div class="col-xs-12 col-sm-3 col-md-4 magazine-cover">
      <?php get_template_part('templates/snippet-latest-cover'); ?>
    </div>

    <div class="col-xs-12 col-sm-9 col-md-8 mailing-list-form">
      <?php the_content(); ?>

      <h2>Subscribe to our mailing list</h2>
      <h4>While we finish DAMn+, subscribe to our mailing list to get the latest and hottest fresh from the oven.</h4>
      <h4>Fill out the form to get started</h4>

      <form class="validate" role="form" action="//damnmagazine.us11.list-manage.com/subscribe/post?u=e83f5d434bc817ef95113b8f0&amp;id=1f6a1653df" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" target="_blank" novalidate="">

      <div class="form-group">
      <div class="col-sm-2"><label for="mce-EMAIL">Email Address <span class="asterisk">*</span></label></div>
      <div class="col-sm-10"><input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" /></div>
      </div>

      <div class="form-group">
      <div class="col-sm-2"><label for="mce-FNAME">First Name </label></div>
      <div class="col-sm-10"><input type="text" value="" name="FNAME" class="" id="mce-FNAME" /></div>
      </div>

      <div class="form-group">
      <div class="col-sm-2"><label for="mce-LNAME">Last Name </label></div>
      <div class="col-sm-10"><input type="text" value="" name="LNAME" class="" id="mce-LNAME" /></div>
      </div>

      <div class="form-group">
        <div class="col-sm-2"><label>Opt-in?</label></div>
        <div class="col-sm-10">
          <ul style="list-style: none; margin: 0; padding: 0;">
            <li>
              <input type="checkbox" value="1" name="checkbox" id="mce-group[6965]-6965-0" style="display: inline-block; width: auto; margin-right: 10px;">
                <label for="mce-group[6965]-6965-0">Yes, I would like to opt-in to this mailing list</label>
            </li>
        </div>
      </div>

      <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
      <div id="mce-responses" class="clear">
      <div class="response" id="mce-error-response" style="display: none;"></div>
      <div class="response" id="mce-success-response" style="display: none;"></div>
      </div>
      <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
      <div style="position: absolute; left: -5000px;"><input type="text" name="b_e83f5d434bc817ef95113b8f0_1f6a1653df" tabindex="-1" value="" /></div>
      <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button btn btn-default btn-lg" style="text-transform: uppercase;" onclick="if(!this.form.checkbox.checked){alert('You must agree to opt-in to this list.');return false}" /></div>
      </div>
      </form>

      <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script>
      <script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='MMERGE3';ftypes[3]='url';fnames[4]='MMERGE4';ftypes[4]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
<!--End mc_embed_signup-->

    </div>
  </div>

<?php endwhile; ?>