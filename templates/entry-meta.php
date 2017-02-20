<div class="text-uppercase meta-sharing">
  <div class="pull-left">
    <p class="noMargin">
      <time class="updated" datetime="<?= get_the_time('c'); ?>"><?= get_the_date(); ?></time><br />
      <?= __('By', 'sage'); ?> <a href="<?= get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?= get_the_author(); ?></a>
    </p>
  </div>
  <div class="pull-right">
    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-55ce3c8af0d16341" async="async"></script>

    <!-- Go to www.addthis.com/dashboard to customize your tools -->
    <div class="addthis_responsive_sharing"></div>
  </div>
</div>