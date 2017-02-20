<?php
/*
Template Name: Calendar Search Results
*/
?>

<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('templates/header-calendar-results');
    ?>

    <div class="wrap" role="document">
      <div class="content container">
        <main class="main calendar-results" role="main">

          <?php if ( is_active_sidebar( 'sidebar-calendar-page-filter' ) ) : dynamic_sidebar( 'sidebar-calendar-page-filter' ); endif; ?>

          <?php if (!have_posts()) : ?>
            <div class="alert alert-warning text-center">
              <?php _e('Sorry, no results were found. Try another search or <a href="/calendar" title="Back to all Calendar items">go back to all Calendar items</a>.', 'sage'); ?>
            </div>
          <?php endif; ?>

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

        </main><!-- /.main -->
      </div><!-- /.content -->

      <?php /* Back Issues */ ?>
      <?php get_template_part('templates/back issues'); ?>

      <div class="clearthis"></div>
    </div><!-- /.wrap -->

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
