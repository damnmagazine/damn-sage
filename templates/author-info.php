<div class="author-info">
  <div class="pull-left">
    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author(); ?>">
      <?php if ( get_the_author_meta( 'author_image' ) ) : ?>
        <?php
        $author_id = get_the_author_meta('ID');
        // first, get the image object returned by ACF
        $image_object = get_field('author_image', 'user_'. $author_id );
        // and the image size you want to return
        $image_size = 'thumbnail';
        // now, we'll exctract the image URL from $image_object
        $image_url = $image_object['sizes'][$image_size];
        ?>
        <img src="<?php echo $image_url; ?>" alt="">
      <?php endif; ?>
    </a>
  </div>

  <h3><a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a></h3>

  <?php if ( get_the_author_meta( 'description' ) ) : ?>
    <p><?php the_author_meta( 'description' ); ?></p>
  <?php endif; ?>

  <?php if (get_the_author_meta('user_url') || get_the_author_meta('author_facebook') || get_the_author_meta('author_twitter') || get_the_author_meta('author_linkedin') || get_the_author_meta('author_pinterest') || get_the_author_meta('author_instagram')) : ?>
  <ul class="social-profiles list-inline">
    <?php if ( get_the_author_meta( 'user_url' ) ) : ?>
      <li><a href="<?php the_author_meta('user_url');?>" target="_blank" title="Author Website">Website</a> <span>&nbsp; /</span></li>
    <?php endif; ?>
    <?php if ( get_the_author_meta( 'author_facebook' ) ) : ?>
      <li><a href="<?php the_author_meta('author_facebook');?>" target="_blank" title="Author Facebook">Facebook</a> <span>&nbsp; /</span></li>
    <?php endif; ?>
    <?php if ( get_the_author_meta( 'author_twitter' ) ) : ?>
      <li><a href="<?php the_author_meta('author_twitter');?>" target="_blank" title="Author Twitter">Twitter</a> <span>&nbsp; /</span></li>
    <?php endif; ?>
    <?php if ( get_the_author_meta( 'author_linkedin' ) ) : ?>
      <li><a href="<?php the_author_meta('author_linkedin');?>" target="_blank" title="Author LinkedIN">LinkedIN</a> <span>&nbsp; /</span></li>
    <?php endif; ?>
    <?php if ( get_the_author_meta( 'author_pinterest' ) ) : ?>
      <li><a href="<?php the_author_meta('author_pinterest');?>" target="_blank" title="Author Pinterest">Pinterest</a> <span>&nbsp; /</span></li>
    <?php endif; ?>
    <?php if ( get_the_author_meta( 'author_instagram' ) ) : ?>
      <li><a href="<?php the_author_meta('author_instagram');?>" target="_blank" title="Author Instagram">Instagram</a> <span>&nbsp; /</span></li>
    <?php endif; ?>
  </ul>
  <?php endif; ?>

  <?php /* author meta end */ ?>

  <div class="clearthis"></div>
</div>
