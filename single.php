<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<?php if (is_singular( 'calendar' )) { ?>
  <?php get_template_part('templates/content-single-calendar', get_post_type()); ?>
<?php } elseif (is_singular( 'product' )) { ?>
  <?php get_template_part('templates/content-single-product', get_post_type()); ?>
<?php } else { ?>
  <?php get_template_part('templates/content-single', get_post_type()); ?>
<?php } ?>

<?php /*hide this to anyone on a paywalled post who does not have access to view the page */ ?>
<?php if (in_category('damn-plus')) { ?>

  <?php /* if in damn plus and can access locked content, show the comments and related posts, else nothing */ ?>
  <?php if (current_user_can("access_s2member_level1")){ ?>
    <?php /* Facebook Comments  ?>
    <?php comments_template('/templates/facebook-comments.php'); */ ?>

    <?php /* Related Posts */ ?>
    <?php get_template_part('templates/related-posts'); ?>
  <?php } ?>

<?php /* else if not in a damn-plus category, show things as normal, as the post is not locked */  ?>
<?php } else { ?>
  <?php /* Facebook Comments  ?>
  <?php comments_template('/templates/facebook-comments.php');*/ ?>

  <?php /* Related Posts */ ?>
  <?php get_template_part('templates/related-posts'); ?>
<?php } ?>
