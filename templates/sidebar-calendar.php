<?php if ( is_active_sidebar( 'sidebar-calendar-page-filter' ) ) : dynamic_sidebar( 'sidebar-calendar-page-filter' ); endif; ?>

<div class="advert advert-sidebar-top">
  <?php if (function_exists('adrotate_group')) echo adrotate_group(3); ?>
</div>

<div class="advert advert-sidebar-bottom">
  <?php if (function_exists('adrotate_group')) echo adrotate_group(4); ?>
</div>