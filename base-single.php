<?php
global $issue, $contrast, $issue_color, $issue_number, $header_subtitle, $header_image, $issue_image, $issue_cat;

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

/**
 *	Detect Templating
 */
  
if (is_single ())

	include ("base-". get_post_type () .".php");	

else {

 
/*
if (is_single () && get_post_meta (get_the_ID (), '_template_slug', true))

	include ("base-single-template.php");	
	
else if ('events' == get_post_type())

	include ("base-event.php");

else {*/


/**
 *	Selected Issue
 */
$issue = $_GET['issue']?

	get_term_by('slug', preg_replace ("/[^A-Za-z0-9-]/", '', $_GET['issue']), 'magazine'):
	get_field ('current_issue', 'option');


if (!$issue) $issue = get_field ('current_issue', 'option');
if (!$issue)

	 throw new Exception('No current issue is set, please contact the DAMN° Moderator.');

// Some dry data
$issue_acf_id    = 'magazine_' . $issue->term_id;
$issue_color     = get_field ('issue_color', $issue_acf_id);
$issue_number    = get_field ('magazine_number', $issue_acf_id);
$contrast        = (int) get_field ('colour_scheme', $issue_acf_id);
$issue_cat       = get_field ('primary_category', $issue_acf_id);
$issue_link      = get_term_link($issue->term_id, 'magazine');
$issue_image	 = get_field('magazine_taxonomy_image', $issue_acf_id);
$header_image    = get_field ('header_image', $issue_acf_id);
$header_subtitle = get_field ('header_subtitle', $issue_acf_id);

?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>

<?php get_template_part('templates/head'); ?>

<body <?php body_class(); ?>>	
	
<?php
	do_action('get_header');
	get_template_part('templates/header');
?>

    <?php /* news image & meta */ ?>

    <?php if (is_singular('calendar') || is_singular('product')) { ?>
    <?php } elseif (is_singular('advertorial')) { ?>
      <?php get_template_part('templates/single-header-advertorial'); ?>
    <?php } else if (has_post_format( 'gallery' )) { ?>
      <?php get_template_part('templates/single-header-photogallery'); ?>
    <?php } else if (is_singular( 'events' )) { ?>
      <?php get_template_part('templates/single-header-events'); ?>
    <?php } else { ?>
      <?php get_template_part('templates/single-header'); ?>
    <?php } ?>

    <div class="wrap" role="document">
      <div class="content single-content container">

        <?php if (Config\display_sidebar()) : ?>
          <aside class="sidebar visible-sm-block visible-md-block visible-lg-block" role="complementary">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
		
        <main class="main" role="main">
          <?php include Wrapper\template_path(); ?>
        </main><!-- /.main -->

        <?php if (Config\display_sidebar()) : ?>
          <aside class="sidebar visible-xs-block" role="complementary">
            <?php include Wrapper\sidebar_path(); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>

        <div class="clearfix"></div>
      </div><!-- /.content -->

      <div class="clearthis"></div>
    </div><!-- /.wrap -->

    <?php
      do_action('get_footer');
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>

<?php } ?>
