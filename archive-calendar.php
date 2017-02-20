<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_template_part('templates/search-form'); ?>
<?php endif; ?>

<?php if ( is_active_sidebar( 'sidebar-calendar-page-filter' ) ) : dynamic_sidebar( 'sidebar-calendar-page-filter' ); endif; ?>

<div class="row">
  <?php if (have_posts()) : ?>
    <div data-columns="" id="columns-calendar">
      <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('templates/content-calendar', get_post_type() != 'calendar' ? get_post_type() : get_post_format()); ?>
      <?php endwhile; ?>
    </div>
  <?php endif; ?>
</div>

<?php get_template_part('templates/page-navi'); ?>