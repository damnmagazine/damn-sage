<?php
global $issue, $contrast, $issue_color, $issue_number, $header_subtitle, $header_image, $issue_image, $issue_cat;

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

/**
 *	Selected Issue
 */
$issue = isset( $_GET['issue'] )?

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
	get_template_part('templates/page-title');
?>

	<div class="wrap" role="document">
	<?php if (is_tax( 'magazine' ) || is_page() || is_post_type_archive('calendar')): ?>

		<?php 
			if ( str_replace( '/' , '', $_SERVER['REQUEST_URI'] ) === 'back-issues'  ){
				get_template_part('templates/back-issues-copy');
			}
		?>

		<div class="content container">
			
			<?php if (Config\display_sidebar() && !is_post_type_archive('calendar')) : ?>
			<aside class="sidebar visible-sm-block visible-md-block visible-lg-block" role="complementary">
				<?php include Wrapper\sidebar_path(); ?>
			</aside>
			<?php endif; ?>
			
			<main class="main" role="main">
			
				<?php include Wrapper\template_path(); ?>
			</main>
			
			<?php if (Config\display_sidebar() && !is_post_type_archive('calendar')) : ?>
			<aside class="sidebar visible-xs-block" role="complementary">
				<?php include Wrapper\sidebar_path(); ?>
			</aside>
			<?php endif; ?>

	<?php else: ?>
		<div class="content">
			<main class="main" role="main">
				<div class="container">
					<?php include Wrapper\template_path(); ?>
				</div>
			</main>

	<?php endif; ?>
		
		</div>
		<div class="clearthis"></div>
	</div>
	
	<?php
		do_action('get_footer');
		get_template_part('templates/footer');
		wp_footer();
	?>
</body>
</html>
