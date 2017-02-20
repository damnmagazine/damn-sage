<?php /* Multiple external URL links, if added */ ?>
<?php // Display the external Links ?>
<?php if(get_field('external_links')): ?>
  <div class="borderedBox">
    <h4 class="text-uppercase"><strong>Read More</strong></h4>
    <?php while(has_sub_field('external_links')): ?>
      <span><i class="fa fa-external-link"></i> &nbsp; <a href="http://<?php the_sub_field('external_urls'); ?>" target="_blank" title="More Information"><?php the_sub_field('external_urls'); ?></a><br /></span>
    <?php endwhile; ?>
  </div>
<?php endif; ?>