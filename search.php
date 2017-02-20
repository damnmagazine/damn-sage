<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_template_part('templates/snippet-search-form'); ?>
<?php endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('templates/content', 'archive'); ?>
<?php endwhile; ?>

<?php get_template_part('templates/page-navi'); ?>
